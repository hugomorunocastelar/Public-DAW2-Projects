import * as http from "../../lib/http.mjs";

const htmlUrl = `${URL_COMPONENTS}profForm/profForm.html`;

export { loadForm };

function loadForm(object)
{
  http
    .get(htmlUrl)
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
      loadClasses(content, object);
    })
    .catch((error) =>
    {
      console.error("Error:", error);
    });
}

function loadClasses(content, object)
{
  http
    .tryLogin(`${URL_USERS}/${session.id}`)
    .then((response) =>
    {
      if (!response.ok)
      {
        throw new Error();
      }
      return response.json();
    })
    .then((data) =>
    {
      formatClasses(data, content, object);
    })
    .catch((error) =>
    {
      console.error(error);
    });
}

function formatClasses(prf, content, object)
{
  http
    .tryLogin(URL_ALLUSERS)
    .then((response) =>
    {
      if (!response.ok)
      {
        throw new Error();
      }
      return response.json();
    })
    .then((users) =>
    {
      http
        .tryLogin(URL_ALLCLASSES)
        .then((response) =>
        {
          if (!response.ok)
          {
            throw new Error();
          }
          return response.json();
        })
        .then((groups) =>
        {
          for (let classId of prf.classes)
          {
            let html = $("<div>");

            let group = groups[classId.id];

            html.append(content);

            html.find("#table_title").text(group.name);
            let tabla = html.find("#tbody_classes");

            for (let alum of group.alums)
            {
              let user = users.find((user) => user.id === alum.id);
              let tr = $("<tr>")
                .append($("<td>").attr({ class: "col-5" }).text(user.name))
                .append($("<td>").attr({ class: "col-5" }).text(user.email))
                .append($("<td>").attr({ class: "col-2" }).text(user.age));
              tabla.append(tr);
            }
            $(object).append(html);
          }
        })
        .catch((error) =>
        {
          console.error(error);
        });
    })
    .catch((error) =>
    {
      console.error(error);
    });
}
