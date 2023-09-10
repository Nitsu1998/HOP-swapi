<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Exceptions\NotFoundException;

class Vehicles extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'model', 'vehicle_class', 'manufacturer', 'length', 'crew', 'cost_in_credits', 'passengers', 'max_atmosphering_speed', 'cargo_capacity', 'consumables', 'films', 'pilots', 'url', 'count'];

    protected $casts = ['films' => 'json', 'pilots' => 'json'];

    public function getAllVehicles()
    {
        return Vehicles::all();
    }

    public function getVehicleById($id)
    {
        try {
            return Vehicles::findOrFail($id);
        } catch (ModelNotFoundException) {
            throw new NotFoundException("Vehicle with ID ". $id ." not found");
        }
    }

    public function setVehicleCount($id, $amount)
    {
        $vehicle = $this->getVehicleById($id);
        $vehicle->count = $amount;
        $vehicle->save();
    }

    public function incrementVehicleCount($id, $amount)
    {
        $vehicle = $this->getVehicleById($id);
        $vehicle->count += $amount;
        $vehicle->save();
    }

    public function decrementVehicleCount($id, $amount)
    {
        $vehicle = $this->getVehicleById($id);
        if ($amount >= $vehicle->count) {
            $vehicle->count = 0;
        } else {
            $vehicle->count -= $amount;
        }
        $vehicle->save();
    }
}
