<img src="{{  $user->avatar->getPath(200) }}">

@if ($user->avatar_type == 'custom')
    <a href="">Would you rather use Gravatar?</a>
@else
    <a href="">Would you rather use a custom avatar?</a>
@endif