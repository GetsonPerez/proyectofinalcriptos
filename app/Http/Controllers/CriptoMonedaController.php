<?php

namespace App\Http\Controllers;

use App\DataTables\CriptoMonedaDataTable;
use App\Http\Requests\CreateCriptoMonedaRequest;
use App\Http\Requests\UpdateCriptoMonedaRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\CriptoMoneda;
use Illuminate\Http\Request;

class CriptoMonedaController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Cripto Monedas')->only('show');
        $this->middleware('permission:Crear Cripto Monedas')->only(['create','store']);
        $this->middleware('permission:Editar Cripto Monedas')->only(['edit','update']);
        $this->middleware('permission:Eliminar Cripto Monedas')->only('destroy');
    }
    /**
     * Display a listing of the CriptoMoneda.
     */
    public function index(CriptoMonedaDataTable $criptoMonedaDataTable)
    {
    return $criptoMonedaDataTable->render('cripto_monedas.index');
    }


    /**
     * Show the form for creating a new CriptoMoneda.
     */
    public function create()
    {
        return view('cripto_monedas.create');
    }

    /**
     * Store a newly created CriptoMoneda in storage.
     */
    public function store(CreateCriptoMonedaRequest $request)
    {
        $input = $request->all();

        /** @var CriptoMoneda $criptoMoneda */
        $criptoMoneda = CriptoMoneda::create($input);

        flash()->success('Cripto Moneda guardado.');

        return redirect(route('criptoMonedas.index'));
    }

    /**
     * Display the specified CriptoMoneda.
     */
    public function show($id)
    {
        /** @var CriptoMoneda $criptoMoneda */
        $criptoMoneda = CriptoMoneda::find($id);

        if (empty($criptoMoneda)) {
            flash()->error('Cripto Moneda no encontrado');

            return redirect(route('criptoMonedas.index'));
        }

        return view('cripto_monedas.show')->with('criptoMoneda', $criptoMoneda);
    }

    /**
     * Show the form for editing the specified CriptoMoneda.
     */
    public function edit($id)
    {
        /** @var CriptoMoneda $criptoMoneda */
        $criptoMoneda = CriptoMoneda::find($id);

        if (empty($criptoMoneda)) {
            flash()->error('Cripto Moneda no encontrado');

            return redirect(route('criptoMonedas.index'));
        }

        return view('cripto_monedas.edit')->with('criptoMoneda', $criptoMoneda);
    }

    /**
     * Update the specified CriptoMoneda in storage.
     */
    public function update($id, UpdateCriptoMonedaRequest $request)
    {
        /** @var CriptoMoneda $criptoMoneda */
        $criptoMoneda = CriptoMoneda::find($id);

        if (empty($criptoMoneda)) {
            flash()->error('Cripto Moneda no encontrado');

            return redirect(route('criptoMonedas.index'));
        }

        $criptoMoneda->fill($request->all());
        $criptoMoneda->save();

        flash()->success('Cripto Moneda actualizado.');

        return redirect(route('criptoMonedas.index'));
    }

    /**
     * Remove the specified CriptoMoneda from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var CriptoMoneda $criptoMoneda */
        $criptoMoneda = CriptoMoneda::find($id);

        if (empty($criptoMoneda)) {
            flash()->error('Cripto Moneda no encontrado');

            return redirect(route('criptoMonedas.index'));
        }

        $criptoMoneda->delete();

        flash()->success('Cripto Moneda eliminado.');

        return redirect(route('criptoMonedas.index'));
    }
}
