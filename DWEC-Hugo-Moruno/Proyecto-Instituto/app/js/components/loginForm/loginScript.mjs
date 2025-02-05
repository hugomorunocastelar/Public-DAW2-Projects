import * as http from '../../lib/http.mjs';
import * as sess from '../../lib/session/session.mjs';
import * as toast from '../../lib/toast/toast.mjs';
import * as pag from '../../pages.mjs';

const htmlUrl = `${URL_COMPONENTS}loginForm/loginForm.html`;

const BTNS_BUTTONS = 'button[route]';

let isRegister = false;

export 
{
    loadForm
}

function loadForm(object)
{
    fetch(htmlUrl)
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
            $('#school_name').text('Welcome to the ' + `${school_name}` + ' Login!')

            $.each($(BTNS_BUTTONS), function (indexInArray, valueOfElement)
            {
                $(this).on('click', eval($(this).attr('route')));
            });

        })
        .catch(error =>
        {
            console.error('Error:', error);
        });
}
function registerForm()
{
    if (isRegister)
    {
        // let registerForm = registerComplimentForm();
        $('#registerOptional').children().remove();

        $('#btnRegister').addClass('d-none');
        $('#btnLogin').removeClass('d-none');

        isRegister = false;
    }
    else
    {
        let registerForm = registerComplimentForm();
        $('#registerOptional').append(registerForm);

        $('#btnLogin').addClass('d-none');
        $('#btnRegister').removeClass('d-none');

        isRegister = true;
    }
}

function register()
{
    if (isRegister)
    {
        let emailVal = $('input[type="email"]').val().trim();
        let passwordVal = $('input[type="password"]').val().trim();
        let nameVal = $('input[type="text"]').val().trim();
        let ageVal = $('input[type="number"]').val().trim();

        if (emailVal != '' && passwordVal != '' && nameVal != '' && ageVal != '' && Number(ageVal))
        {
            const body = {
                email: emailVal,
                password: passwordVal,
                name: nameVal,
                age: Number(ageVal),
                rol: 'unassigned',
            };

            http.send(URL_REGISTER, body)
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
                    console.log('data');
                    console.log(data);
                    sess.configMenuFromRole(data.user.rol);
                    pag.loadPage('home', $('#pageContent'));
                })
                .catch(Error =>
                {
                    console.error(Error);
                });
        }
    }
}

function tryLogin()
{
    let emailVal = $('input[type="email"]').val().trim();
    let passwordVal = $('input[type="password"]').val().trim();

    if (emailVal != '' && passwordVal != '')
    {
        const body = {
            email: emailVal,
            password: passwordVal
        };

        http.send(URL_LOGIN, body)
            .then(response =>
            {
                if (!response.ok)
                {
                    toast.warnToast('Failed to log the user.', 'Login failed.')
                    $('input[type="email"]').val('');
                    $('input[type="password"]').val('');
                    throw new Error();
                }
                return response.json()
            })
            .then(data =>
            {
                session.jwtToken = data.accessToken;
                session.classes = data.user.classes;
                console.log(data.user.classes);
                console.log(session.classes);
                console.log(session);
                session.email = data.user.email;
                session.name = data.user.name;
                session.rol = data.user.rol;
                session.age = data.user.age;
                session.id = data.user.id;
                sessionStarted = true;

                sess.saveSession();

                sess.configMenuFromRole(data.user.rol);
                $('#loginEmail').text(data.user.email);
                pag.loadPage('home', $('#pageContent'));
            })
            .catch(Error =>
            {
                console.error(Error);
            });
    }
    else
    {
        toast.infoToast('Please, fill all the inputs.', 'Fill login.')
    }
}

function registerComplimentForm()
{

    let input;
    let inputLabel;
    let inputObj;

    let div = $('<div>').attr(
        {
            "class": "row"
        }
    );

    input = $('<div>').attr({
        "data-mdb-input-init": true,
        "class": "form-outline mb-4 col-12 col-md-8"
    });

    inputLabel = $('<label>').attr({
        "class": "form-label",
        "for": "name"
    }).text('Name');

    inputObj = $('<input>').attr({
        "type": "text",
        "id": "name",
        "class": "form-control",
        "placeholder": "Name",
        "validate": "nonum",
        "required": "true"
    });

    input.append(inputLabel);
    input.append(inputObj);
    div.append(input);

    input = $('<div>').attr({
        "data-mdb-input-init": true,
        "class": "form-outline mb-4 col-12 col-md-4"
    });

    inputLabel = $('<label>').attr({
        "class": "form-label",
        "for": "age"
    }).text('Age');

    inputObj = $('<input>').attr({
        "type": "number",
        "id": "age",
        "class": "form-control",
        "placeholder": "Age",
        "validate": "notext",
        "required": "true"
    });

    input.append(inputLabel);
    input.append(inputObj);
    div.append(input);

    return div;

}

