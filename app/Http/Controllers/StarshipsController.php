<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Starships;
use App\Exceptions\NotFoundException;
use Illuminate\Support\Facades\Validator;


class StarshipsController extends Controller
{
    private function validateRequestData($request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required|integer|min:0',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        return;
    }

    public function index(Starships $starships)
    {
        $response = $starships->getAllStarships();
        return response()->json($response);
    }

    public function show($id, Starships $starships)
    {
        try {
            $response = $starships->getStarshipById($id);
            return response()->json($response);
        } catch (NotFoundException $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function updateCount($id, Starships $starships, Request $request)
    {
        try {
            $validation = $this->validateRequestData($request);
            if ($validation) {
                return $validation;
            }
            $amount = $request->input('amount');
            $starships->setStarshipCount($id, $amount);
            return response()->json(['starship_id' => $id, 'message' => 'Count updated successfully']);
        } catch (NotFoundException $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function incrementCount($id, Starships $starships, Request $request)
    {
        try {
            $validation = $this->validateRequestData($request);
            if ($validation) {
                return $validation;
            }
            $amount = $request->input('amount');
            $starships->incrementStarshipCount($id, $amount);
            return response()->json(['starship_id' => $id, 'message' => 'Count incremented successfully']);
        } catch (NotFoundException $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function decrementCount($id, Starships $starships, Request $request)
    {
        try {
            $validation = $this->validateRequestData($request);
            if ($validation) {
                return $validation;
            }
            $amount = $request->input('amount');
            $starships->decrementStarshipCount($id, $amount);
            return response()->json(['starship_id' => $id, 'message' => 'Count decremented successfully']);
        } catch (NotFoundException $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }
}
