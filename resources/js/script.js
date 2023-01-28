$(function () {
    if (location.href == 'http://pos_demo.local/sales') { // excute ajax requests only in selling page!

        baseUrl = "http://pos_demo.local/";
        const quantity = $('#item_quantity');
        const sellingPrice = $('#selling_price');
        const add = $('#add');
        const table = $('#transactions_data');
        let total = $(`#total-sales`);

        sellingPrice, quantity.keyup(function () {
            total.text(sellingPrice.val() * quantity.val());
        });

        sellingPrice, quantity.mouseup(function () {
            total.text(sellingPrice.val() * quantity.val());
        });


        $(`#items_name`).change(function (e) {
            var price = $(this).find(':selected').data('price');
            var itemId = $(this).find(':selected').data('item_id');
            $(`#selling_price`).val(price);
            $(`#item_id`).val(itemId);
        });

        /**
         * get all the transactions that has been today by the current logged in user today
         */
        $.ajax({
            type: "GET",
            url: baseUrl + "sales/get",
            success: function (response) {
                response.body.forEach((t => {
                    table.append(`
                <tr data-id="${t.id}">
                <td>${t.id}</td>
                <td>${t.item_name}</td>
                <td>${t.item_id}</td>
                <td>${t.quantity}</td>
                <td>${t.selling_price}</td>
                <td>${t.total_sales}</td>
                <td><button data-id="edit_${t.id}" class="btn btn-warning btn-sm">Edit</button></td>
                <td><button data-id="delete_${t.id}" class="btn btn-danger btn-sm">Delete</button></td>
                </tr>
                `);
                    console.log(response);

                    $(`button[data-id="edit_${t.id}"]`).click(function (e) {
                        if ($('#items_name').val() === "" || $('#item_quantity').val() === "") {
                            alert('Please Enter All the Inputs !');
                            return false;
                        }
                        e.preventDefault();
                        /**
                         * to update the transaction that has been made today by the current logged in user
                         */
                        $.ajax({
                            type: "PUT",
                            url: baseUrl + "sales/put",
                            data: JSON.stringify({
                                id: t.id,
                                item_name: $('#items_name').val(),
                                quantity: $('#item_quantity').val(),
                                selling_price: $(`#selling_price`).val(),
                                total_sales: $(`#total-sales`).text(),
                                item_id: $('#item_id').val(),
                            }),
                            success: function (response) {
                                $(`tr[data-id="${t.id}"]`).find('td:nth-child(2)').text($('#items_name').val());
                                $(`tr[data-id="${t.id}"]`).find('td:nth-child(3)').text($('#item_id').val());
                                $(`tr[data-id="${t.id}"]`).find('td:nth-child(4)').text($('#item_quantity').val());
                                $(`tr[data-id="${t.id}"]`).find('td:nth-child(5)').text($('#selling_price').val());
                                $(`tr[data-id="${t.id}"]`).find('td:nth-child(6)').text($(`#total-sales`).text());
                                console.log(response);
                            },
                        });
                        $('#inputForm').trigger('reset');
                        $("#total-sales").text("0");
                    });
                     /**
                      * delete the transaction
                      */
                    $(`button[data-id="delete_${t.id}"]`).click(function () {
                        $.ajax({
                            type: "DELETE",
                            url: baseUrl + "sales/delete",
                            data: JSON.stringify({
                                id: t.id,
                                quantity: t.quantity,
                                item_id: t.item_id,
                            }),
                            success: function (response) {
                                console.log(response);
                            },
                        });
                        $(`tr[data-id="${t.id}"]`).hide('slow', function () {
                            $(this).remove();
                        });
                    });

                }));
            }
        });

        add.click(function (e) {
            e.preventDefault();
            if ($('#items_name').val() === "" || $('#item_quantity').val() === "") {
                alert('Please Enter All the Inputs !');
                return false;
            }
            let data = {
                item_name: $('#items_name').val(),
                quantity: $('#item_quantity').val(),
                item_id: $('#item_id').val(),
                selling_price: $(`#selling_price`).val(),
                total_sales: $(`#total-sales`).text(),
            };

            /**
             * create new transaction 
             */
            $.ajax({
                type: "POST",
                url: baseUrl + "sales/post",
                data: JSON.stringify(data),
                success: function (response) {
                    response.body.forEach(t => {
                        console.log(response);
                        table.append(`
                            <tr data-id="${t.id}">
                            <td>${t.id}</td>
                            <td>${t.item_name}</td>
                            <td>${t.item_id}</td>
                            <td>${t.quantity}</td>
                            <td>${t.selling_price}</td>
                            <td>${t.total_sales}</td>
                            <td><button data-id="edit_${t.id}" class="btn btn-warning btn-sm">Edit</button></td>
                            <td><button data-id="delete_${t.id}" class="btn btn-danger btn-sm">Delete</button></td>
                            </tr>
                        `);
                        $('#inputForm').trigger('reset');
                        $("#total-sales").text("0");

                        $(`button[data-id="edit_${t.id}"]`).click(function (e) {
                            e.preventDefault();
                            if ($('#items_name').val() === "" || $('#item_quantity').val() === "") {
                                alert('Please Enter All the Inputs !');
                                return false;
                            }
                            /**
                             * update the created transaction
                             */
                            $.ajax({
                                type: "PUT",
                                url: baseUrl + "sales/put",
                                data: JSON.stringify({
                                    id: t.id,
                                    item_name: $('#items_name').val(),
                                    quantity: $('#item_quantity').val(),
                                    selling_price: $(`#selling_price`).val(),
                                    total_sales: $(`#total-sales`).text(),
                                    item_id: $('#item_id').val(),
                                }),
                                success: function (response) {
                                    $(`tr[data-id="${t.id}"]`).find('td:nth-child(2)').text($('#items_name').val());
                                    $(`tr[data-id="${t.id}"]`).find('td:nth-child(3)').text($('#item_id').val());
                                    $(`tr[data-id="${t.id}"]`).find('td:nth-child(4)').text($('#item_quantity').val());
                                    $(`tr[data-id="${t.id}"]`).find('td:nth-child(5)').text($('#selling_price').val());
                                    $(`tr[data-id="${t.id}"]`).find('td:nth-child(6)').text($(`#total-sales`).text());
                                    console.log(response);
                                },
                            });
                            $('#inputForm').trigger('reset');
                            $("#total-sales").text("0");
                        });

                        /**
                         * delete the created transation
                         */
                        $(`button[data-id="delete_${t.id}"]`).click(function () {
                            $.ajax({
                                type: "DELETE",
                                url: baseUrl + "sales/delete",
                                data: JSON.stringify({
                                    id: t.id,
                                    quantity: t.quantity,
                                    item_id: t.item_id,
                                }),
                                success: function (response) {
                                    console.log(response);
                                },
                            });
                            $(`tr[data-id="${t.id}"]`).hide('slow', function () {
                                $(this).remove();
                            });
                        });
                    });
                },
            });
        });
    }
});


