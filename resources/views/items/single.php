<div class="row">

    <div class="col-2 d-flex flex-column" id="sidebar">
        <div class="container-fluid">
        </div> 
        <div class="dropdown m-5 d-flex justify-content-center">
        </div>
    </div>



    <div class="col-10 d-flex flex-column">
        <div class=" d-flex justify-content-end">
            <a href="/items/edit?id=<?= $data->item->id ?>" class="btn btn-warning" id="item_edit">Edit</a>
        </div>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Item</th>
                    <th scope="col">Information</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>ID</td>
                    <td><?= $data->item->id ?></td>
                </tr>
                <tr>
                    <td>Item Name</td>
                    <td><?= $data->item->item_name ?></td>
                </tr>
                <tr>
                    <td>Cost Price</td>
                    <td><?= $data->item->cost_price ?></td>
                </tr>
                <tr>
                    <td>Selling Price</td>
                    <td><?= $data->item->selling_price ?></td>
                </tr>
                <tr>
                    <td>Quantity</td>
                    <td><?= $data->item->quantity ?></td>
                </tr>
                <tr>
                    <td>Created at</td>
                    <td><?= $data->item->created_at ?></td>
                </tr>
                <tr>
                    <td>Updated at</td>
                    <td><?= $data->item->updated_at ?></td>
                </tr>
            </tbody>
        </table>

        <div class="d-flex justify-content-end mt-5">
            <a href="/items/delete?id=<?= $data->item->id ?>" class="btn btn-danger " id="item_delete">Delete</a>
        </div>
    </div>
</div>