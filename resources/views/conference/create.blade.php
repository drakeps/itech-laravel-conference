@extends('layouts.app')

@section('content')
    <h1>Добавить конференцию</h1>

    <form method="POST" action="{{ route('conferences.store') }}">
        @csrf

        @include('conference._fields')
    
        <button type="submit" class="btn btn-primary">Добавить</button>
    </form>
@endsection