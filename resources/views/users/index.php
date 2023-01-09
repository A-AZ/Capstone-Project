    <h1 class="d-flex justify-content-around mt-5">User Management</h1>
    <hr>

    <div class="d-flex justify-content-end mt-5">
        <a href="/users/create?id=" class="btn btn-primary" id="user_create">Create</a>
    </div>

    <div  class="my-5 table-responsive">
        <table  class="table table-striped table-hover">
            <thead class="table table-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Display Name</th>
                    <th scope="col">username</th>
                    <th scope="col">Role </th>
                    <th scope="col">Created At</th>
                    <th scope="col">Updated At</th>
                    <th scope="col">Manage</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data->users as $user) : ?>
                    <tr>
                        <td><?= $user->id ?></td>
                        <td><?= $user->display_name ?></td>
                        <td><?= $user->username ?></td>
                        <td><?= $user->role ?></td>
                        <td><?= $user->created_at ?></td>
                        <td><?= $user->updated_at ?></td>
                        <td><a href="./user?id=<?= $user->id ?>" class="btn btn-primary btn-sm">View</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>