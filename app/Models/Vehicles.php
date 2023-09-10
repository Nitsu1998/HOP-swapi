<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vehicles extends InventoryItem
{
    use HasFactory;

    protected $fillable = ['name', 'model', 'vehicle_class', 'manufacturer', 'length', 'crew', 'cost_in_credits', 'passengers', 'max_atmosphering_speed', 'cargo_capacity', 'consumables', 'films', 'pilots', 'url', 'count'];

    protected $casts = ['films' => 'json', 'pilots' => 'json'];
}
