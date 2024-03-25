<?php

namespace App\Http\Controllers\V1;

use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Repositories\V1\EventSaleRepository;
use App\Models\V1\Event;
use Illuminate\Http\{ Request, RedirectResponse, UploadedFile};
use Illuminate\Support\Facades\Cache;
use App\Models\V1\EventSale;

class EventSaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $eventSales = Cache::tags(['eventSales'])->remember('event-sales-list', 3600, function () use ($request){
            return EventSaleRepository::get($request->all());
        });
        return view('event_sales.list', compact('eventSales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $events = Event::all();

        return view('event_sales.form', ['eventSale' => null, 'events' => $events]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        EventSaleRepository::save($request->all());

        Cache::tags('eventSales')->flush();

        return to_route('event_sales.index')->with('success','Venta agregada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(EventSale $eventSale): View
    {
        $events = Event::all();
        return view('event_sales.form', ['eventSale' => $eventSale, 'events' => $events]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EventSale $eventSale): View
    {
        $events = Event::all();
        return view('event_sales.form', ['eventSale' => $eventSale, 'events' => $events]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EventSale $eventSale) : RedirectResponse
    {
        EventSaleRepository::save($request->all(), $eventSale->id);

        Cache::tags('eventSales')->flush();
        return to_route('event_sales.index')->with('success','Venta modificada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EventSale $eventSale): RedirectResponse
    {
        EventSaleRepository::delete($eventSale);

        Cache::tags('eventSales')->flush();

        return to_route('event_sales.index')->with('success','Venta eliminada correctamente');
    }
}
