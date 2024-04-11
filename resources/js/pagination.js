$(document).on("click", ".page", function (event) {
    event.stopPropagation();
    let id = event.target.getAttribute("data-page");
    $.ajax({
        url: `/?page=${id}`,
        type: "GET",
        dataType: "html",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (response) {
            const body = $("body");
            body.empty();
            body.append(response);
        },
        error: function () {
            alert('Something go wrong')
        }
    });
});
