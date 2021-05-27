@extends('layouts.app')

@section('content')
    <h1>Регистрация на конференцию</h1>

    <form method="POST" action="{{ route('members.store', $conference) }}" x-data="{ isSpeaker: '{{ old('become_speaker') }}' }">
        @csrf

        <div class="form-row">
            <div class="form-group col-md-4">
                <x-forms.input
                    name="firstname"
                    type="text"
                    label="Имя"
                    required
                />
            </div>

            <div class="form-group col-md-4">
                <x-forms.input
                    name="lastname"
                    type="text"
                    label="Фамилия"
                    required
                />
            </div>

            <div class="form-group col-md-4">
                <x-forms.input
                    name="email"
                    type="email"
                    label="Email"
                    required
                />
            </div>

            <div class="form-group col-md-12">
                <x-forms.input
                    name="unit"
                    type="text"
                    label="Подразделение"
                    required
                />
            </div>

            <div class="form-group">
                <x-forms.checkbox
                    name="become_speaker"
                    value="1"
                    label="Хочу быть докладчиком"
                    x-model="isSpeaker"
                />
            </div>

            <div class="form-group col-md-12" x-show="isSpeaker">
                <x-forms.input
                    name="topic"
                    type="text"
                    label="Тема доклада"
                />
            </div>

            <div class="form-group col-md-12" x-show="isSpeaker">
                <x-forms.textarea
                    name="description"
                    type="text"
                    label="Описание доклада"
                />
            </div>
        </div>
    
        <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
        <a class="btn btn-outline-info" href="{{ route('conferences.show', $conference) }}">К списку докладов</a>
    </form>
@endsection