$(document).ready(function() {
    loadItems();

    $("#itemForm").submit(function(e) {
        e.preventDefault();

        var url;

        if ($("#datetime").val()) {
            url = "items/update";
        } else {
            url = "items/add";
        }

        var data = {};
        $.each($('#itemForm').serializeArray(), function(i, field) {
            data[field.name] = field.value;
        });

        $.ajax({
            type: "POST",
            url: url,
            data: { '_token' : $('input[name="_token"]').val()
                  , 'json' : JSON.stringify(data)
            },
            success: function(response) {
                if (url === "items/add") {
                    insertItem(JSON.parse(response));
                } else if (url === "items/update") {
                    updateItem($("#btnUpdate").data("row"), JSON.parse(response));
                }

                resetForm();
            }
        });
    });

    $("#btnCancel").click(function(e) {
        resetForm()
    });
});

/**
 * Makes an AJAX call to load the items stored in items.json.
 */
function loadItems() {
    $.ajax({
        type: "GET",
        url: "items",
        dataType: "JSON",
        data: { '_token' : $('input[name="_token"]').val() },
        success: function(response) {
            for (var i = 0; i < response.length; i++) {
                insertItem(response[i]);
            }
        }
    });
}

/**
 * Inserts an item into the list.
 * @param data
 */
function insertItem(data) {
    var table = $("#itemsTable > tbody");

    var row = $("<tr/>")
        .data('item', data)
        .appendTo(table);

    var edit = $("<a/>")
        .addClass("btnEdit fa fa-edit");

    var product = $("<td/>")
        .append(
            $("<a/>")
                .addClass("btnEdit fa fa-edit")
                .attr("href", "#")
                .click(function(e) {
                    editItem(e, $(this).closest("tr"));
                })
        )
        .append(
            $("<span/>")
                .text(" " + data.product)
        )
        .addClass("row-product")
        .appendTo(row);

    var quantity = $("<td/>")
        .text(data.quantity)
        .addClass("row-quantity")
        .appendTo(row);

    var price = $("<td/>")
        .text(data.price)
        .addClass("row-price")
        .appendTo(row);

    var datetime = $("<td/>")
        .text(data.datetime)
        .addClass("row-datetime")
        .appendTo(row);

    var total = $("<td/>")
        .text(data.price * data.quantity)
        .addClass("row-total")
        .appendTo(row);

    $("#valueSum")
        .text(parseFloat($("#valueSum").text()) + parseFloat(total.text()));
}


/**
 * Updates an existing item in the list.
 * @param row
 * @param data
 */
function updateItem(row, data) {
    // Recalculate totals
    var oldTotal = parseFloat(row.children(".row-total").text());
    var newTotal = parseFloat(data.price) * parseFloat(data.quantity);
    var sumTotal = parseFloat($("#valueSum").text());

    // Update row
    row.children(".row-product")
        .children("span")
        .text(data.product);

    row.children(".row-quantity")
        .text(data.quantity);

    row.children(".row-price")
        .text(data.price);

    row.children(".row-total")
        .text(newTotal);

    row.data("item", data);

    // Update total
    $("#valueSum")
        .text( (sumTotal - oldTotal) + newTotal );
}

/**
 * Populates form with info for existing item to edit.
 * @param e
 * @param row
 */
function editItem(e, row) {
    e.preventDefault();
    var item = row.data('item');

    $("#editButtons").show();
    $("#btnUpdate").data('row', row);
    $("#btnAdd").hide();

    $("#product").val(item.product);
    $("#quantity").val(item.quantity);
    $("#price").val(item.price);
    $("#datetime").val(item.datetime);
}

/**
 * Resets form.
 */
function resetForm() {
    $("#editButtons").hide();
    $("#btnAdd").show();

    $("#itemForm")[0].reset();
    $("#datetime").val('');
    $("#btnUpdate").data("row", null);
}
