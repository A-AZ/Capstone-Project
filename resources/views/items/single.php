<h2 class="d-flex justify-content-around mt-5">Item Management</h2>


<div class=" d-flex justify-content-end mb-5">
    <a href="/items/edit?id=<?= $data->item->id ?>" class="btn btn-warning">Edit</a>
</div>
<div class="row">
    <div class="col-12 d-flex flex-column align-items-center">

        <table class="table table-striped table-hover">
            <thead class="table table-dark">
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
    </div>
</div>

<div class="d-flex justify-content-end mt-5">
    <a href="/items/delete?id=<?= $data->item->id ?>" class="btn btn-danger " id="item_delete">Delete</a>
</div>