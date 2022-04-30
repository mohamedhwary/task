
$(document).ready(function () {

    $('#productsTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/products/list",
        columns: [
            { data: 'id' },
            { data: 'name' },
            { data: 'description' },
            { data: 'quantity' },
            { data: 'price' },
            { data: 'user_id' },
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

        ]
    });

});

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
                porductId:porductId,
                name:name,
                desc:desc,
                qty:qty,
                price:price,
                
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

function deleteProduct(colId){
    
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
                porductId:porductId,
            },
            success: function (data) {
                $('#deleteProduct').modal('hide');
                if (data) {
                    $(".qua_" + porductId).parent().parent().remove();
                }
            }
        });


})

$('#newProductbtn').click(function () {
    
    $('#newProduct').modal('show');
})


$('#addNewProduct').click(function () {


    if ($("#newname").val() == "") {
        alert('name cannot be empty');
    } else {
        var name = $("#newname").val();
        var desc = $("#newdesc").val();
        var qty = $("#newqty").val();
        var price = $("#newprice").val();
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: "products/newProduct",
            data: {
                name:name,
                desc:desc,
                qty:qty,
                price:price,
                
            },
            success: function (data) {
                
            }
        });
    }
})