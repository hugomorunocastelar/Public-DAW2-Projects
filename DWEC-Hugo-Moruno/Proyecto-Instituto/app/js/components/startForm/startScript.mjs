import { infoToast } from '../../lib/toast/toast.mjs';
import * as pag from '../../pages.mjs';
import * as http from '/js/lib/http.mjs';

const htmlUrl = `${URL_COMPONENTS}startForm/startForm.html`;

export 
{
    loadForm
}

function loadForm(object, saveButton)
{
    http.get(htmlUrl)
        .then(response => response.text())
        .then(content =>
        {
            $(object).append(content);
            let button = $(saveButton);
            button.on('click', saveForm);
        })
        .catch(error =>
        {
            console.error('Error:', error);
        });
}




function saveForm()
{
    const form = $('#startForm');
    const imgs = form.find('input[type="file"]');


    sendFormInfo();


    $.each(imgs, function (indexInArray, valueOfElement)
    {
        try 
        {
            const imgName = $(this).attr('name');
            const file = $(this)[0].files[0];
            const formData = new FormData();

            let fileName;
            let originalFile;

            if (file != undefined)
            {

                fileName = selectFileName(imgName);

                originalFile = new File(
                    [file],
                    fileName,
                    { type: "image/png", lastModified: Date.now() }
                );
                formData.append('file', originalFile);

                sendFormImg(imgName, formData)
            }
        }
        catch (e)
        {
            console.warn('No file selected.', $(this).attr('name'));
        }
    });
    // console.log('saved');
    pag.loadPage('home', $('#pageContent'));
    infoToast('High school info saved correctly!', 'Info saved.')
}




function sendFormInfo()
{
    const input = $('input[name="schoolName"]');
    const textWelcome = $('#textareaWelcome');
    const textHiw = $('#textareaHowitworks');

    school_name = input.val().trim();
    text_welcome = textWelcome.val().trim();
    text_hiw = textHiw.val().trim();

    if (school_name != '')
    {
        let body = {
            schoolName: input.val()
        };
        http.send(URL_SCHOOLNAME, body);
    }
    if (text_welcome != '')
    {
        let body = {
            textWelcome: textWelcome.val()
        };
        http.send(URL_WELCOMETEXT, body);
    }
    if (text_hiw != '')
    {
        let body = {
            textHiw: textHiw.val()
        };
        http.send(URL_HIWTEXT, body);
    }
}




function selectFileName(strName)
{
    switch (strName)
    {
        case 'schoolImage1':
            return 'img1';
        case 'schoolImage2':
            return 'img2';
        case 'schoolImage3':
            return 'img3';
        case 'schoolLogo':
            return 'logo';
    }
}





function sendFormImg(imgName, formData)
{
    switch (imgName)
    {
        case 'schoolImage1':
            console.log('Sending img1');
            http.sendImg('http://localhost:3001/upload/', formData);
            break;

        case 'schoolImage2':
            console.log('Sending img2');
            http.sendImg('http://localhost:3001/upload/', formData);
            break;

        case 'schoolImage3':
            console.log('Sending img3');
            http.sendImg('http://localhost:3001/upload/', formData);
            break;

        case 'schoolLogo':
            console.log('Sending logo');
            http.sendImg('http://localhost:3001/upload/', formData);
            break;

        default:
            console.error('Unknown data:', $(this).attr('name'));
    }
}