$(document).ready(function() {
    $("#itemForm").submit(function(e) {
        e.preventDefault();
        var data = {product : $("#product").val(),
            qty : $("#qty").val(),
            price : $("#price").val()};

        $.ajax({
            type: "POST",
            url: "./items/add",
            dataType: "JSON",
            data: {json: JSON.stringify(data)},
            success: function(response) {
                alert(response);
                updateTable(response);
            }
        });
    })
});

function updateTable(data) {

}