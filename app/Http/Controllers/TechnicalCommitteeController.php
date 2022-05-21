<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\TechnicalCommittee;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TechnicalCommitteeController extends Controller
{
    public function index(int $team_id)
    {
        return TechnicalCommittee::where('team_id', $team_id)->get();
    }


    /**
     * @throws Exception
     */
    public function create(Request $request, int $team_id): JsonResponse
    {
        $team = Team::findOrFail($team_id);

        if (TechnicalCommittee::where('year', $request->get('year'))->where('team_id', $team_id)->first()) {
            throw new Exception('This team already a technical committee for this year.');
        }

        $technicalCommittee = new TechnicalCommittee();
        $technicalCommittee->year = $request->get('year');
        $technicalCommittee->coach = $request->get('coach');
        $technicalCommittee->coach_assistent = $request->get('coach_assistent');
        $technicalCommittee->supervisor = $request->get('supervisor');
        $technicalCommittee->personal_trainer = $request->get('personal_trainer');
        $technicalCommittee->physiotherapist = $request->get('physiotherapist');
        $technicalCommittee->masseuse = $request->get('masseuse');
        $technicalCommittee->doctor = $request->get('doctor');
        $technicalCommittee->team()->associate($team);
        $technicalCommittee->save();

        return response()->json($technicalCommittee);
    }

    public function read(int $team_id, int $technical_committee_id): JsonResponse
    {
        $technicalCommittee = TechnicalCommittee::find($technical_committee_id)->where('team_id', $team_id)->firstOrFail();
        return response()->json($technicalCommittee);
    }


    public function update(Request $request, int $team_id, int $technical_committee_id): JsonResponse
    {
        $technicalCommittee = TechnicalCommittee::find($technical_committee_id)->where('team_id', $team_id)->firstOrFail();
        $technicalCommittee->coach = $request->get('coach');
        $technicalCommittee->coach_assistent = $request->get('coach_assistent');
        $technicalCommittee->supervisor = $request->get('supervisor');
        $technicalCommittee->personal_trainer = $request->get('personal_trainer');
        $technicalCommittee->physiotherapist = $request->get('physiotherapist');
        $technicalCommittee->masseuse = $request->get('masseuse');
        $technicalCommittee->doctor = $request->get('doctor');
        $technicalCommittee->save();

        return response()->json($technicalCommittee);
    }

    public function delete(int $team_id, int $technical_committee_id): JsonResponse
    {
        $technicalCommittee = TechnicalCommittee::find($technical_committee_id)->where('team_id', $team_id)->firstOrFail();
        $technicalCommittee->delete();
        return response()->json(['excluded' => $technicalCommittee]);
    }
}
