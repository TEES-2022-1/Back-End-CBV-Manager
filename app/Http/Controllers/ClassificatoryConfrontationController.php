<?php

namespace App\Http\Controllers;

use App\Models\League;
use App\Services\ClassificatoryConfrontationsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ClassificatoryConfrontationController extends Controller
{
    private ClassificatoryConfrontationsService $classificatoryConfrontationsService;

    public function __construct(ClassificatoryConfrontationsService $classificatoryConfrontationsService)
    {
        $this->classificatoryConfrontationsService = $classificatoryConfrontationsService;
    }

    /**
     * @throws \Exception
     */
    public function generate(int $league_id): Response
    {
        $league = League::findOrfail($league_id);
        $this->classificatoryConfrontationsService->generateConfrontations($league);

        return response()->noContent();
    }

    public function index(int $league_id): JsonResponse
    {
        $league = League::findOrfail($league_id);
        $confrontations = $league->classificatoryConfrontations()->with('confrontation')->get();

        return response()->json($confrontations);
    }

    public function read(int $league_id, int $confrontation_id): JsonResponse
    {
        $league = League::findOrfail($league_id);
        $confrontation = $league->classificatoryConfrontations()->with('confrontation')->findOrFail($confrontation_id);
        return response()->json($confrontation);
    }

    public function update(Request $request, int $league_id, int $confrontation_id): JsonResponse
    {
        $form = $request->all();

        $league = League::findOrfail($league_id);
        $classificatoryConfrontation = $league->classificatoryConfrontations()->findOrFail($confrontation_id);
        $confrontation = $classificatoryConfrontation->confrontation()->first();
        $confrontation->fill($form);
        $confrontation->save();

        return response()->json($classificatoryConfrontation->load('confrontation'));
    }
}
