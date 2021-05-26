@extends('layouts.app')

@section('content')
    <h1>{{ $conference->topic }}</h1> 
    
    <a class="btn btn-primary" href="{{ route('members.create', $conference) }}">Хочу участвовать</a> <hr>

    <h3>Доклады</h3>

    @if ($lectures->count())
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Тема доклада</th>
                    <th scope="col">Докладчик</th>
                    <th scope="col">Подразделение</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($lectures as $lecture)
                    <tr>
                        <td>{{ $lecture->topic }}</td>
                        <td>{{ $lecture->member->name }}</td>
                        <td>{{ $lecture->member->unit }}</td>
                        <td></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div>Пока еще нет докладов :(</div>
    @endif
@endsection
