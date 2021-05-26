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
                        <td>
                            <a href="{{ route('conferences.show', $conference) }}">{{ $conference->topic }}</a>
                        </td>
                        <td>{{ $conference->start_date }}</td>
                        <td>
                            <a class="btn btn-primary" href="{{ route('conferences.edit', $conference) }}">
                                <i class="fa fa-edit"></i>
                            </a>

                            <x-form-button
                                method="DELETE"
                                actionUrl="{{ route('conferences.destroy', $conference) }}"
                                style="danger"
                                icon='fa fa-trash-alt'
                            ></x-form-button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $conferences->links() }}
    @else
        <div>Список конференций пока пуст :(</div>
    @endif

@endsection
