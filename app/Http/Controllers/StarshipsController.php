<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exceptions\NotFoundException;
use Illuminate\Support\Facades\Validator;
use App\Models\Starships;


class StarshipsController extends Controller
{
    protected $starships;

    public function __construct(Starships $starships)
    {
        $this->starships = $starships;
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
     *     path="/api/starships",
     *     summary="Show starships",
     *     tags={"Starships"},
     *     @OA\Response(
     *         response=200,
     *         description="Show all starships."
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="An error happend."
     *     )
     * )
     */
    public function index()
    {
        $starships = $this->starships->getAllItems();
        return response()->json($starships);
    }

    /**
     * @OA\Get(
     *     path="/api/starships/{id}",
     *     summary="Show a starship",
     *     tags={"Starships"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID starship",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Show a starship by ID."
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
            $starship = $this->starships->getItemById($id);
            return response()->json($starship);
        } catch (NotFoundException $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    /**
     * @OA\Put(
     *     path="/api/starships/{id}/updateCount",
     *     summary="Update inventory starship",
     *     tags={"Starships"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID starship",
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
     *         description="Update inventary of a starship by ID."
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
            $this->starships->setItemCount($id, $amount);
            return response()->json(['starship_id' => $id, 'message' => 'Count updated successfully']);
        } catch (NotFoundException $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    /**
     * @OA\Put(
     *     path="/api/starships/{id}/incrementCount",
     *     summary="Increment inventory starship",
     *     tags={"Starships"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID starship",
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
     *         description="Increment inventary of a starship by ID."
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
            $this->starships->incrementItemCount($id, $amount);
            return response()->json(['starship_id' => $id, 'message' => 'Count incremented successfully']);
        } catch (NotFoundException $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    /**
     * @OA\Put(
     *     path="/api/starships/{id}/decrementCount",
     *     summary="Decrement inventory starship",
     *     tags={"Starships"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID starship",
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
     *         description="Decrement inventary of a starship by ID."
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
            $this->starships->decrementItemCount($id, $amount);
            return response()->json(['starship_id' => $id, 'message' => 'Count decremented successfully']);
        } catch (NotFoundException $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }
}
