<h4>Your Details</h4>

<form action="user/update" method="POST">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="userName">Name</label>
        <input type="text" class="form-control" id="userName" name="userName" aria-describedby="nameHelp" placeholder="Enter name" value="{{ $user->name }}">
        <small id="nameHelp" class="form-text text-muted">As it will appear on your profile.</small>
    </div>
    <div class="form-group">
      <label for="userEmail">Email address</label>
      <input type="email" class="form-control" id="userEmail" name="userEmail" aria-describedby="emailHelp" placeholder="Enter email" value="{{ $user->email }}">
      <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>
    <div class="form-group">
    <label for="userGender">Gender</label>
        <select class="form-control" id="userGenderId" name="userGenderId">
            <option>Please Select</option>
            <option value="1" @if ($user->gender_id === 1) selected="selected" @endif>Female</option>
            <option value="2" @if ($user->gender_id === 2) selected="selected" @endif>Male</option>
            <option value="3" @if ($user->gender_id === 3) selected="selected" @endif>Non-Binary</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Update Details</button>
</form>