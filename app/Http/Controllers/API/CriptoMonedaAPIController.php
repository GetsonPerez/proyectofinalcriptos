<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCriptoMonedaAPIRequest;
use App\Http\Requests\API\UpdateCriptoMonedaAPIRequest;
use App\Models\CriptoMoneda;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class CriptoMonedaAPIController
 */
class CriptoMonedaAPIController extends AppBaseController
{
    /**
     * Display a listing of the CriptoMonedas.
     * GET|HEAD /cripto-monedas
     */
    public function index(Request $request): JsonResponse
    {
        $query = CriptoMoneda::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $criptoMonedas = $query->get();

        return $this->sendResponse($criptoMonedas->toArray(), 'Cripto Monedas ');
    }

    /**
     * Store a newly created CriptoMoneda in storage.
     * POST /cripto-monedas
     */
    public function store(CreateCriptoMonedaAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var CriptoMoneda $criptoMoneda */
        $criptoMoneda = CriptoMoneda::create($input);

        return $this->sendResponse($criptoMoneda->toArray(), 'Cripto Moneda guardado');
    }

    /**
     * Display the specified CriptoMoneda.
     * GET|HEAD /cripto-monedas/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var CriptoMoneda $criptoMoneda */
        $criptoMoneda = CriptoMoneda::find($id);

        if (empty($criptoMoneda)) {
            return $this->sendError('Cripto Moneda no encontrado');
        }

        return $this->sendResponse($criptoMoneda->toArray(), 'Cripto Moneda ');
    }

    /**
     * Update the specified CriptoMoneda in storage.
     * PUT/PATCH /cripto-monedas/{id}
     */
    public function update($id, UpdateCriptoMonedaAPIRequest $request): JsonResponse
    {
        /** @var CriptoMoneda $criptoMoneda */
        $criptoMoneda = CriptoMoneda::find($id);

        if (empty($criptoMoneda)) {
            return $this->sendError('Cripto Moneda no encontrado');
        }

        $criptoMoneda->fill($request->all());
        $criptoMoneda->save();

        return $this->sendResponse($criptoMoneda->toArray(), 'CriptoMoneda actualizado');
    }

    /**
     * Remove the specified CriptoMoneda from storage.
     * DELETE /cripto-monedas/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var CriptoMoneda $criptoMoneda */
        $criptoMoneda = CriptoMoneda::find($id);

        if (empty($criptoMoneda)) {
            return $this->sendError('Cripto Moneda no encontrado');
        }

        $criptoMoneda->delete();

        return $this->sendSuccess('Cripto Moneda eliminado');
    }
}
