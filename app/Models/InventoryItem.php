<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Exceptions\NotFoundException;

class InventoryItem extends Model
{
    use HasFactory;

    public function getAllItems()
    {
        return static::all();
    }

    public function getItemById($id)
    {
        try {
            return static::findOrFail($id);
        } catch (ModelNotFoundException) {
            throw new NotFoundException("Item with ID " . $id . " not found");
        }
    }

    public function setItemCount($id, $amount)
    {
        $item = $this->getItemById($id);
        $item->count = $amount;
        $item->save();
    }

    public function incrementItemCount($id, $amount)
    {
        $item = $this->getItemById($id);
        $item->count += $amount;
        $item->save();
    }

    public function decrementItemCount($id, $amount)
    {
        $item = $this->getItemById($id);
        if ($amount >= $item->count) {
            $item->count = 0;
        } else {
            $item->count -= $amount;
        }
        $item->save();
    }
}
