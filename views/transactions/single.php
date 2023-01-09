<div class="row">

    <div class="col-2 d-flex flex-column" id="sidebar">
        <div class="container-fluid">
        </div> 
        <div class="dropdown m-5 d-flex justify-content-center">
        </div>
    </div>



    <div class="col-10 d-flex flex-column">
        <div class=" d-flex justify-content-end">
            <a href="/transactions/edit?id=<?= $data->transaction->id ?>" class="btn btn-warning" id="transaction_edit">Edit</a>
        </div>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Transaction</th>
                    <th scope="col">Information</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>ID</td>
                    <td><?= $data->transaction->id ?></td>
                </tr>
                <tr>
                    <td>Item Name</td>
                    <td><?= $data->transaction->item_name ?></td>
                </tr>
                <tr>
                    <td>Item ID</td>
                    <td><?= $data->transaction->item_id ?></td>
                </tr>
                <tr>
                    <td>Selling Price</td>
                    <td><?= $data->transaction->selling_price ?></td>
                </tr>
                <tr>
                    <td>Quantity</td>
                    <td><?= $data->transaction->quantity ?></td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td><?= $data->transaction->total_sales ?></td>
                </tr>
                <tr>
                    <td>Created at</td>
                    <td><?= $data->transaction->created_at ?></td>
                </tr>
                <tr>
                    <td>Updated at</td>
                    <td><?= $data->transaction->updated_at ?></td>
                </tr>
            </tbody>
        </table>

        <div class="d-flex justify-content-end mt-5">
            <a href="/transactions/delete?id=<?= $data->transaction->id ?>" class="btn btn-danger " id="transactions_delete">Delete</a>
        </div>
    </div>
</div>