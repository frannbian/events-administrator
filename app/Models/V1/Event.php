<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Event extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'date', 'description', 'available_tickets'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'available_tickets' => 'integer',
        'date' => 'date',
    ];

    /**
     * Get the sales for the event.
     */
    public function sales(): HasMany
    {
        return $this->hasMany(EventSale::class);
    }

    /**
     * Get all of the persons for the event.
     */
    public function individuals(): HasManyThrough
    {
        return $this->hasManyThrough(EventSaleIndividual::class, EventSale::class);
    }
}
