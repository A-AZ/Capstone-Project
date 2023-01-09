<h3 class="d-flex justify-content-around mt-5">Create User</h3>

<div class="d-flex justify-content-center">
    <form action="/users/store" method="POST" class="mt-5 w-75">

        <div class="input-group mb-3 ">
            <span class="input-group-text" for="display_name"> Name</span>
            <input type="text" class="form-control" id="a_display_name" name="display_name" required>
        </div>

        <div class="input-group mb-3 ">
            <span class="input-group-text" for="username">Username</span>
            <input type="text" class="form-control" id="a_username" name="username" required>
        </div>

        <div class="input-group mb-3 ">
            <span class="input-group-text" for="email">Email</span>
            <input type="email" class="form-control" id="a_email" name="email" required>
        </div>

        <div class="input-group mb-3 ">
            <span class="input-group-text" for="password">Password</span>
            <input type="password" class="form-control" id="a_password" name="password" required>
        </div>

        <div class="input-group mb-3 ">
            <span class="input-group-text" for="role">Role</span>
            <select class="form-select" id="a_role" name="role" required>
                <option selected></option>
                <option value="admin">Admin</option>
                <option value="accountant">Accountant</option>
                <option value="procurement">Procurement</option>
                <option value="seller">Seller</option>
            </select>
        </div>
        
        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-success mt-4">Create</button>
        </div>
    </form>
</div>