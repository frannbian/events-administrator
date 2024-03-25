<?php

namespace App\Repositories\V1;

use App\Http\Resources\V1\EventResource;
use App\Models\V1\Event;

class EventRepository
{
    public static function save(Array $request, ?String $id = null) : EventResource {
        $event = Event::updateOrCreate(
            [
                'id' => $id
            ],
            $request
        );
        return new EventResource($event);

    }

    public static function delete(Event $event) : bool {
        return $event->delete();
    }

    public static function get(?Array $data) : EventResource {
        $withRelationships = [];

        $events = Event::with($withRelationships);
        if(!empty($data['search'])) {
            $events->where('name', 'LIKE', "%" . $data['search'] . "%");
        }
        $events = $events->paginate(15);
        return new EventResource($events);
    }
}
