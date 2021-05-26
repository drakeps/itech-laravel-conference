<?php

namespace App\Http\Controllers;

use App\Models\Lecture;

class LectureController extends Controller
{
    public function accept(Lecture $lecture)
    {
        $lecture->accept();

        flash('Доклад подтвержден!');

        return redirect()->route('conferences.show', $lecture->conference);
    }

    public function reject(Lecture $lecture)
    {
        $lecture->reject();

        flash('Доклад отклонен!');

        return redirect()->route('conferences.show', $lecture->conference);
    }
}
