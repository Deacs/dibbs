@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

@if (session('status'))
<div class="alert alert-success" role="alert">
    {{ session('status') }}
</div>
@endif

<h1>Dashboard</h1>

<div>
    Your Avatar here
</div>
<div>
    Your option to change your details
</div>
<div>
    Your calendar here
</div>

@endsection