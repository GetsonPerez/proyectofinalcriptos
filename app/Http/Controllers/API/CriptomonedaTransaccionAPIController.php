<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCriptomonedaTransaccionAPIRequest;
use App\Http\Requests\API\UpdateCriptomonedaTransaccionAPIRequest;
use App\Models\CriptomonedaTransaccion;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class CriptomonedaTransaccionAPIController
 */
class CriptomonedaTransaccionAPIController extends AppBaseController
{
    /**
     * Display a listing of the CriptomonedaTransaccions.
     * GET|HEAD /criptomoneda-transaccions
     */
    public function index(Request $request): JsonResponse
    {
        $query = CriptomonedaTransaccion::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $criptomonedaTransaccions = $query->get();

        return $this->sendResponse($criptomonedaTransaccions->toArray(), 'Criptomoneda Transaccions ');
    }

    /**
     * Store a newly created CriptomonedaTransaccion in storage.
     * POST /criptomoneda-transaccions
     */
    public function store(CreateCriptomonedaTransaccionAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var CriptomonedaTransaccion $criptomonedaTransaccion */
        $criptomonedaTransaccion = CriptomonedaTransaccion::create($input);

        return $this->sendResponse($criptomonedaTransaccion->toArray(), 'Criptomoneda Transaccion guardado');
    }

    /**
     * Display the specified CriptomonedaTransaccion.
     * GET|HEAD /criptomoneda-transaccions/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var CriptomonedaTransaccion $criptomonedaTransaccion */
        $criptomonedaTransaccion = CriptomonedaTransaccion::find($id);

        if (empty($criptomonedaTransaccion)) {
            return $this->sendError('Criptomoneda Transaccion no encontrado');
        }

        return $this->sendResponse($criptomonedaTransaccion->toArray(), 'Criptomoneda Transaccion ');
    }

    /**
     * Update the specified CriptomonedaTransaccion in storage.
     * PUT/PATCH /criptomoneda-transaccions/{id}
     */
    public function update($id, UpdateCriptomonedaTransaccionAPIRequest $request): JsonResponse
    {
        /** @var CriptomonedaTransaccion $criptomonedaTransaccion */
        $criptomonedaTransaccion = CriptomonedaTransaccion::find($id);

        if (empty($criptomonedaTransaccion)) {
            return $this->sendError('Criptomoneda Transaccion no encontrado');
        }

        $criptomonedaTransaccion->fill($request->all());
        $criptomonedaTransaccion->save();

        return $this->sendResponse($criptomonedaTransaccion->toArray(), 'CriptomonedaTransaccion actualizado');
    }

    /**
     * Remove the specified CriptomonedaTransaccion from storage.
     * DELETE /criptomoneda-transaccions/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var CriptomonedaTransaccion $criptomonedaTransaccion */
        $criptomonedaTransaccion = CriptomonedaTransaccion::find($id);

        if (empty($criptomonedaTransaccion)) {
            return $this->sendError('Criptomoneda Transaccion no encontrado');
        }

        $criptomonedaTransaccion->delete();

        return $this->sendSuccess('Criptomoneda Transaccion eliminado');
    }
}
