import * as http from '../../lib/http.mjs';
import * as classes from '../classesForm/classesScript.mjs';
import * as toast from '../../lib/toast/toast.mjs'

const htmlUrl = `${URL_COMPONENTS}rolesForm/rolesForm.html`;

let PREV_OBJECT;
let PREV_TEMPLATE;

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
      PREV_OBJECT = object;
      PREV_TEMPLATE = content;
      loadData(object, content);
    })
    .catch(error =>
    {
      console.error('Error:', error);
    });
}


function loadData(object, templateOfClasses)
{

  classes.loadForm($('#rolesClasses'));
  $(object).empty();
  let divProfs = $('<div>').attr({ "class": "col-6" });
  let divAlum = $('<div>').attr({ "class": "col-6" });
  let tableProf = $(templateOfClasses);
  let tableAlum = $(templateOfClasses);
  let tbody_profs;
  let tbody_alums;


  http.tryLogin(`${URL_ALLUSERS}?rol=prof`)
    .then(response =>
    {
      if (!response.ok)
      {
        throw new Error(response.statusText);
      }
      return response.json();
    })
    .then(profs =>
    {
      tbody_profs = tableProf.find('#tbody_users');
      for (let prof of profs)
      {
        tbody_profs
          .append(
            $('<tr>')
              .attr({
                "id": "trcheckprof"
              })
              .append(
                $('<td>').append(
                  $('<input>')
                    .attr({
                      "type": "checkbox"
                    })
                ),
                $('<td>').text(prof.id)
                  .attr({
                    "id": "idProf"
                  }),
                $('<td>').text(prof.name),
                $('<td>').text(prof.email),
                $('<td>').text(prof.age)
              )
          )
      }
      divProfs.append(tableProf);
      divProfs.find('#tableTitle').text('Professors');
      $(object).append(divProfs);
    })
    .catch(error =>
    {
      console.error('Error:', error);
    });

  http.tryLogin(`${URL_ALLUSERS}?rol=alum`)
    .then(response =>
    {
      if (!response.ok)
      {
        throw new Error(response.statusText);
      }
      return response.json();
    })
    .then(alums =>
    {
      tbody_alums = tableAlum.find('#tbody_users');
      for (let alum of alums)
      {
        tbody_alums
          .append(
            $('<tr>')
              .attr({
                "id": "trcheckalum"
              })
              .append(
                $('<td>').append(
                  $('<input>')
                    .attr({
                      "type": "checkbox"
                    })
                ),
                $('<td>').text(alum.id)
                  .attr({
                    "id": "idAlum"
                  }),
                $('<td>').text(alum.name),
                $('<td>').text(alum.email),
                $('<td>').text(alum.age)
              )
          )
      }
      divAlum.append(tableAlum);
      divAlum.find('#tableTitle').text('Alumns');
      $(object).append(divAlum);
    })
    .catch(error =>
    {
      console.error('Error:', error);
    });

  $('#btnDelete').off().on('click', deleteUsersFromClass);
  $('#btnLoad').off().on('click', addUsersToClass);
}

function addUsersToClass() 
{

  let addprof = [];
  let addalum = [];

  let profUpdated = [];
  let alumUpdated = [];

  for (let tr of $('#rolesContent #trcheckprof'))
  {

    let chkbox = $(tr).find('input[type="checkbox"]');
    let idProf = $(tr).find('#idProf');

    if (chkbox.prop('checked'))
    {
      addprof.push({
        id: Number(idProf.text())
      });
    }
  }

  for (let tr of $('#rolesContent #trcheckalum'))
  {
    let chkbox = $(tr).find('input[type="checkbox"]');
    let idAlum = $(tr).find('#idAlum');

    if (chkbox.prop('checked'))
    {
      addalum.push({
        id: Number(idAlum.text())
      });
    }
  }

  http.tryLogin(`${URL_ALLCLASSES}?name=${$('#className').text()}`)
    .then(response =>
    {
      if (!response.ok)
      {
        throw new Error(response.statusText);
      }
      return response.json();
    })
    .then(data =>
    {

      data = data[0];

      /**
       * Compare this arrays with the checkeds and create new class, then http.update to de db.
       */



      profUpdated = mixAddLists(data.profs, addprof);
      alumUpdated = mixAddLists(data.alums, addalum);

      let body = {
        id: data.id,
        name: data.name,
        profs: profUpdated,
        alums: alumUpdated,
      }

      console.log(body);

      http.update(`${URL_ALLCLASSES}/${data.id}`, body)
        .then(response =>
        {
          if (!response.ok)
          {
            toast.warnToast('Cannot edit class!', 'Edit Class');
            throw new Error();
          }
          addClassToUsers(addprof, data.id);
          addClassToUsers(addalum, data.id);
          toast.infoToast('Class editted correctly!', 'Edit Class');
          loadData(PREV_OBJECT, PREV_TEMPLATE);
          return response.json();
        });

    })
    .catch(error =>
    {
      console.error('Error:', error);
    });
}

