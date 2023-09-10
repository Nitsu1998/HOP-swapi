<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicles extends Model
{
    use HasFactory;

    protected $fillable = ['name','model','vehicle_class','manufacturer','length','crew','cost_in_credits','passengers','max_atmosphering_speed','cargo_capacity','consumables','films','pilots','url','count'];

    protected $casts = ['films' => 'json','pilots' => 'json'];

    public function getById($id)
    {
        return Vehicles::findOrFail($id);
    }

    public function setCount($id, $count)
    {
        $starship = $this->getById($id);
        $starship->count = $count;
        $starship->save();
    }

    public function incrementCount($id, $amount)
    {
        $starship = $this->getById($id);
        $starship->count += $amount;
        $starship->save();
    }

    public function decrementCount($id, $amount)
    {
        $starship = $this->getById($id);
        $starship->count -= $amount;
        $starship->save();
    }
}
