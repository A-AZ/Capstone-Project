<h3 class="d-flex justify-content-around mt-5">Edit User</h3>
<hr>

<div class="d-flex justify-content-center">
    <form action="/users/update" method="POST" class="mt-5 w-75">
        <input type="hidden" name="id" value="<?= $data->user->id ?>" reqiuired>
        <div class="input-group mb-3 ">
            <span class="input-group-text" for="display_name">Name</span>
            <input type="text" class="form-control" id="a_display_name" name="display_name" value="<?= $data->user->display_name ?>" reqiuired>
        </div>

        <div class="input-group mb-3 ">
            <span class="input-group-text" for="username">Username</span>
            <input type="text" class="form-control" id="a_username" name="username" step="any" value="<?= $data->user->username ?>" reqiuired>
        </div>
        <div class="input-group mb-3 ">
            <span class="input-group-text" for="password">Password</span>
            <input type="password" class="form-control" id="a_password" name="password" reqiuired>
        </div>
        <div class="input-group mb-3 ">
            <span class="input-group-text" for="email">email</span>
            <input type="email" class="form-control" id="a_email" name="email" value="<?= $data->user->email ?>" reqiuired>
        </div>

        <div class="input-group mb-3 ">
            <span class="input-group-text" for="role">Role</span>
            <select class="form-select" id="a_role" name="role" reqiuired>
                <option selected></option>
                <option value="admin">Admin</option>
                <option value="accountant">Accountant</option>
                <option value="procurement">Procurement</option>
                <option value="seller">Seller</option>
            </select>
        </div>


        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-warning mt-4">Update</button>
        </div>
    </form>
</div>