function deleteUsersFromClass()
{
  let delprof = [];
  let delalum = [];

  let profUpdated = [];
  let alumUpdated = [];

  for (let tr of $('#rolesContent #trcheckprof'))
  {

    let chkbox = $(tr).find('input[type="checkbox"]');
    let idProf = $(tr).find('#idProf');

    if (chkbox.prop('checked'))
    {
      delprof.push({
        id: Number(idProf.text())
      });
    }
  }

  for (let tr of $('#rolesContent #trcheckalum'))
  {
    let chkbox = $(tr).find('input[type="checkbox"]');
    let idAlum = $(tr).find('#idAlum');

    if (chkbox.prop('checked'))
    {
      delalum.push({
        id: Number(idAlum.text())
      });
    }
  }



  http.tryLogin(`${URL_ALLCLASSES}?name=${$('#className').text()}`)
    .then(response =>
    {
      if (!response.ok)
      {
        throw new Error(response.statusText);
      }
      return response.json();
    })
    .then(data =>
    {

      data = data[0];

      /**
       * Compare this arrays with the checkeds and create new class, then http.update to de db.
       */

      profUpdated = mixDelLists(data.profs, delprof);
      alumUpdated = mixDelLists(data.alums, delalum);

      let body = {
        id: data.id,
        name: data.name,
        profs: profUpdated,
        alums: alumUpdated,
      }

      http.update(`${URL_ALLCLASSES}/${data.id}`, body)
        .then(response =>
        {
          if (!response.ok)
          {
            toast.warnToast('Cannot edit class!', 'Edit Class');
            throw new Error();
          }
          delClassFromUsers(delprof, data.id);
          delClassFromUsers(delalum, data.id);
          toast.infoToast('Class editted correctly!', 'Edit Class');
          loadData(PREV_OBJECT, PREV_TEMPLATE);
          return response.json();
        });

    })
    .catch(error =>
    {
      console.error('Error:', error);
    });
}

function addClassToUsers(usersarray, classid) 
{
  for (let user of usersarray)
  {
    http.tryLogin(`${URL_ALLUSERS}/${user.id}`)
      .then(response =>
      {
        if (!response.ok)
        {
          throw new Error(response.statusText);
        }
        return response.json();
      })
      .then(data =>
      {
        let classesUser = data.classes;
        let found = false;
        for (let userClassId of classesUser)
        {
          if (userClassId.id == classid)
          {
            found = true;
          }
        }
        if (!found)
        {
          classesUser.push({ id: classid });
        }

        let body = {
          classes: classesUser
        }

        http.update(`${URL_ALLUSERS}/${data.id}`, body)
          .then(response =>
          {
            if (!response.ok)
            {
              throw new Error();
            }
            return response.json();
          })
          .catch(error => console.log(error));
      })
      .catch(error => console.log(error));
  }
}

function delClassFromUsers(usersarray, classid) 
{
  for (let user of usersarray)
  {
    http.tryLogin(`${URL_ALLUSERS}/${user.id}`)
      .then(response =>
      {
        if (!response.ok)
        {
          throw new Error(response.statusText);
        }
        return response.json();
      })
      .then(data =>
      {
        let classesUser = data.classes;
        let finalClasses = [];
        let found = false;
        for (let userClassId of classesUser)
        {
          if (userClassId.id == classid)
          {
            found = true;
          }
        }
        if (!found)
        {
          finalClasses.push({ id: classid });
        }

        let body = {
          classes: finalClasses
        }

        http.update(`${URL_ALLUSERS}/${data.id}`, body)
          .then(response =>
          {
            if (!response.ok)
            {
              throw new Error();
            }
            return response.json();
          })
          .catch(error => console.log(error));
      })
      .catch(error => console.log(error));
  }
}

function mixAddLists(idArray1, idArray2)
{
  let fExists = false;
  let finalArray = [];
  for (let origId of idArray1)
  {
    for (let newId of finalArray)
    {
      if (origId.id == newId.id)
      {
        fExists = true;
      }
    }
    if (!fExists)
    {
      finalArray.push(origId);
    }
    fExists = false;
  }
  for (let origId of idArray2)
  {
    for (let newId of finalArray)
    {
      if (origId.id == newId.id)
      {
        fExists = true;
      }
    }
    if (!fExists)
    {
      finalArray.push(origId);
    }
    fExists = false;
  }
  return finalArray;
}

function mixDelLists(idArray1, idArray2)
{
  let fExists = false;
  let finalArray = [];
  for (let origId of idArray1)
  {
    for (let delId of idArray2)
    {
      if (origId.id == delId.id)
      {
        fExists = true;
      }
    }
    if (!fExists)
    {
      finalArray.push(origId);
    }
    fExists = false;
  }
  return finalArray;
}