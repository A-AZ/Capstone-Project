<h2 class="d-flex justify-content-around mt-5">User Management</h2>
<hr>

<div class="d-flex justify-content-end mb-5">
    <a href="/users/edit?id=<?= $data->user->id ?>" class="btn btn-warning" id="user_edit">Edit</a>
</div>

<div class="row ">
    <div class="col-12 d-flex flex-column align-items-center">

        <table class="table table-striped table-hover">
            <thead class="table table-dark">
                <tr>
                    <th scope="col">User</th>
                    <th scope="col">Information</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>ID</td>
                    <td><?= $data->user->id ?></td>
                </tr>
                <tr>
                    <td>Name</td>
                    <td><?= $data->user->display_name ?></td>
                </tr>
                <tr>
                    <td>username</td>
                    <td><?= $data->user->username ?></td>
                </tr>
                <tr>
                    <td>Role</td>
                    <td><?= $data->user->role ?></td>
                </tr>
                <tr>
                    <td>Created at</td>
                    <td><?= $data->user->created_at ?></td>
                </tr>
                <tr>
                    <td>Updated at</td>
                    <td><?= $data->user->updated_at ?></td>
                </tr>
            </tbody>
        </table>

        <hr>
        <div class=" w-50">
            <table class="table table-striped table-hover ">
                <thead class="table table-dark">
                    <tr>
                        <th class="text-center" scope="col">Transaction ID</th>
                        <th scope="col">Manage</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data->related_transactions as $related_transaction) : ?>
                        <tr>
                            <td class="text-center"><?= $related_transaction ?></td>
                            <td><a href="./transaction?id=<?= $related_transaction ?>" class="btn btn-primary btn-sm">View</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>


        <div class="d-flex justify-content-end mt-5">
            <a href="/users/delete?id=<?= $data->user->id ?>" class="btn btn-danger " id="user_delete">Delete User</a>
        </div>
    </div>
</div>