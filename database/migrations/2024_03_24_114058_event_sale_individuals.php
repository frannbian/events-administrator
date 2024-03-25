<?php

use App\Models\V1\EventSale;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('event_sale_individuals', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(EventSale::class);
            $table->string('name');
            $table->string('lastname');
            $table->string('email');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('event_sale_individuals');
    }
};
