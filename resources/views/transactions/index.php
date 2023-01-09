<h1 class="d-flex justify-content-around mt-5">Transactions Management</h1>
    <hr>

    <div class="my-5 table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table table-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Item ID</th>
                    <th scope="col">Item</th>
                    <th scope="col">Selling Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Updated At</th>

                    <th scope="col">Manage</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data->transactions as $transaction) : ?>
                    <tr>
                        <td><?= $transaction->id ?></td>
                        <td><?= $transaction->item_id ?></td>
                        <td><?= $transaction->item_name ?></td>
                        <td><?= $transaction->selling_price ?></td>
                        <td><?= $transaction->quantity ?></td>
                        <td><?= $transaction->created_at ?></td>
                        <td><?= $transaction->updated_at ?></td>
                        <td><a href="./transaction?id=<?= $transaction->id ?>" class="btn btn-primary btn-sm">View</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>