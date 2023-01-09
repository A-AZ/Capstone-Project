    <h1 class="d-flex justify-content-around mt-5">Stock Management</h1>
    <div class="d-flex justify-content-end">
        <a href="/items/create?id=" class="btn btn-primary" id="item_create">Create</a>
    </div>
    <hr>


    <div id="items_data" class="my-5">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Item</th>
                    <th scope="col">Cost Price</th>
                    <th scope="col">Selling Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Updated At</th>
                    <th scope="col">Manage</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data->items as $item) : ?>
                    <tr>
                        <td><?= $item->id ?></td>
                        <td><?= $item->item_name ?></td>
                        <td><?= $item->cost_price ?></td>
                        <td><?= $item->selling_price ?></td>
                        <td><?= $item->quantity ?></td>
                        <td><?= $item->created_at ?></td>
                        <td><?= $item->updated_at ?></td>
                        <td><a href="./item?id=<?= $item->id ?>" class="btn btn-primary btn-sm">View</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>