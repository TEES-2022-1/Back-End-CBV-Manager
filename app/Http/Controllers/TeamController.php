<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    function index()
    {
        $teams = Team::all();
        return response()->json($teams);
    }

    function create(Request $request)
    {
        $team = new Team();
        $team->name = $request->get('name');
        $team->year_foundation = $request->get('year_foundation');
        $team->gymnasium = $request->get('gymnasium');
        $team->category = $request->get('category');
        $team->save();

        return response()->json($team);
    }

    function read(int $team_id)
    {
        $team = Team::find($team_id);
        return response()->json($team);
    }

    function update(Request $request, int $team_id)
    {
        $team = Team::find($team_id);
        $team->name = $request->get('name');
        $team->year_foundation = $request->get('year_foundation');
        $team->gymnasium = $request->get('gymnasium');
        $team->category = $request->get('category');
        $team->save();

        return response()->json($team);
    }

    function delete(int $team_id)
    {
        $team = Team::find($team_id);
        $team->delete();

        return response()->json(["excluded" => $team]);
    }
}
