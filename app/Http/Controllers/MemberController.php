<?php

namespace App\Http\Controllers;

use App\Http\Requests\MemberRequest;
use App\Models\Conference;
use App\Models\Lecture;
use App\Models\Member;
use App\Models\User;
use App\Notifications\NewLectureHasBeenAdded;

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
            $lecture = Lecture::make($request->only(['topic', 'description']));
            $conference
                ->lectures()
                ->save($lecture)
                ->member()
                ->save($member);

            User::haveRole('manager')->get()->each->notify(new NewLectureHasBeenAdded($lecture));
        }

        flash('Спасибо, Ваша заявка на участие в конференции была отправлена', 'success');

        return redirect()->route('conferences.show', $conference);
    }
}
