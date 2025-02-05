/**
 * Script author = Hugo Moruno
 */

/**
 * Imports
 */
import * as http from "../../lib/http.mjs";
import * as toast from "../../lib/toast/toast.mjs";

/**
 * Exports
 */
export { loadForm };

/**
 * Constants
 */
const HTMLURL = `${ URL_COMPONENTS }adminForm/adminForm.html`;

/**
 * Info vars
 */
let BTNS_EDIT;
let BTNS_DEL;
let PAG_NUM = 1;
let CAN_EDIT = false;
let ADMIN_BTNS = true;
let LAST_FILTER = "";
let EDITING_ID = 0;

/**
 * Loads the content into the object selected
 * 
 * @param {String} object Object where the content is loaded
 * @param {Boolean} edit If is true, it allows you to edit, if not, doesn't
 * allows you to
 * @param {String} filter Filter that searchs by role
 */
function loadForm(object, edit, filter = "")
{
  let filtered = false;

  //If there's if a filter into the call, it uses the filtered petition
  if (filter.trim() != "")
  {
    filtered = true;
    LAST_FILTER = filter.trim();
  }

  let html = $("<div>");

  http 
    .get(HTMLURL)
    .then((response) =>
    {
      if (!response.ok)
      {
        throw new Error(response.statusText);
      }
      return response.text();
    })
    .then((content) =>
    {
      html.append(content);
      $(object).append(html);
      $("#btnPrevPage").on("click", prevPage).attr({ disabled: "true" });
      $("#btnNextPage").on("click", nextPage);
      $("#rolFilter").on("change", loadRolFilter);
      $("#btnCancelEdit").on("click", closeEditForm);
      $("#btnSaveEdit").on("click", saveEditForm);
      LAST_FILTER = "";

      filtered ? loadData(edit, filter) : loadData(edit);
    })
    .catch((error) =>
    {
      console.error("Error:", error);
    });
}

function loadData(edit, filter = "")
{
  CAN_EDIT = edit;
  LAST_FILTER = filter;
  EDITING_ID = 0;
  let url;
  filter != ""
    ? (url = `${ URL_ALLUSERS }?rol=${ filter }&_page=${ PAG_NUM }&_limit=${ TABLE_DATA_PER_PAGE }`)
    : (url = `${ URL_ALLUSERS }?_page=${ PAG_NUM }&_limit=${ TABLE_DATA_PER_PAGE }`);

  http
    .tryLogin(url)
    .then((response) =>
    {
      if (!response.ok)
      {
        throw new Error(response.statusText);
      }
      return response.json();
    })
    .then((data) =>
    {
      let tbody = $("#tbody_users");

      tbody.empty();

      for (let user of data)
      {
        let tr = $("<tr>")
          .append(
            $("<td>")
              .attr({
                translate: "no",
                class: "col-1 text-center align-middle",
              })
              .text(user.id)
          )
          .append(
            $("<td>")
              .attr({ translate: "no", class: "col-3 align-middle" })
              .text(user.name)
          )
          .append(
            $("<td>")
              .attr({ translate: "no", class: "col-3 align-middle" })
              .text(user.email)
          )
          .append(
            $("<td>")
              .attr({ translate: "no", class: "col-1 align-middle" })
              .text(user.age)
          )
          .append(
            $("<td>")
              .attr({ translate: "no", class: "col-2 align-middle" })
              .text(user.rol)
          )
          .append(
            $("<td>")
              .attr({ translate: "no", class: "col-1 align-middle" })
              .append(
                user.rol != "unassigned"
                  ? '<div class="d-flex aling-items-center justify-content-center px-0 w-75 btn btn-outline-success">' +
                  '<i class="bi bi-caret-up-fill "></i></div>'
                  : '<div class="d-flex aling-items-center justify-content-center px-0 w-75 btn btn-outline-danger">' +
                  '<i class="bi bi-caret-down-fill "></i></div>'
              )
          );

        if (edit && user.id != 1)
        {
          tr.append(
            $("<td>")
              .attr({
                class: "d-flex justify-content-around",
              })
              .append(
                $("<button>")
                  .attr({
                    type: "button",
                    userId: user.id,
                    id: "edit",
                    class: "btn btn-outline-warning mx-1",
                  })
                  .append(
                    $("<i>").attr({
                      class: "bi bi-pencil",
                    })
                  )
              )
              .append(
                $("<button>")
                  .attr({
                    type: "button",
                    userId: user.id,
                    id: "delete",
                    class: "btn btn-outline-danger mx-1",
                  })
                  .append(
                    $("<i>").attr({
                      class: "bi bi-trash",
                    })
                  )
              )
          );
        }
        tbody.append(tr);
      }
      BTNS_EDIT = $('button[id="edit"]');
      BTNS_DEL = $('button[id="delete"]');

      loadFormsEvents();
      adminBtns(ADMIN_BTNS);
    })
    .catch((error) =>
    {
      console.error("Error:", error);
    });
}

