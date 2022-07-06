<?php

namespace App\Http\Controllers;

use App\Models\League;
use App\Models\Team;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index(int $league_id): JsonResponse
    {
        $teams = League::findOrFail($league_id)->teams()->get();
        return response()->json($teams);
    }

    public function create(Request $request, int $league_id): JsonResponse
    {
        $league = League::findOrFail($league_id);

        $form = $request->all();

        $team = new Team($form);
        if (!empty($form['image'])) {
            $filename = md5(time()) . '.' . $form['image']->extension();
            $form['image']->storeAs('images', $filename);

            $team->image = route('images', compact('filename'));
        }

        $team->league()->associate($league);
        $team->save();

        return response()->json($team);
    }

    public function read(int $league_id, int $team_id): JsonResponse
    {
        $team = League::findOrFail($league_id)->teams()->findOrFail($team_id);
        return response()->json($team);
    }

    public function update(Request $request, int $league_id, int $team_id): JsonResponse
    {
        $team = League::findOrFail($league_id)->teams()->findOrFail($team_id);

        $form = $request->all();
        $team->fill($form);

        if (!empty($form['image'])) {
            $filename = md5(time()) . '.' . $form['image']->extension();
            $form['image']->storeAs('images', $filename);

            $team->image = route('images', compact('filename'));
        }

        $team->save();

        return response()->json($team);
    }

    public function delete(int $league_id, int $team_id): JsonResponse
    {
        $team = League::findOrFail($league_id)->teams()->findOrFail($team_id);
        $team->delete();

        return response()->json(["excluded" => $team]);
    }
}
