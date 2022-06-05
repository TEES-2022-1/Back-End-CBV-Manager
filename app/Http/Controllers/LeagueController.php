<?php

namespace App\Http\Controllers;

use App\Models\League;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LeagueController extends Controller
{
    public function index(): JsonResponse
    {
        $leagues = League::all();
        return response()->json($leagues);
    }

    public function create(Request $request): JsonResponse
    {
        $form = $request->all();

        $league = new League($form);
        $league->save();

        return response()->json($league);
    }

    public function read(int $league_id): JsonResponse
    {
        $league = League::findOrFail($league_id);
        return response()->json($league);
    }

    public function update(Request $request, int $league_id): JsonResponse
    {
        $form = $request->all();
        $league = League::findOrfail($league_id);
        $league->fill($form);
        $league->save();

        return response()->json($league);
    }

    public function delete(int $league_id): JsonResponse
    {
        $league = League::findOrFail($league_id);
        $league->delete();

        return response()->json(["excluded" => $league]);
    }
}
