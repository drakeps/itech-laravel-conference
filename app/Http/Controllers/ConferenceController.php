<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConferenceRequest;
use App\Models\Conference;
use Illuminate\Http\Request;

class ConferenceController extends Controller
{
    /**
     * Display a listing of the conferences.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $conferences = Conference::paginate(4);

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
        Conference::create($request->validated() + [
            'user_id' => 1,
        ]);

        flash('Конференция успешно добавлена!', 'success');

        return redirect()->route('conferences.index');
    }

    /**
     * Display the specified conference.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified conference.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Conference $conference)
    {
        $conference->delete();

        flash('Конференция успешно удалена', 'success');

        return redirect()->route('conferences.index');
    }
}
