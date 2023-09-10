<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicles;
use App\Exceptions\NotFoundException;
use Illuminate\Support\Facades\Validator;

class VehiclesController extends Controller
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
            $validation = $this->validateRequestData($request);
            if ($validation) {
                return $validation;
            }
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
            $validation = $this->validateRequestData($request);
            if ($validation) {
                return $validation;
            }
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
            $validation = $this->validateRequestData($request);
            if ($validation) {
                return $validation;
            }
            $amount = $request->input('amount');
            $vehicles->decrementVehicleCount($id, $amount);
            return response()->json(['vehicle_id' => $id, 'message' => 'Count updated successfully']);
        } catch (NotFoundException $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }
}
