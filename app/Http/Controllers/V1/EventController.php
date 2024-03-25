<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\{ StoreEventRequest, UpdateEventRequest };
use App\Models\V1\Event;
use App\Repositories\V1\EventRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $events = Cache::tags(['events'])->remember('events-list', 3600, function () use ($request){
            return EventRepository::get($request->all());
        });

        return view('events.list', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('events.form', ['event' => null]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventRequest $request): RedirectResponse
    {
        EventRepository::save($request->validated());

        Cache::tags('events')->flush();

        return to_route('events.index')->with('success','Evento agregado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event): View
    {
        return view('events.form', ['event' => $event]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event): View
    {
        return view('events.form', ['event' => $event]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventRequest $request, Event $event) : RedirectResponse
    {
        EventRepository::save($request->validated(), $event->id);

        Cache::tags('events')->flush();
        return to_route('events.index')->with('success','Evento modificado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event): RedirectResponse
    {
        EventRepository::delete($event);

        Cache::tags('events')->flush();

        return to_route('events.index')->with('success','Evento eliminado correctamente');
    }
}
