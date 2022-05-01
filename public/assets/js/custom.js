
$(document).ready(function () {
    $('.categorySelect').select2();

    $('#productsTable').DataTable({
        processing: true,
        serverSide: true,
        order: [[6, "desc"]],
        ajax: "/products/list",
        columns: [
            { data: 'id' },
            { data: 'name' },
            { data: 'description' },
            { data: 'quantity' },
            { data: 'price' },
            { data: 'user_id' },
            { data: 'updated_at' },
            { data: 'actions' },
        ],
        "columnDefs": [{
            "targets": 3,

            "render": function (data, type, row, meta) {

                return '<span class="qua_' + row.id + '">' + data + '</span>';
            },

        }
        ]
    });

    $('#categoryTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/categories/list",
        columns: [
            { data: 'id' },
            { data: 'name' },
            { data: 'assign' },
            { data: 'actions' },

        ],
        "columnDefs": [{
            "targets": 1,

            "render": function (data, type, row, meta) {

                return '<span class="qua_' + row.id + '">' + data + '</span>';
            },

        }
        ]
    });


    $('#usersTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "users/list",
        columns: [
            { data: 'id' },
            { data: 'name' },
            { data: 'email' },
            { data: 'actions' },

        ],
        "columnDefs": [{
            "targets": 2,

            "render": function (data, type, row, meta) {

                return '<span class="qua_' + row.id + '">' + data + '</span>';
            },

        }
        ]
    });

});

//function Products
function removeQunt(value) {


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: "POST",
        url: "products/removeQuantity",
        data: {
            id: value
        },
        success: function (data) {
            if (data == 0) {
                $(".qua_" + value).parent().parent().remove();
            } else {
                $(".qua_" + value).html(data);
            }

        }
    });


}



function updateProduct(colId) {


    $('#editModel').modal('show');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: "POST",
        url: "products/getProduct",
        data: {
            id: colId
        },
        success: function (data) {
            $("#porductId").val(data.id);
            $("#name").val(data.name);
            $("#desc").val(data.description);
            $("#qty").val(data.quantity);
            $("#price").val(data.price);

        }
    });
}



$('#saveChangeProduct').click(function () {


    if ($("#name").val() == "") {
        alert('name cannot be empty');
    } else {
        var porductId = $("#porductId").val();
        var name = $("#name").val();
        var desc = $("#desc").val();
        var qty = $("#qty").val();
        var price = $("#price").val();


        $.ajax({
            type: "POST",
            url: "products/updateProduct",
            data: {
                porductId: porductId,
                name: name,
                desc: desc,
                qty: qty,
                price: price,

            },
            success: function (data) {
                $('#editModel').modal('hide');
                // $('#productsTable').destory();
                // $('#productsTable').DataTable({
                //     processing: true,
                //     serverSide: true,
                //     ajax: "/products/list",
                //     columns: [
                //         { data: 'id' },
                //         { data: 'name' },
                //         { data: 'description' },
                //         { data: 'quantity' },
                //         { data: 'price' },
                //         { data: 'user_id' },
                //         { data: 'actions' },
                //     ],
                //     "columnDefs": [{
                //         "targets": 3,

                //         "render": function (data, type, row, meta) {

                //             return '<span class="qua_' + row.id + '">' + data + '</span>';
                //         },

                //     }
                //     ]
                // });
            }
        });

    }
})

function deleteProduct(colId) {

    $('#deleteProduct').modal('show');
    $("#porductId").val(colId);
}

$('#deleteProductBtn').click(function () {


    var porductId = $("#porductId").val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "POST",
        url: "products/deleteProduct",
        data: {
            porductId: porductId,
        },
        success: function (data) {
            $('#deleteProduct').modal('hide');
            if (data) {
                $(".qua_" + porductId).parent().parent().remove();
            }
        }
    });


})

//function Products END


//function User
function updateUser(colId) {


    $('#editModel').modal('show');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: "POST",
        url: "users/getUser",
        data: {
            id: colId
        },
        success: function (data) {
            $("#userId").val(data.id);
            $("#name").val(data.name);
            $("#email").val(data.email);

        }
    });
}
$('#saveChangeUser').click(function () {


    if ($("#name").val() == "") {
        alert('name cannot be empty');
    } else {
        var userId = $("#userId").val();
        var name = $("#name").val();
        var email = $("#email").val();



        $.ajax({
            type: "POST",
            url: "users/updateUser",
            data: {
                userId: userId,
                name: name,
                email: email,


            },
            success: function (data) {
                $('#editModel').modal('hide');
                // $('#productsTable').destory();
                // $('#productsTable').DataTable({
                //     processing: true,
                //     serverSide: true,
                //     ajax: "/products/list",
                //     columns: [
                //         { data: 'id' },
                //         { data: 'name' },
                //         { data: 'description' },
                //         { data: 'quantity' },
                //         { data: 'price' },
                //         { data: 'user_id' },
                //         { data: 'actions' },
                //     ],
                //     "columnDefs": [{
                //         "targets": 3,

                //         "render": function (data, type, row, meta) {

                //             return '<span class="qua_' + row.id + '">' + data + '</span>';
                //         },

                //     }
                //     ]
                // });
            }
        });

    }
})

function deleteUser(colId) {

    $('#deleteUser').modal('show');
    $("#userId").val(colId);
}

$('#deleteUserBtn').click(function () {


    var userId = $("#userId").val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "POST",
        url: "users/deleteUser",
        data: {
            userId: userId,
        },
        success: function (data) {
            $('#deleteUser').modal('hide');
            if (data) {
                $(".qua_" + userId).parent().parent().remove();
            }
        }
    });


})

//function User END

//function category
function updateCategory(colId) {


    $('#editModel').modal('show');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: "POST",
        url: "categories/getCategory",
        data: {
            id: colId
        },
        success: function (data) {
            if (data == 'false') {
                alert('can not delete category')
            } else {
                $("#categoryId").val(data.id);
                $("#name").val(data.name);
            }
        }
    });
}
$('#saveChangeCategory').click(function () {

    var name = $("#name").val();
    if (name == "") {
        alert('name cannot be empty');
    } else {
        var categoryId = $("#categoryId").val();
        var name = $("#name").val();



        $.ajax({
            type: "POST",
            url: "categories/updateCategory",
            data: {
                categoryId: categoryId,
                name: name,
            },
            success: function (data) {
                $('#editModel').modal('hide');
                // $('#productsTable').destory();
                // $('#productsTable').DataTable({
                //     processing: true,
                //     serverSide: true,
                //     ajax: "/products/list",
                //     columns: [
                //         { data: 'id' },
                //         { data: 'name' },
                //         { data: 'description' },
                //         { data: 'quantity' },
                //         { data: 'price' },
                //         { data: 'user_id' },
                //         { data: 'actions' },
                //     ],
                //     "columnDefs": [{
                //         "targets": 3,

                //         "render": function (data, type, row, meta) {

                //             return '<span class="qua_' + row.id + '">' + data + '</span>';
                //         },

                //     }
                //     ]
                // });
            }
        });

    }
})

function deleteCategory(colId) {

    $('#deleteCategory').modal('show');
    $("#categoryId").val(colId);
}

$('#deleteCategoryBtn').click(function () {


    var categoryId = $("#categoryId").val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "POST",
        url: "categories/deleteCategory",
        data: {
            categoryId: categoryId,
        },
        success: function (data) {
            $('#deleteCategory').modal('hide');
            if (data) {
                $(".qua_" + categoryId).parent().parent().remove();
            }
        }
    });


})

//function category END

