import * as http from '../../lib/http.mjs';

const htmlUrl = `${URL_COMPONENTS}alumForm/alumForm.html`;

let PAG_NUM = 1;
let CLASSES;

export 
{
    loadForm
}

function loadForm(object, classes = session.classes)
{
    PAG_NUM = 1;

    if (session.classes != undefined && session.classes.length != 0)
    {
        CLASSES = classes;
    }
    else
    {
        CLASSES = [{ id: -1 }];
    }

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

    console.log(CLASSES)

    if (CLASSES[0].id == -1)
    {
        $('#className').text('No classes');
        $('#btnPrevPage').attr({ 'disabled': 'true' });
        $('#btnNextPage').attr({ 'disabled': 'true' });
    }
    else 
    {
        http.tryLogin(`${URL_ALLCLASSES}/${CLASSES[PAG_NUM - 1].id}`)
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
                $('#className').text(content.name);
                loadUsers('prof', content.profs, tbody_profs);
                loadUsers('alum', content.alums, tbody_alums);
            })
            .catch(error =>
            {
                console.error('Error:', error);
            });
    }
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
                    console.log(user);
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
    if (PAG_NUM <= CLASSES.length)
    {
        PAG_NUM = Number(PAG_NUM) + 1;
        $('#pagNum').text(PAG_NUM);
        $('#btnPrevPage').removeAttr('disabled');
        loadData();
    }
    if (PAG_NUM == CLASSES.length)
    {
        $('#btnNextPage').attr({ 'disabled': 'true' });
    }
}

function prevPage()
{
    if (PAG_NUM > 1)
    {
        PAG_NUM = Number(PAG_NUM) - 1;
        $('#pagNum').text(PAG_NUM);
        $('#btnNextPage').removeAttr('disabled');
        loadData();
    }
    if (PAG_NUM == 1)
    {
        $('#btnPrevPage').attr({ 'disabled': 'true' });
    }
}