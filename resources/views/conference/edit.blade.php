@extends('layouts.app')

@section('content')
    <h1>Редактировать конференцию</h1>

    <form method="POST" action="{{ route('conferences.update', $conference) }}">
        @csrf
        @method('put')

        @include('conference._fields')
    
        <button type="submit" class="btn btn-primary">Обновить</button>
        <a class="btn btn-outline-info" href="{{ route('home') }}">К списку конференции</a>
    </form>
@endsection
