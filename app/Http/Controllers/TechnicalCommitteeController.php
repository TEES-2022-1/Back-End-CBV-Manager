<?php

namespace App\Http\Controllers;

use App\Models\League;
use App\Models\TechnicalCommittee;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TechnicalCommitteeController extends Controller
{
    public function index(int $league_id, int $team_id): JsonResponse
    {
        $technicalCommittee = League::findOrFail($league_id)
            ->teams()->findOrfail($team_id)
            ->technicalCommittee()
            ->firstOrFail();
        return response()->json($technicalCommittee);
    }

    public function create(Request $request, int $league_id, int $team_id): JsonResponse
    {
        $team = League::findOrFail($league_id)
            ->teams()->findOrfail($team_id);

        $form = $request->all();

        $technicalCommittee = new TechnicalCommittee($form);
        $technicalCommittee->team()->associate($team);
        $technicalCommittee->save();

        return response()->json($technicalCommittee);
    }

    public function update(Request $request, int $league_id, int $team_id): JsonResponse
    {
        $technicalCommittee = League::findOrFail($league_id)
            ->teams()->findOrfail($team_id)
            ->technicalCommittee()
            ->firstOrFail();

        $form = $request->all();
        $technicalCommittee->fill($form);
        $technicalCommittee->save();

        return response()->json($technicalCommittee);
    }

    public function delete(int $league_id, int $team_id): JsonResponse
    {
        $technicalCommittee = League::findOrFail($league_id)
            ->teams()->findOrfail($team_id)
            ->technicalCommittee()
            ->firstOrFail();
        $technicalCommittee->delete();
        return response()->json(['excluded' => $technicalCommittee]);
    }
}
