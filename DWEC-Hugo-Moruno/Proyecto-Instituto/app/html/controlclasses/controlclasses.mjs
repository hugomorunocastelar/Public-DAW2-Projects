/**
 * Script author = Hugo Moruno
 * 
 * Creation date = 7/11/2024
 */

import * as http from '../../js/lib/http.mjs';
import * as toast from '../../js/lib/toast/toast.mjs';

/**
 * Exports
 */

export
{
    init
}

import * as start from '../../js/components/classesForm/classesScript.mjs';

/**
 * Objects
 */

const OBJ_FORMCONTENT = '#controlclassesContent';

/**
 * Main code
 */

function init() 
{
    start.loadForm(OBJ_FORMCONTENT);

    $('#btnCreateClass').off().on('click', createClass);
    $('#btnDeleteClass').off().on('click', deleteClass);

};

function createClass()
{

    if ($('#classNameInput').val().trim() != '')
    {
        let body =
        {
            name: $('#classNameInput').val(),
            profs: [],
            alums: []
        }

        http.sendAuth(`${URL_ALLCLASSES}`, body)
            .then(response =>
            {
                if (!response.ok)
                {
                    toast.warnToast('Failed to create Class.', 'Create Class.');
                    $('#classNameInput').val('');
                    throw new Error();
                }
                toast.infoToast('Class created correctly!', 'Create Class.');
                return response.json();
            })
            .catch(error => console.log(error));
    }
}

function deleteClass()
{

    http.tryLogin(`${URL_ALLCLASSES}?name=${$('#className').text()}`)
        .then(response =>
        {
            if (!response.ok)
            {
                toast.warnToast('Failed to find Class.', 'Delete Class.');
                throw new Error();
            }
            return response.json();
        })
        .then(data =>
        {
            data = data[0];
            toast.askToast('Are you sure that you want to delete this class?', 'Delete Class', () => 
            {
                http.del(`${URL_ALLCLASSES}`, data.id)
                    .then(response =>
                    {
                        if (!response.ok)
                        {
                            toast.warnToast('Failed to delete Class.', 'Delete Class.');
                            $('#classNameInput').val('');
                            throw new Error();
                        }
                        toast.infoToast('Class deleted correctly!', 'Delete Class.');
                        return response.json();
                    })
                    .catch(error => console.log(error));
            })
        })
        .catch(error => console.log(error));


}