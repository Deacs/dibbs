@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

@if (session('status'))
<div class="alert alert-success" role="alert">
    {{ session('status') }}
</div>
@endif

<h1>Dashboard</h1>

<div class="container">
    <div class="row">
        <div class="col" style="background:rosybrown;">
                Your Avatar here
        </div>
        <div class="col-9"> 
            <h4>Your Details</h4>
            @include('dashboard.user_details')
        </div>
    </div>
</div>
<div class="container">
    <div class="row" style="background:burlywood;">
        <h4>Your Calendar</h4>
    </div>
</div>


@endsection