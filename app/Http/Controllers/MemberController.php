<?php

namespace App\Http\Controllers;

use App\Http\Requests\MemberRequest;
use App\Models\Conference;

class MemberController extends Controller
{
    /**
     * Display a listing of the members.
     *
     * @return \Illuminate\View\View
     */
    public function index(Conference $conference)
    {
        return view('members.index', compact('conference'));
    }

    /**
     * Show the form for creating a new lecture.
     *
     * @return \Illuminate\View\Views
     */
    public function create(Conference $conference)
    {
        return view('members.create', compact('conference'));
    }

    /**
     * Store a newly created member in conference.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Conference $conference, MemberRequest $request)
    {
        $member = $conference->members()->create($request->only(['firstname', 'lastname', 'email', 'unit']));

        if ($request->become_speaker) {
            $conference
                ->lectures()
                ->create($request->only(['topic', 'description']))
                ->member()
                ->save($member);
        }

        flash('Спасибо, Ваша заявка на участие в конференции была отправлена', 'success');

        return redirect()->route('conferences.show', $conference);
    }
}
