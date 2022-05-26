<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function index(): JsonResponse
    {
        $positions = Position::all();
        return response()->json($positions);
    }

    public function create(Request $request): JsonResponse
    {
        $position = new Position();
        $position->name = $request->get('name');
        $position->save();

        return response()->json($position);
    }

    public function read(int $position_id): JsonResponse
    {
        $position = Position::findOrFail($position_id);
        return response()->json($position);
    }

    public function update(Request $request, int $position_id): JsonResponse
    {
        $position = Position::findOrfail($position_id);
        $position->name = $request->get("name");
        $position->save();

        return response()->json($position);
    }

    public function delete(int $position_id): JsonResponse
    {
        $position = Position::findOrFail($position_id);
        $position->delete();

        return response()->json(["excluded" => $position]);
    }
}
