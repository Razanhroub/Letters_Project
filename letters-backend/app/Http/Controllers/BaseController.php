<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * @OA\Info(
 *     title="Base API",
 *     version="1.0.0",
 *     description="API for handling basic records with soft delete and pagination",
 *     @OA\Contact(
 *         email="contact@example.com"
 *     )
 * )
 */

class BaseController extends Controller
{
    protected $model;
    protected $relations = [];

    /**
     * @OA\Get(
     *     path="/api/{model}",
     *     summary="Fetch all records (excluding soft-deleted ones)",
     *     tags={"Base"},
     *     @OA\Response(
     *         response=200,
     *         description="Successfully fetched all records",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="Record Name")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="No records found"
     *     )
     * )
     */
    public function index()
    {
        $records = $this->model::where('deleted_at', 0)
            ->with($this->relations)
            ->get();

        if ($records->isEmpty()) {
            return response()->json(['message' => 'No records found'], 404);
        }

        return response()->json($records);
    }

    /**
     * @OA\Get(
     *     path="/api/{model}/next/{id}",
     *     summary="Fetch next record",
     *     tags={"Base"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the current record",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successfully fetched next record",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer", example=2),
     *             @OA\Property(property="name", type="string", example="Next Record")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="No next record found"
     *     )
     * )
     */
    public function next($id)
    {
        $nextRecord = $this->model::where('id', '>', $id)
            ->where('deleted_at', 0)
            ->with($this->relations)
            ->first();

        if (!$nextRecord) {
            return response()->json(['message' => 'No next record found'], 404);
        }

        return response()->json($nextRecord);
    }

    /**
     * @OA\Get(
     *     path="/api/{model}/prev/{id}",
     *     summary="Fetch previous record",
     *     tags={"Base"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the current record",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successfully fetched previous record",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="name", type="string", example="Previous Record")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="No previous record found"
     *     )
     * )
     */
    public function prev($id)
    {
        $prevRecord = $this->model::where('id', '<', $id)
            ->where('deleted_at', 0)
            ->with($this->relations)
            ->orderBy('id', 'desc')
            ->first();

        if (!$prevRecord) {
            return response()->json(['message' => 'No previous record found'], 404);
        }

        return response()->json($prevRecord);
    }

    /**
     * @OA\Put(
     *     path="/api/{model}/{id}",
     *     summary="Update a record",
     *     tags={"Base"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the record to update",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string", example="Updated Record"),
     *             @OA\Property(property="description", type="string", example="Updated description")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successfully updated record",
     *         @OA\JsonContent(ref="#/components/schemas/Record")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Record not found"
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $record = $this->model::where('id', $id)
            ->where('deleted_at', 0)
            ->first();

        if (!$record) {
            return response()->json(['message' => 'Record not found'], 404);
        }

        $record->update($request->all());

        return response()->json($record);
    }

    /**
     * @OA\Delete(
     *     path="/api/{model}/{id}",
     *     summary="Soft delete a record",
     *     tags={"Base"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the record to delete",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successfully deleted record",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Record not found"
     *     )
     * )
     */
    public function destroy($id)
    {
        $record = $this->model::where('id', $id)->first();

        if (!$record) {
            return response()->json(['message' => 'Record not found'], 404);
        }

        $record->update(['deleted_at' => 1]); // Mark as deleted

        return response()->json(['message' => 'Record deleted successfully']);
    }
}
