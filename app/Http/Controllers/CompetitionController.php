<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CompetitionController extends Controller
{
    public function index(): JsonResponse
    {
        $competitions = Competition::all();
        return response()->json($competitions);
    }

    public function create(Request $request): JsonResponse
    {
        $competition = new Competition();
        $competition->title = $request->get('title');
        $competition->year = $request->get('year');
        $competition->category = $request->get('category');
        $competition->begin_in = $request->get('begin_in');
        $competition->classificatory_limit = $request->get('classificatory_limit');
        $competition->quarter_finals_limit = $request->get('quarter_finals_limit');
        $competition->semifinals_limit = $request->get('semifinals_limit');
        $competition->finish_in = $request->get('finish_in');
        $competition->save();

        return response()->json($competition);
    }

    public function read(int $competition_id): JsonResponse
    {
        $competition = Competition::findOrFail($competition_id);
        return response()->json($competition);
    }

    public function update(Request $request, int $competition_id): JsonResponse
    {
        $competition = Competition::findOrfail($competition_id);
        $competition->title = $request->get('title');
        $competition->year = $request->get('year');
        $competition->category = $request->get('category');
        $competition->begin_in = $request->get('begin_in');
        $competition->classificatory_limit = $request->get('classificatory_limit');
        $competition->quarter_finals_limit = $request->get('quarter_finals_limit');
        $competition->semifinals_limit = $request->get('semifinals_limit');
        $competition->finish_in = $request->get('finish_in');
        $competition->save();

        return response()->json($competition);
    }

    public function delete(int $competition_id): JsonResponse
    {
        $competition = Competition::findOrFail($competition_id);
        $competition->delete();

        return response()->json(["excluded" => $competition]);
    }
}
