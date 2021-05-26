@extends('layouts.app')

@section('content')
    <h1>{{ $lecture->topic }}</h1> 
    <hr>
    <p>
        <em>{{ $lecture->member->fullName }}</em> <br>
        <em>{{ $lecture->member->unit }}</em>
    </p>

    <p class="lead">{{ $lecture->description }}</p>

    @role('manager')
        @if($lecture->isNew)
            <x-form-button 
                method="POST"
                actionUrl="{{ route('lectures.accept', $lecture) }}"
                style="success"
                icon="fa fa-check"
            >Подтвердить участие</x-form-button>

            <x-form-button 
                method="POST"
                actionUrl="{{ route('lectures.reject', $lecture) }}"
                style="danger"
                icon="fa fa-times"
            >Отклонить</x-form-button>
        @endif
    @endrole
@endsection
