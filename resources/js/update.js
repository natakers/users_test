$(document).on("click", ".editSubmit", function (event) {
    event.preventDefault();
    event.stopPropagation();
    let name = $("#name").val();
    let email = $("#email").val();
    let id = $("#idUser").val();
    $(".error_name").removeClass("opacity-100");
    $(".error_name").addClass("opacity-0");
    $(".error_name").empty();
    $(".error_email").removeClass("opacity-100");
    $(".error_email").addClass("opacity-0");
    $(".error_email").empty();
    $.ajax({
        url: `/api/users/${id}`,
        type: "PUT",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        data: {
            name: name,
            email: email,
        },
        success: function () {
            let tr = $(`tr[data-id=${id}]`);
            let children = tr.children();
            children[0].innerHTML = name;
            children[1].innerHTML = email;
            $("#modal").removeClass("show");
            $("#modal").css("display", "none");
        },
        error: function (response) {
            if (
                response.responseJSON.errors.email &&
                response.responseJSON.errors.email[0]
            ) {
                $(".error_email").removeClass("opacity-0");
                $(".error_email").addClass("opacity-100");
                $(".error_email").append(response.responseJSON.errors.email[0]);
            }
            if (
                response.responseJSON.errors.name &&
                response.responseJSON.errors.name[0]
            ) {
                $(".error_name").removeClass("opacity-0");
                $(".error_name").addClass("opacity-100");
                $(".error_name").append(response.responseJSON.errors.name[0]);
            }
        },
    });
});
