<?php

namespace App\DataTables\Scopes;

use Yajra\DataTables\Contracts\DataTableScope;

class ScopeCriptomonedaTransaccionDataTables implements DataTableScope
{


    public $criptomoneda_id;
    public $user_id;
    public $tipo;
    public $cantidad;
    public $precio_usd;
    public $precio_quetzal;
    public $fechas;


    public function __construct()
    {
        $this->criptomoneda_id = request()->criptomoneda_id ?? null;
        $this->user_id = request()->user_id ?? null;
        $this->tipo = request()->tipo ?? null;
        $this->cantidad = request()->cantidad ?? null;
        $this->precio_usd = request()->precio_usd ?? null;
        $this->precio_quetzal = request()->precio_quetzal ?? null;
        $this->fechas = request()->fechas ?? null;
    }
    /**
     * Apply a query scope.
     *
     * @param \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query
     * @return mixed
     */
    public function apply($query)
    {

        if ($this->criptomoneda_id) {
            if (is_array($this->criptomoneda_id)) {
                $query->whereIn('criptomoneda_id', $this->criptomoneda_id);
            } else {
                $query->where('criptomoneda_id', $this->criptomoneda_id);
            }
        }

        if ($this->user_id) {
            $query->where('user_id', $this->user_id);
        }

        if ($this->tipo) {
            $query->where('tipo', $this->tipo);
        }

        if ($this->cantidad) {
            $query->where('cantidad', $this->cantidad);
        }

        if ($this->precio_usd) {
            $query->where('precio_usd', $this->precio_usd);
        }

        if ($this->precio_quetzal) {
            $query->where('precio_quetzal', $this->precio_quetzal);
        }

        if ($this->fechas) {
            $query->whereBetween('created_at', campoRangoFechas($this->fechas));
        }
    }
}
