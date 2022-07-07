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
        $confrontations = $league->classificatoryConfrontations()->with(['confrontation' => function ($query){
            $query->with('teamHost');
            $query->with('teamGuest');
        }])->orderBy('id')->get();

        return response()->json($confrontations);
    }

    public function read(int $league_id, int $confrontation_id): JsonResponse
    {
        $league = League::findOrfail($league_id);
        $confrontation = $league->classificatoryConfrontations()->with(['confrontation' => function ($query){
            $query->with('teamHost');
            $query->with('teamGuest');
        }])->findOrFail($confrontation_id);
        return response()->json($confrontation);
    }

    public function update(Request $request, int $league_id, int $confrontation_id): JsonResponse
    {
        $form = $request->all();

        $league = League::findOrfail($league_id);
        $classificatoryConfrontation = $league->classificatoryConfrontations()->findOrFail($confrontation_id);
        $confrontation = $classificatoryConfrontation->confrontation()->first();
        $confrontation->fill($form);

        $result_host = 0;
        $result_guest = 0;
        foreach (range(1, 5) as $n) {
            if (!isset($form["set{$n}_points_host"]) || !isset($form["set{$n}_points_guest"])) {
                continue;
            }
            if (($form["set{$n}_points_host"] + $form["set{$n}_points_guest"]) <= 0) {
                continue;
            }
            if ($form["set{$n}_points_host"] > $form["set{$n}_points_guest"]) {
                $result_host++;
            } else {
                $result_guest++;
            }
        }

        if ($result_host == 3 && $result_guest == 0
            || $result_host == 3 && $result_guest == 1
            || $result_host == 3 && $result_guest == 2
            || $result_host == 0 && $result_guest == 3
            || $result_host == 1 && $result_guest == 3
            || $result_host == 2 && $result_guest == 3) {
            $confrontation->result_host = $result_host;
            $confrontation->result_guest = $result_guest;
        }

        $confrontation->save();

        return response()->json($classificatoryConfrontation->load('confrontation'));
    }
}
