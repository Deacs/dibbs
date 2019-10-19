<h4>Your Details</h4>

<form action="user/update" method="POST">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="userName" class="fullname">Full Name</label>
        <input type="text" class="form-control" id="userName" name="userName" aria-describedby="userNameHelp" placeholder="Enter name" value="{{ $user->name }}">
        <small id="userNameHelp" class="form-text text-muted">Your full name.</small>
        @error('username')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="userNickname" class="nickname">Nickname</label>
        <input type="text" class="form-control" id="userNickName" name="userNickName" aria-describedby="userNicknameHelp" placeholder="Enter nickname" value="{{ $user->user_nickname }}">
        <small id="userNickameHelp" class="form-text text-muted">As it will appear on your profile.</small>
        @error('user_nickname')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group">
      <label for="userEmail" class="email">Email address</label>
      <input type="email" class="form-control" id="userEmail" name="userEmail" aria-describedby="emailHelp" placeholder="Enter email" value="{{ $user->email }}">
      <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
      @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="userGender" class="gender">Gender</label>
        <select class="form-control" id="userGenderId" name="userGenderId">
            <option>Please Select</option>
            <option value="1" @if ($user->gender_id === 1) selected="selected" @endif>Female</option>
            <option value="2" @if ($user->gender_id === 2) selected="selected" @endif>Male</option>
            <option value="3" @if ($user->gender_id === 3) selected="selected" @endif>Non-Binary</option>
        </select>
        @error('gender_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Update Details</button>
</form>