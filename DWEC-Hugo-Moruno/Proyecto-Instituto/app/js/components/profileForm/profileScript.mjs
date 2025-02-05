import * as http from '../../lib/http.mjs';
import * as prof from '../profForm/profScript.mjs';
import * as alum from '../alumForm/alumScript.mjs';
import * as admin from '../adminForm/adminScript.mjs';

const htmlUrl = `${URL_COMPONENTS}profileForm/profileForm.html`;

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
            $(object).append(content);
            getProfile();

        })
        .catch(error =>
        {
            console.error('Error:', error);
        });
}

function getProfile()
{
    http.tryLogin(`${URL_USERS}/${session.id}`)
        .then(response =>
        {
            if (!response.ok)
            {
                throw new Error();
            }
            return response.json();
        })
        .then(data =>
        {
            $('#profileName').text(data.name.toUpperCase());
            $('#emailInput').val(data.email);
            $('#nameInput').val(data.name);
            $('#ageInput').val(data.age);
            loadRelativeData(session.rol);
        })
        .catch(error =>
        {
            console.error(error);
        });
}

function loadRelativeData(rol)
{
    switch (rol)
    {
        case 'admin':
            loadAdmin();
            break;
        case 'prof':
            loadProfessor();
            break;
        case 'alum':
            loadAlum();
            break;
        case 'unassigned':
            loadUnassigned();
            break;
    }
}

function loadAlum()
{
    $('#profName').text('Classes of ' + session.name);
    alum.loadForm($('#classesDiv'), session.classes);
}

function loadProfessor()
{
    $('#profName').text('Classes of ' + session.name);
    prof.loadForm($('#classesDiv'));
}

function loadAdmin()
{
    $('#profName').text('Users');
    admin.loadForm($('#classesDiv'), false);
}

function loadUnassigned()
{
    $('#profName').text('Without role');
    $('#classesDiv')
        .append(
            $('<div>')
                .append(
                    $('<h3>')
                        .text('Unassigned profile, wait for de admin to assign your user to one role.')
                )
        )
}