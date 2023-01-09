<h1>Create User</h1>

<form action="/users/store" method="POST" class="w-50 mt-5">

    <div class="input-group mb-3 ">
        <span class="input-group-text" for="display_name"> Name</span>
        <input type="text" class="form-control" id="display_name" name="display_name" required>
    </div>

    <div class="input-group mb-3 ">
        <span class="input-group-text" for="username">Username</span>
        <input type="text" class="form-control" id="username" name="username" required>
    </div>

    <div class="input-group mb-3 ">
        <span class="input-group-text" for="email">Email</span>
        <input type="email" class="form-control" id="email" name="email" required>
    </div>

    <div class="input-group mb-3 ">
        <span class="input-group-text" for="password">Password</span>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>

    <div class="input-group mb-3 ">
        <span class="input-group-text" for="role">Role</span>
        <select class="form-select" id="role" name="role" required>
            <option selected></option>
            <option value="admin">Admin</option>
            <option value="accountant">Accountant</option>
            <option value="procurement">Procurement</option>
            <option value="seller">Seller</option>
        </select>
    </div>

    <button type="submit" class="btn btn-success mt-4">Create</button>
</form>