<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Exceptions\NotFoundException;

class Starships extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'model', 'starship_class', 'manufacturer', 'cost_in_credits', 'length', 'crew', 'passengers', 'max_atmosphering_speed', 'hyperdrive_rating', 'MGLT', 'cargo_capacity', 'consumables', 'films', 'pilots', 'url', 'count'];

    protected $casts = ['films' => 'json', 'pilots' => 'json'];

    public function getAllStarships()
    {
        return Starships::all();
    }

    public function getStarshipById($id)
    {
        try {
            return Starships::findOrFail($id);
        } catch (ModelNotFoundException) {
            throw new NotFoundException("Starship with ID ". $id ." not found");
        }
    }

    public function setStarshipCount($id, $amount)
    {
        $starship = $this->getStarshipById($id);
        $starship->count = $amount;
        $starship->save();
    }

    public function incrementStarshipCount($id, $amount)
    {
        $starship = $this->getStarshipById($id);
        $starship->count += $amount;
        $starship->save();
    }

    public function decrementStarshipCount($id, $amount)
    {
        $starship = $this->getStarshipById($id);
        if ($amount >= $starship->count) {
            $starship->count = 0;
        } else {
            $starship->count -= $amount;
        }
        $starship->save();
    }
}
