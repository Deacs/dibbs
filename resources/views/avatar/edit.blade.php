<h4>Edit your avatar</h4>

@if ($user->avatar_type == 'custom')
    You are using a custom avatar
@else
    You are using a Gravatar image 
    @if ($user->avatar->isGeneratedGravatar()) 
        that has been automatically generated for you:
    @else
        that you have specifically selected: 
    @endif
    <img src="{{ $user->avatar->getPath(200) }}">
@endif

<hr>

<ul>
    <li>Show current setting of custom/Gravatar</li>
    <li>Any current avatars</li>
    <li>Upload form</li>
    <li>Option to use Gravatar</li>
    <li>Link to Gravatar</li>
</ul>  