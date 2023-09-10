<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicles;
use App\Exceptions\NotFoundException;
use Illuminate\Support\Facades\Validator;

class VehiclesController extends Controller
{

    protected $vehicles;

    public function __construct(Vehicles $vehicles)
    {
        $this->vehicles = $vehicles;
    }

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

    /**
     * @OA\Get(
     *     path="/api/vehicles",
     *     summary="Show vehicles",
     *     @OA\Response(
     *         response=200,
     *         description="Show all vechiles."
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="An error happend."
     *     )
     * )
     */
    public function index()
    {
        $vehicles = $this->vehicles->getAllItems();
        return response()->json($vehicles);
    }

    /**
     * @OA\Get(
     *     path="/api/vehicles/{id}",
     *     summary="Show a vehicle",
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID vehicle",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Show a vehicle by ID."
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="An error happend."
     *     )
     * )
     */
    public function show($id)
    {
        try {
            $vehicle = $this->vehicles->getItemById($id);
            return response()->json($vehicle);
        } catch (NotFoundException $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    /**
     * @OA\Put(
     *     path="/api/vehicles/{id}/updateCount",
     *     summary="Update inventory vehicle",
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID vehicle",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="amount", type="integer")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Update inventary of a vehicle by ID."
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="An error happend."
     *     )
     * )
     */
    public function updateCount($id, Request $request)
    {
        try {
            $validation = $this->validateRequestData($request);
            if ($validation) {
                return $validation;
            }
            $amount = $request->input('amount');
            $this->vehicles->setItemCount($id, $amount);
            return response()->json(['vehicle_id' => $id, 'message' => 'Count updated successfully']);
        } catch (NotFoundException $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    /**
     * @OA\Put(
     *     path="/api/vehicles/{id}/incrementCount",
     *     summary="Increment inventory vehicle",
     * @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID vehicle",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="amount", type="integer")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Increment inventary of a vehicle by ID."
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="An error happend."
     *     )
     * )
     */
    public function incrementCount($id, Request $request)
    {
        try {
            $validation = $this->validateRequestData($request);
            if ($validation) {
                return $validation;
            }
            $amount = $request->input('amount');
            $this->vehicles->incrementItemCount($id, $amount);
            return response()->json(['vehicle_id' => $id, 'message' => 'Count updated successfully']);
        } catch (NotFoundException $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    /**
     * @OA\Put(
     *     path="/api/vehicles/{id}/decrementCount",
     *     summary="Decrement inventory vehicle",
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID vehicle",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="amount", type="integer")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Decrement inventary of a vehicle by ID."
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="An error happend."
     *     )
     * )
     */
    public function decrementCount($id, Request $request)
    {
        try {
            $validation = $this->validateRequestData($request);
            if ($validation) {
                return $validation;
            }
            $amount = $request->input('amount');
            $this->vehicles->decrementItemCount($id, $amount);
            return response()->json(['vehicle_id' => $id, 'message' => 'Count updated successfully']);
        } catch (NotFoundException $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }
}
