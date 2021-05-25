<?php

namespace App\Http\Controllers;

use App\Http\Requests\LectureRequest;
use App\Models\Conference;
use App\Models\Lecture;

class LectureController extends Controller
{
    /**
     * Show the form for creating a new lecture.
     *
     * @return \Illuminate\View\Views
     */
    public function create()
    {
        $conference = new Lecture;

        return view('conference.create', compact('conference'));
    }

    /**
     * Store a newly created conference in lecture.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Conference $conference, LectureRequest $request)
    {
        $conference->lectures()->create($request->validated());

        flash('Доклад успешно добавлена!', 'success');

        return redirect()->route('lectures.index');
    }
}
