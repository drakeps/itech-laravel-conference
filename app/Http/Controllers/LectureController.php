<?php

namespace App\Http\Controllers;

use App\Models\Lecture;

class LectureController extends Controller
{
    public function show(Lecture $lecture)
    {
        if (!optional(auth()->user())->hasRole('manager')) {
            abort_if(!$lecture->accepted, 403);
        }

        return view('lectures.show', compact('lecture'));
    }

    public function accept(Lecture $lecture)
    {
        $lecture->accept();

        flash("Доклад $lecture->topic подтвержден!", 'success');

        return redirect()->route('conferences.show', $lecture->conference);
    }

    public function reject(Lecture $lecture)
    {
        $lecture->reject();

        flash("Доклад $lecture->topic отклонен!", 'danger');

        return redirect()->route('conferences.show', $lecture->conference);
    }
}
