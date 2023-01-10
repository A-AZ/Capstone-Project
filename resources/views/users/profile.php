<h2 class="d-flex justify-content-around mt-5">Profile Page</h2>
<hr>

<div class="d-flex justify-content-end mb-5">
    <a href="/profile/edit?id=<?= $_SESSION['user']['id'] ?>" class="btn btn-warning" id="profile_edit">Edit</a>
</div>

<div class="row">
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
            </tbody>
        </table>
    </div>
</div>