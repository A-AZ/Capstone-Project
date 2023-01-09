<div class="row container">

    <div class="col-2 d-flex flex-column" id="sidebar">
        <div class="container">
        </div> 
        <div class="dropdown m-5 d-flex justify-content-center">
        </div>
    </div>



    <div class="col-10 d-flex flex-column">
        <div class=" d-flex justify-content-end">
            <a href="/profile/edit?id=<?= $_SESSION['user']['id'] ?>" class="btn btn-warning" id="profile_edit">Edit</a>
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