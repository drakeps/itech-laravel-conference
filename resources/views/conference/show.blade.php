@extends('layouts.app')

@section('content')
    <h1>{{ $conference->topic }}</h1> 
    
    <div class="my-3">
        <a class="btn btn-primary" href="{{ route('members.index', $conference) }}">Список участников</a>
        <a class="btn btn-success" href="{{ route('members.create', $conference) }}">Хочу участвовать</a>
        <a class="btn btn-outline-info" href="{{ route('home') }}">К списку конференции</a>
    </div><hr>

    <h3>Доклады</h3>

    @if ($lectures->count())
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Тема доклада</th>
                    <th scope="col">Докладчик</th>
                    <th scope="col">Подразделение</th>
                    @role('manager')
                        <th scope="col"></th>
                    @endrole
                </tr>
            </thead>
            <tbody>
                @foreach ($lectures as $lecture)
                    <tr class="{{ $lecture->rejected ? 'table-danger' : '' }}">
                        <td>
                            <a href="{{ route('lectures.show', $lecture) }}">{{ $lecture->topic }}</a>
                        </td>
                        <td>{{ $lecture->member->fullName }}</td>
                        <td>{{ $lecture->member->unit }}</td>
                        @role('manager')
                            <td>
                                @if($lecture->isNew)
                                    <x-form-button 
                                        method="POST"
                                        actionUrl="{{ route('lectures.accept', $lecture) }}"
                                        style="success"
                                        icon="fa fa-check"
                                    ></x-form-button>

                                    <x-form-button 
                                        method="POST"
                                        actionUrl="{{ route('lectures.reject', $lecture) }}"
                                        style="danger"
                                        icon="fa fa-times"
                                    ></x-form-button>
                                @endif
                            </td>
                        @endrole
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div>Пока еще нет докладов :(</div>
    @endif
@endsection
