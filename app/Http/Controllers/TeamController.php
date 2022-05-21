<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index(): JsonResponse
    {
        $teams = Team::all();
        return response()->json($teams);
    }

    public function create(Request $request): JsonResponse
    {
        $team = new Team();
        $team->name = $request->get('name');
        $team->year_foundation = $request->get('year_foundation');
        $team->gymnasium = $request->get('gymnasium');
        $team->category = $request->get('category');
        $team->save();

        return response()->json($team);
    }

    public function read(int $team_id): JsonResponse
    {
        $team = Team::findOrFail($team_id);
        return response()->json($team);
    }

    public function update(Request $request, int $team_id): JsonResponse
    {
        $team = Team::findOrfail($team_id);
        $team->name = $request->get('name');
        $team->year_foundation = $request->get('year_foundation');
        $team->gymnasium = $request->get('gymnasium');
        $team->category = $request->get('category');
        $team->save();

        return response()->json($team);
    }

    public function delete(int $team_id): JsonResponse
    {
        $team = Team::findOrFail($team_id);
        $team->delete();

        return response()->json(["excluded" => $team]);
    }
}
