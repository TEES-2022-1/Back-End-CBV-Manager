<?php

namespace App\Http\Controllers;

use App\Models\League;
use Illuminate\Http\JsonResponse;

class ClassificationController extends Controller
{
    public function index(int $league_id): JsonResponse
    {
        $league = League::findOrFail($league_id);
        $classifications = $league->classifications()->orderBy('id')->get();

        return response()->json($classifications);
    }

    public function read(int $league_id, int $classification_id): JsonResponse
    {
        $league = League::findOrFail($league_id);
        $classification = $league->classifications()->findOrFail($classification_id);

        return response()->json($classification);
    }
}
