<?php

namespace App\Http\Controllers;

use App\Http\Requests\MemberRequest;
use App\Models\Conference;

class MemberController extends Controller
{
    /**
     * Show the form for creating a new lecture.
     *
     * @return \Illuminate\View\Views
     */
    public function create()
    {
        return view('conference.create', compact('conference'));
    }

    /**
     * Store a newly created member in conference.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Conference $conference, MemberRequest $request)
    {
        $conference->members()->create($request->only(['name', 'email', 'unit']));

        if ($request->become_speaker) {
            $conference->lectures()->create($request->only(['topic', 'description']));
        }

        return redirect()->route('conferences.index');
    }
}
