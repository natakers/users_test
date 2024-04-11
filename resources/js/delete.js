$(document).on("click", ".delete", function (event) {
    event.stopPropagation();
    let id = event.target.getAttribute("data-id");
    $.ajax({
        url: `/api/users/${id}`,
        type: "DELETE",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (response) {
            let tr = $(`tr[data-id=${id}]`);
            tr.remove();
            const lastTr = $("tr").last();
            const newId = lastTr.data("id");
            if (newId) {
                $.ajax({
                    url: `api/users/next/${newId}`,
                    type: "GET",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    success: function (response) {
                        let td = $("<td>", {
                            text: response.name,
                        });
                        let tr = $("<tr></tr>");
                        tr.append(td);
                        td = $("<td>", {
                            text: response.email,
                        });
                        tr.append(td);
                        let btnEdit = $("<button>", {
                            text: "Edit",
                            type: "button",
                            class: "btn btn-primary edit",
                        });
                        btnEdit.attr("data-id", response.id);
                        let btnDelete = $("<button>", {
                            text: "Delete",
                            type: "button",
                            class: "delete btn btn-danger",
                        });
                        btnDelete.attr("data-id", response.id);
                        td = $("<td>", {
                            class: "d-flex justify-content-around",
                        });
                        td.append(btnEdit);
                        td.append(btnDelete);
                        tr.append(td);
                        tr.attr("data-id", response.id);
                        $("table").append(tr);
                    },
                    error: function () {
                        alert('Something go wrong')
                    }
                });
            }
        },
    });
});
