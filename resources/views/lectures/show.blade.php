@extends('layouts.app')

@section('content')
    <h1>{{ $lecture->topic }}</h1> 
    <hr>
    <p>
        <em>{{ $lecture->member->fullName }}</em> <br>
        <em>{{ $lecture->member->unit }}</em>
    </p>

    <p class="lead">{{ $lecture->description }}</p>   
@endsection
