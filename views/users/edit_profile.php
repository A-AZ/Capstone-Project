<h3>Edit User</h3>

<form action="/profile/store" method="POST" class="w-50 mt-5">

    <input type="hidden" name="id" value="<?= $data->user->id ?>"required>
    <div class="input-group mb-3 ">
        <span class="input-group-text" for="display_name">Name</span>
        <input type="text" class="form-control" id="display_name" name="display_name" value="<?= $data->user->display_name ?>"  required>
    </div>

    <div class="input-group mb-3 ">
        <span class="input-group-text" for="username">Username</span>
        <input type="text" class="form-control" id="username" name="username" step="any" value="<?= $data->user->username ?>"  required>
    </div>
    
    <div class="input-group mb-3 ">
        <span class="input-group-text" for="email">email</span>
        <input type="email" class="form-control" id="email" name="email" value="<?= $data->user->email ?>"  required>
    </div>

    <button type="submit" class="btn btn-warning mt-4">Update</button>
</form>