<?php

namespace App\Http\Controllers;

use App\Models\League;
use App\Models\Player;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PlayerController extends Controller
{

    public function index(int $league_id, int $team_id): JsonResponse
    {
        $players = League::findOrFail($league_id)
            ->teams()->findOrfail($team_id)
            ->players()
            ->get();
        return response()->json($players);
    }


    public function create(Request $request, int $league_id, int $team_id): JsonResponse
    {
        $team = League::findOrFail($league_id)
            ->teams()->findOrfail($team_id);

        $form = $request->all();

        $player = new Player($form);
        $player->team()->associate($team);
        $player->save();

        return response()->json($player);
    }

    public function read(int $league_id, int $team_id, int $player_id): JsonResponse
    {
        $player = League::findOrFail($league_id)
            ->teams()->findOrfail($team_id)
            ->players()->findOrFail($player_id);

        return response()->json($player);
    }

    public function update(Request $request, int $league_id, int $team_id, int $player_id): JsonResponse
    {
        $player = League::findOrFail($league_id)
            ->teams()->findOrfail($team_id)
            ->players()->findOrFail($player_id);

        $form = $request->all();
        $player->fill($form);
        $player->save();

        return response()->json($player);
    }

    public function delete(int $league_id, int $team_id, int $player_id): JsonResponse
    {
        $player = League::findOrFail($league_id)
            ->teams()->findOrfail($team_id)
            ->players()->findOrFail($player_id);
        $player->delete();

        return response()->json(['excluded' => $player]);
    }
}
