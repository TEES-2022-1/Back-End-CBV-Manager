<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Position;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function index(): JsonResponse
    {
        $players = Player::all();
        return response()->json($players);
    }

    public function create(Request $request): JsonResponse
    {
        $position = Position::findOrFail($request->get("position_id"));

        $player = new Player();
        $player->name = $request->get('name');
        $player->birthday = $request->get('birthday');
        $player->position()->associate($position);
        $player->save();

        return response()->json($player);
    }

    public function read(int $player_id): JsonResponse
    {
        $player = Player::findOrFail($player_id);

        return response()->json($player);
    }

    public function update(Request $request, int $player_id): JsonResponse
    {
        $player = Player::find($player_id)->where("position_id", $request->get("position_id"))->firstOrFail();
        $player->name = $request->get('name');
        $player->birthday = $request->get('birthday');
        $player->save();

        return response()->json($player);
    }

    public function delete(int $player_id): JsonResponse
    {
        $player = Player::find($player_id)->firstOrFail();
        $player->delete();

        return response()->json(['excluded' => $player]);
    }
}
