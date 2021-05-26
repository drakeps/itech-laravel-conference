@extends('layouts.app')

@section('content')
    <h1>{{ $conference->topic }}</h1>

    <div class="my-3">
        <a class="btn btn-primary" href="{{ route('conferences.show', $conference) }}">Список докладчиков</a>

        <a class="btn btn-success" href="{{ route('members.create', $conference) }}">Хочу участвовать</a>
    </div><hr>

    <h3>Участники</h3>

    @if ($conference->members->count())
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Участник</th>
                    <th scope="col">Подразделение</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($conference->members as $member)
                    <tr>
                        <td>
                            {{ $member->fullName }}
                        </td>
                        <td>{{ $member->unit }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div>Список участников пока пуст :(</div>
    @endif

@endsection
