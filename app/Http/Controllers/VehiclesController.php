<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicles;
use App\Exceptions\NotFoundException;

class VehiclesController extends Controller
{
    private function validateRequestData($request)
    {
        $rules = ['amount' => 'required|integer|min:0'];
        $this->validate($request, $rules);
    }

    public function index(Vehicles $vehicles)
    {
        $response = $vehicles->getAllVehicles();
        return response()->json($response);
    }

    public function show($id, Vehicles $vehicles)
    {
        try {
            $response = $vehicles->getVehicleById($id);
            return response()->json($response);
        } catch (NotFoundException $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function updateCount($id, Vehicles $vehicles, Request $request)
    {
        try {
            $this->validateRequestData($request);
            $amount = $request->input('amount');
            $vehicles->setVehicleCount($id, $amount);
            return response()->json(['vehicle_id' => $id, 'message' => 'Count updated successfully']);
        } catch (NotFoundException $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function incrementCount($id, Vehicles $vehicles, Request $request)
    {
        try {
            $this->validateRequestData($request);
            $amount = $request->input('amount');
            $vehicles->incrementVehicleCount($id, $amount);
            return response()->json(['vehicle_id' => $id, 'message' => 'Count updated successfully']);
        } catch (NotFoundException $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function decrementCount($id, Vehicles $vehicles, Request $request)
    {
        try {
            $this->validateRequestData($request);
            $amount = $request->input('amount');
            $vehicles->decrementVehicleCount($id, $amount);
            return response()->json(['vehicle_id' => $id, 'message' => 'Count updated successfully']);
        } catch (NotFoundException $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }
}