function loadFormsEvents()
{
  BTNS_EDIT.on("click", onEdit);
  BTNS_DEL.on("click", onDelete);
}

function nextPage()
{
  PAG_NUM = Number(PAG_NUM) + 1;
  $("#pagNum").text(PAG_NUM);
  $("#btnPrevPage").removeAttr("disabled");
  loadData(CAN_EDIT, LAST_FILTER);
}

function prevPage()
{
  if (PAG_NUM > 1)
  {
    PAG_NUM = Number(PAG_NUM) - 1;
    $("#pagNum").text(PAG_NUM);
    loadData(CAN_EDIT, LAST_FILTER);
  }
  if (PAG_NUM == 1)
  {
    $("#btnPrevPage").attr({ disabled: "true" });
  }
}

function onEdit()
{
  openEditForm(Number($(this).attr("userId")));
  ADMIN_BTNS = false;
  EDITING_ID = Number($(this).attr("userId"));
  adminBtns(ADMIN_BTNS);
}

function onDelete()
{
  toast.askToast(
    "Are you sure that you want to delete this User?",
    "Delete user",
    deleteUser,
    $(this).attr("userId")
  );
}

function deleteUser(id)
{
  http.del(`${ URL_ALLUSERS }`, id).then((response) =>
  {
    if (!response.ok)
    {
      toast.warnToast("Cannot delete user!", "Deleted User");
      throw new Error();
    }
    toast.infoToast("User deleted correctly!", "Deleted User");
    loadData(CAN_EDIT, LAST_FILTER);
    return response.json();
  });
}

function openEditForm(id)
{
  $("#editForm").removeClass("d-none");
  http
    .tryLogin(`${ URL_ALLUSERS }`)
    .then((response) =>
    {
      if (!response.ok)
      {
        throw new Error(response.statusText);
      }
      return response.json();
    })
    .then((data) =>
    {
      let user = data.find((user) => user.id === id);
      fillEditForm(user);
    })
    .catch((error) => console.error(error));
}

function fillEditForm(User)
{
  $("#mail").val(User.email);
  $("#name").val(User.name);
  $("#age").val(User.age);
  $("#rolSelector").val(User.rol);
}

function clearEditForm()
{
  $("#mail").val("");
  $("#name").val("");
  $("#age").val("");
  $("#rolSelector").val("");
}

function loadRolFilter()
{
  $(this).val() == "all"
    ? loadData(CAN_EDIT)
    : loadData(CAN_EDIT, $(this).val());
}

function saveEditForm()
{
  let body = {
    email: $("#mail").val(),
    name: $("#name").val(),
    age: $("#age").val(),
    rol: $("#rolSelector").val(),
  };

  http.update(`${ URL_ALLUSERS }/${ EDITING_ID }`, body).then((response) =>
  {
    if (!response.ok)
    {
      toast.warnToast("Cannot edit user!", "Edit User");
      throw new Error();
    }
    toast.infoToast("User editted correctly!", "Edit User");
    loadData(CAN_EDIT, LAST_FILTER);
    return response.json();
  });

  closeEditFormAction();
}

function closeEditForm()
{
  closeEditFormAction();
}

function closeEditFormAction()
{
  clearEditForm();
  ADMIN_BTNS = true;
  EDITING_ID = 0;
  adminBtns(ADMIN_BTNS);

  $("#editForm").addClass("d-none");
}

function adminBtns(abled)
{
  if (abled)
  {
    BTNS_EDIT.removeAttr("disabled");
    BTNS_DEL.removeAttr("disabled");
  } else
  {
    BTNS_EDIT.attr({ disabled: "true" });
    BTNS_DEL.attr({ disabled: "true" });
  }
}
