<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    protected $model;
    protected $relations = [];

    // Fetch all records (excluding soft-deleted ones)
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

    // Fetch next record
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

    // Fetch previous record
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

    // Update a record
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

    // Custom soft delete (mark deleted_at = 1)
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
