<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventSaleIndividual extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'lastname', 'email', 'event_sale_id'];

    /**
     * Get the evvent sale.
     */
    public function sale(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }
}
