<?php

namespace App\Http\Controllers;

use App\DataTables\CriptomonedaTransaccionDataTable;
use App\DataTables\Scopes\ScopeCriptomonedaTransaccionDataTables;
use App\Http\Requests\CreateCriptomonedaTransaccionRequest;
use App\Http\Requests\UpdateCriptomonedaTransaccionRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\CriptomonedaTransaccion;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CriptomonedaTransaccionController extends AppBaseController
{

    public function __construct()
    {
//        $this->middleware('permission:Ver Transaccións')->only('show');
//        $this->middleware('permission:Crear Transaccións')->only(['create','store']);
//        $this->middleware('permission:Editar Transaccións')->only(['edit','update']);
//        $this->middleware('permission:Eliminar Transaccións')->only('destroy');
    }
    /**
     * Display a listing of the CriptomonedaTransaccion.
     */
    public function index(CriptomonedaTransaccionDataTable $criptomonedaTransaccionDataTable)
    {

        $scope = new ScopeCriptomonedaTransaccionDataTables();

        $criptomonedaTransaccionDataTable->addScope($scope);

        return $criptomonedaTransaccionDataTable->render('criptomoneda_transaccions.index');

    }


    /**
     * Show the form for creating a new CriptomonedaTransaccion.
     */
    public function create()
    {
        return view('criptomoneda_transaccions.create');
    }

    /**
     * Store a newly created CriptomonedaTransaccion in storage.
     */
    public function store(CreateCriptomonedaTransaccionRequest $request)
    {

        $request->merge([
            'user_id' => auth()->user()->id,
        ]);

        try {
            DB::beginTransaction();


            /** @var CriptomonedaTransaccion $criptomonedaTransaccion */
            $criptomonedaTransaccion = CriptomonedaTransaccion::create($request->all());

            $criptomonedaTransaccion->user->transaccionBilletera($criptomonedaTransaccion);

        } catch (Exception $exception) {
            DB::rollBack();

            flash()->error($exception->getMessage());

            return redirect()->back()->withInput()->withErrors($exception->getMessage());
        }

        DB::commit();

        flash()->success('Transacción guardada.');

        return redirect(route('transacciones.index'));
    }

    /**
     * Display the specified CriptomonedaTransaccion.
     */
    public function show($id)
    {
        /** @var CriptomonedaTransaccion $criptomonedaTransaccion */
        $criptomonedaTransaccion = CriptomonedaTransaccion::find($id);

        if (empty($criptomonedaTransaccion)) {
            flash()->error('Transacción no encontrada');

            return redirect(route('transacciones.index'));
        }

        return view('criptomoneda_transaccions.show')->with('criptomonedaTransaccion', $criptomonedaTransaccion);
    }

    /**
     * Show the form for editing the specified CriptomonedaTransaccion.
     */
    public function edit($id)
    {
        /** @var CriptomonedaTransaccion $criptomonedaTransaccion */
        $criptomonedaTransaccion = CriptomonedaTransaccion::find($id);

        if (empty($criptomonedaTransaccion)) {
            flash()->error('Transacción no encontrada');

            return redirect(route('transacciones.index'));
        }

        return view('criptomoneda_transaccions.edit')->with('criptomonedaTransaccion', $criptomonedaTransaccion);
    }

    /**
     * Update the specified CriptomonedaTransaccion in storage.
     */
    public function update($id, UpdateCriptomonedaTransaccionRequest $request)
    {
        /** @var CriptomonedaTransaccion $criptomonedaTransaccion */
        $criptomonedaTransaccion = CriptomonedaTransaccion::find($id);

        if (empty($criptomonedaTransaccion)) {
            flash()->error('Transacción no encontrada');

            return redirect(route('transacciones.index'));
        }

        $criptomonedaTransaccion->fill($request->all());
        $criptomonedaTransaccion->save();

        flash()->success('Transacción actualizada.');

        return redirect(route('transacciones.index'));
    }

    /**
     * Remove the specified CriptomonedaTransaccion from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var CriptomonedaTransaccion $criptomonedaTransaccion */
        $criptomonedaTransaccion = CriptomonedaTransaccion::find($id);

        if (empty($criptomonedaTransaccion)) {
            flash()->error('Transacción no encontrada');

            return redirect(route('transacciones.index'));
        }

        $criptomonedaTransaccion->delete();

        flash()->success('Transacción eliminada.');

        return redirect(route('transacciones.index'));
    }
}
