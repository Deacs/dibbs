<h4 class="update_password">Update your password</h4>

<form action="user/update/password">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="exampleInputPassword1"> Current Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1"> New Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
    </div>
        <div class="form-group">
        <label for="exampleInputPassword1"> Confirm New Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
    </div>
    <button type="submit" class="btn btn-primary">Update Password</button>
</form>