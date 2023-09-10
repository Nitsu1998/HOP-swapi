<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Starships extends InventoryItem
{
    use HasFactory;

    protected $fillable = ['name', 'model', 'starship_class', 'manufacturer', 'cost_in_credits', 'length', 'crew', 'passengers', 'max_atmosphering_speed', 'hyperdrive_rating', 'MGLT', 'cargo_capacity', 'consumables', 'films', 'pilots', 'url', 'count'];

    protected $casts = ['films' => 'json', 'pilots' => 'json'];
}
