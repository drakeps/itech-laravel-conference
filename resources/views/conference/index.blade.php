@extends('layouts.app')

@section('content')
    <h1>Cписок конференций</h1>

    <div class="my-3">
        <a class="btn btn-primary" href="{{ route('conferences.create') }}">Добавить конференцию</a>
    </div>

    @if ($conferences->count())
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Тема</th>
                    <th scope="col">Дата проведения</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($conferences as $conference)
                    <tr>
                        <td>{{ $conference->topic }}</td>
                        <td>{{ $conference->start_date }}</td>
                        <td>
                            <a class="btn btn-primary" href="{{ route('conferences.edit', $conference) }}">
                                <i class="fa fa-edit"></i>
                            </a>

                            <x-delete-button actionUrl="{{ route('conferences.destroy', $conference) }}"/>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $conferences->links() }}
    @else
        Список конференций пока пуст :(
    @endif

@endsection
