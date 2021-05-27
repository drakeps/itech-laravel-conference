<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConferenceRequest;
use App\Models\Conference;
use Illuminate\Http\Request;

class ConferenceController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:manager')->only([
            'create', 'store', 'edit', 'update', 'destroy',
        ]);
    }

    /**
     * Display a listing of the conferences.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $conferences = Conference::sortByStartDate()->paginate(config('itech.conferences_pagination'));

        return view('conference.index', compact('conferences'));
    }

    /**
     * Show the form for creating a new conference.
     *
     * @return \Illuminate\View\Views
     */
    public function create()
    {
        $conference = new Conference;

        return view('conference.create', compact('conference'));
    }

    /**
     * Store a newly created conference in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ConferenceRequest $request)
    {
        Conference::create($request->validated());

        flash('Конференция успешно добавлена!', 'success');

        return redirect()->route('home');
    }

    /**
     * Display the specified conference.
     *
     * @param  Conference  $conference
     * @return \Illuminate\View\Views
     */
    public function show(Conference $conference)
    {
        if (auth()->check() && auth()->user()->hasRole('manager')) {
            $lectures = $conference->lectures;
        } else {
            $lectures = $conference->acceptedLectures();
        }

        return view('conference.show', compact('conference', 'lectures'));
    }

    /**
     * Show the form for editing the specified conference.
     *
     * @param  Conference  $conference
     * @return \Illuminate\View\Views
     */
    public function edit(Conference $conference)
    {
        return view('conference.edit', compact('conference'));
    }

    /**
     * Update the specified conference in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Conference  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ConferenceRequest $request, Conference $conference)
    {
        $conference->update($request->validated());

        flash('Конференция успешно обновлена', 'success');

        return back();
    }

    /**
     * Remove the specified conference from storage.
     *
     * @param  Conference  $conference
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Conference $conference)
    {
        $conference->delete();

        flash('Конференция успешно удалена', 'success');

        return redirect()->route('home');
    }
}
