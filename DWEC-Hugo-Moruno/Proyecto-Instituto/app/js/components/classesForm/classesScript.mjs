import * as http from '../../lib/http.mjs';

const htmlUrl = `${URL_COMPONENTS}classesForm/classesForm.html`;

let PAG_NUM = 1;

export 
{
    loadForm
}

function loadForm(object)
{
    http.get(htmlUrl)
        .then(response =>
        {
            if (!response.ok)
            {
                throw new Error(response.statusText);
            }
            return response.text();
        })
        .then(content =>
        {
            $(object).empty();
            $(object).append(content);
            $('#btnPrevPage').on('click', () => { prevPage(content) }).attr({ 'disabled': 'true' });
            $('#btnNextPage').on('click', () => { nextPage(content) });
            loadData();
        })
        .catch(error =>
        {
            console.error('Error:', error);
        });
}


function loadData()
{
    let tbody_profs = '#tbody_prof';
    $(tbody_profs).empty();
    let tbody_alums = '#tbody_alum';
    $(tbody_alums).empty();
    http.tryLogin(`${URL_ALLCLASSES}?id_ne=-1&_page=${PAG_NUM}&_limit=1`)
        .then(response =>
        {
            if (!response.ok)
            {
                throw new Error(response.statusText);
            }
            return response.json();
        })
        .then(content =>
        {
            $('#className').text(content[0].name);
            loadUsers('prof', content[0].profs, tbody_profs);
            loadUsers('alum', content[0].alums, tbody_alums);
        })
        .catch(error =>
        {
            console.error('Error:', error);
        });

}


function loadUsers(type, content, tbody)
{
    http.tryLogin(`${URL_ALLUSERS}?rol=${type}`)
        .then(response =>
        {
            if (!response.ok)
            {
                throw new Error(response.statusText);
            }
            return response.json();
        })
        .then(users =>
        {
            for (let data of content)
            {
                let user = (users.find(user => user.id === data.id));
                if (user != undefined)
                {
                    $(tbody).append(
                        $('<tr>')
                            .append(
                                $('<td>').text(user.id),
                                $('<td>').text(user.name),
                                $('<td>').text(user.email),
                                $('<td>').text(user.age)
                            )
                    )

                }
            }
        })
        .catch(error =>
        {
            console.error('Error:', error);
        });
}

function nextPage()
{
    PAG_NUM = Number(PAG_NUM) + 1;
    $('#pagNum').text(PAG_NUM);
    $('#btnPrevPage').removeAttr('disabled');
    loadData();
}

function prevPage()
{
    if (PAG_NUM > 1)
    {
        PAG_NUM = Number(PAG_NUM) - 1;
        $('#pagNum').text(PAG_NUM);
        loadData();
    }
    if (PAG_NUM == 1)
    {
        $('#btnPrevPage').attr({ 'disabled': 'true' });
    }
}