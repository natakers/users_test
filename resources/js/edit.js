$(document).on("click", ".edit", function (event) {
    event.stopPropagation();
    let id = event.target.getAttribute("data-id");
    $.ajax({
        url: `/api/users/${id}`,
        type: "GET",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (response) {
            $('input[name="name"]').val(response.name);
            $('input[name="email"]').val(response.email);
            $('input[name="idUser"]').val(id);
            $("#modal").addClass("show");
            $("#modal").css("display", "block");
        },
        error: function () {
            alert('Something go wrong')
        }
    });
});
