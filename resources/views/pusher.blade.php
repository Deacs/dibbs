@extends('layouts.app')

@section('title', 'Page Title')

@section('head_script')
<script src="https://js.pusher.com/5.0/pusher.min.js"></script>
<script>

// Enable pusher logging - don't include this in production
Pusher.logToConsole = true;

var pusher = new Pusher('c91030d60fcfc7b261f5', {
    cluster: 'eu',
    forceTLS: true
});

//var channel = pusher.subscribe('my-channel');
var channel = pusher.subscribe('item.selected');

channel.bind('my-event', function(data) {
    alert(JSON.stringify(data));
});
</script>
@endsection

@section('sidebar')
    @parent

    <p>Nothing to see here - for now</p>
@endsection

@section('content')
    <h1>DIBBS!</h1>

    <p>
        Try publishing an event to channel <code>my-channel</code>
        with event name <code>my-event</code>.
  </p>
@endsection