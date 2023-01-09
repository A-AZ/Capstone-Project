<div class="row container">

    <div class="col-2 d-flex flex-column" id="sidebar">
        <div class="container">
        </div> 
        <div class="dropdown m-5 d-flex justify-content-center">
        </div>
    </div>



    <div class="col-10 d-flex flex-column">
        <div class=" d-flex justify-content-end">
            <a href="/users/edit?id=<?= $data->user->id ?>" class="btn btn-warning" id="user_edit">Edit</a>
        </div>

        <table class="table table-hover">
            <thead>
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
        <div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Transaction ID</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($data->related_transactions as $related_transaction) : ?>                
                <tr>
                    <td><?= $related_transaction ?></td>
                    <td><a href="./transaction?id=<?= $related_transaction ?>" class="btn btn-primary btn-sm">View</a></td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>


        <div class="d-flex justify-content-end mt-5">
            <a href="/users/delete?id=<?= $data->user->id ?>" class="btn btn-danger " id="user_delete">Delete</a>
        </div>
    </div>
</div>