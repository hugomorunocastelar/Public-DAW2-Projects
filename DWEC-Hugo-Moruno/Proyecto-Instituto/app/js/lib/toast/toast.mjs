/**
 * Script author = Hugo Moruno
 */

/**
 * Exports
 */
export { infoToast, warnToast, askToast, failToast };

/**
 * Objects
 */
const OBJ_TOAST = $("#toast");
const OBJ_BOX = $("#toastBox");

/**
 * It shows the toast
 */
function showInfo()
{
  OBJ_BOX.removeClass("d-none");
}

/**
 * Ir hides the toast
 */
function hideInfo()
{
  OBJ_BOX.addClass("d-none");
}

/**
 * Toast that shows some info to the client
 * 
 * @param {String} message Message of the toast
 * @param {String} title Title of the toast
 */
function infoToast(message, title)
{
  //Creation of the corpse 
  let toast = $("<div>")
    .attr({
      class: "card p-3",
      style:
        "position: absolute; width: 400px; height: 300px; background-color: lightblue;",
    })
    .append(
      $("<h1>", { class: "text-center" }).text(title),
      $("<div>", {
        class: "h-100 d-flex align-items-center justify-content-center",
      }).append($("<p>", { class: "toast-body" }).text(message))
    );
  
  //Empties the old code, and appends the created one.
  OBJ_TOAST.empty();
  OBJ_TOAST.append(toast);

  //Then shows it
  showInfo();
}

/**
 * Toast that warns info to the client
 * 
 * @param {String} message Message of the toast
 * @param {String} title Title of the toast
 */
function warnToast(message, title)
{
  //Creation of the corpse 
  let toast = $("<div>")
    .attr({
      class: "card p-3",
      style:
        "position: absolute; width: 400px; height: 300px; background-color: cornsilk;",
    })
    .append(
      $("<h1>", { class: "text-center" }).text(title),
      $("<div>", {
        class: "h-100 d-flex align-items-center justify-content-center",
      }).append($("<p>", { class: "toast-body" }).text(message)),
      $("<div>", {
        class: "d-flex align-items-center justify-content-end",
      }).append(
        $("<button>", { class: "btn btn-warning text-center w-25" })
          .text("Accept")
          .on("click", hideInfo)
      )
    );

  //Empties the old code, and appends the created one.
  OBJ_TOAST.empty();
  OBJ_TOAST.append(toast);

  //Then shows it
  showInfo();
}

/**
 * Toast that ask to the client, if accept, then does the passed method
 * 
 * @param {String} message Message of the toast
 * @param {String} title Title of the toast
 */
function askToast(message, title, method, methoddata)
{
  //Creation of the corpse
  let toast = $("<div>")
    .attr({
      class: "card p-3",
      style:
        "position: absolute; width: 400px; height: 300px; background-color: lightsalmon;",
    })
    .append(
      $("<h1>", { class: "text-center" }).text(title),
      $("<div>", {
        class: "h-100 d-flex align-items-center justify-content-center",
      }).append($("<p>", { class: "toast-body" }).text(message)),
      $("<div>", {
        class: "d-flex align-items-center justify-content-between",
      }).append(
        $("<button>", { class: "btn btn-warning text-center w-25" })
          .text("Cancel")
          .on("click", () =>
          {
            hideInfo();
          }),
        $("<button>", { class: "btn btn-danger text-center w-25" })
          .text("Accept")
          .on("click", () =>
          {
            hideInfo();
            method(methoddata);
          })
      )
    );

  //Deletes old code from the toast, appends the new
  OBJ_TOAST.empty();
  OBJ_TOAST.append(toast);

  //Then, shows it
  showInfo();
}

/**
 * Toast that ask to the client, if accept, then does the passed method
 * 
 * @param {*} message Message that shows in the toast
 * @param {*} title Title of the toast
 */
function failToast(message, title)
{
  //Creates the corpse
  let toast = $("<div>")
    .attr({
      class: "card p-3",
      style:
        "position: absolute; width: 400px; height: 300px; background-color: lightcoral;",
    })
    .append(
      $("<h1>", { class: "text-center" }).text(title),
      $("<div>", {
        class: "h-100 d-flex align-items-center justify-content-center",
      }).append($("<p>", { class: "toast-body" }).text(message)),
      $("<div>", {
        class: "d-flex align-items-center justify-content-end",
      }).append(
        $("<button>", { class: "btn btn-warning text-center w-25" })
          .text("Accept")
          .on("click", hideInfo)
      )
    );

  //Deletes old code from the toast, appends the new
  OBJ_TOAST.empty();
  OBJ_TOAST.append(toast);

  //Then, shows it
  showInfo();
}
