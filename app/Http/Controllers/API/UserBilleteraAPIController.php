<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateUserBilleteraAPIRequest;
use App\Http\Requests\API\UpdateUserBilleteraAPIRequest;
use App\Models\UserBilletera;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class UserBilleteraAPIController
 */
class UserBilleteraAPIController extends AppBaseController
{
    /**
     * Display a listing of the UserBilleteras.
     * GET|HEAD /user-billeteras
     */
    public function index(Request $request): JsonResponse
    {
        $query = UserBilletera::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $userBilleteras = $query->get();

        return $this->sendResponse($userBilleteras->toArray(), 'User Billeteras ');
    }

    /**
     * Store a newly created UserBilletera in storage.
     * POST /user-billeteras
     */
    public function store(CreateUserBilleteraAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var UserBilletera $userBilletera */
        $userBilletera = UserBilletera::create($input);

        return $this->sendResponse($userBilletera->toArray(), 'User Billetera guardado');
    }

    /**
     * Display the specified UserBilletera.
     * GET|HEAD /user-billeteras/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var UserBilletera $userBilletera */
        $userBilletera = UserBilletera::find($id);

        if (empty($userBilletera)) {
            return $this->sendError('User Billetera no encontrado');
        }

        return $this->sendResponse($userBilletera->toArray(), 'User Billetera ');
    }

    /**
     * Update the specified UserBilletera in storage.
     * PUT/PATCH /user-billeteras/{id}
     */
    public function update($id, UpdateUserBilleteraAPIRequest $request): JsonResponse
    {
        /** @var UserBilletera $userBilletera */
        $userBilletera = UserBilletera::find($id);

        if (empty($userBilletera)) {
            return $this->sendError('User Billetera no encontrado');
        }

        $userBilletera->fill($request->all());
        $userBilletera->save();

        return $this->sendResponse($userBilletera->toArray(), 'UserBilletera actualizado');
    }

    /**
     * Remove the specified UserBilletera from storage.
     * DELETE /user-billeteras/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var UserBilletera $userBilletera */
        $userBilletera = UserBilletera::find($id);

        if (empty($userBilletera)) {
            return $this->sendError('User Billetera no encontrado');
        }

        $userBilletera->delete();

        return $this->sendSuccess('User Billetera eliminado');
    }
}
