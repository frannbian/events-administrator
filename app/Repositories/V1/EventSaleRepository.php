<?php

namespace App\Repositories\V1;

use App\Http\Resources\V1\EventSaleResource;
use App\Models\V1\EventSale;
use App\Models\V1\EventSaleIndividual;
use App\Http\Requests\V1\{ StoreEventSaleRequest, UpdateEventSaleRequest };
use Illuminate\Http\UploadedFile;

class EventSaleRepository
{
    public static function save(Array $request, ?String $id = null) : EventSaleResource
    {
        // Store the file in storage\app\public folder
        $file = request()->file('payment_proof');
        $filePath = $file->store('uploads', 'public');
        $request['payment_proof'] = $filePath;

        $eventSale = EventSale::updateOrCreate(
            [
                'id' => $id
            ],
            $request
        );

        EventSaleIndividual::updateOrCreate(
            [
                'id' => $id
            ],
            [
                'event_sale_id' => $eventSale->id,
                'name' => $request['name'],
                'lastname' => $request['lastname'],
                'email' => $request['name'],
                'payment_proof' => $filePath

            ]
        );

        $eventSale->event()->associate($request['event_id']);

        // Discount tickets to event available_tickets
        $event = $eventSale->event()->first();
        $event->available_tickets = $event->available_tickets - $eventSale->quantity;
        $event->save();

        return new EventSaleResource($eventSale);

    }

    public static function delete(EventSale $eventSale) : bool {
        // Sum tickets to event available_tickets
        $event = $eventSale->event()->first();
        $event->available_tickets = $event->available_tickets + $eventSale->quantity;
        $event->save();

        return $eventSale->delete();
    }

    public static function get(?Array $data) : EventSaleResource {
        $withRelationships = ['event', 'individual'];

        $eventSales = EventSale::with($withRelationships);
        if(!empty($data['search'])) {
            $eventSales->whereHas('event', function($query) use ($data) {
                $query->where('name', 'LIKE', "%" . $data['search'] . "%");
            })->get();
        }
        $eventSales = $eventSales->paginate(15);
        return new EventSaleResource($eventSales);
    }
}
