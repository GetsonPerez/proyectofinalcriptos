<?php

namespace App\DataTables;

use App\Models\CriptomonedaTransaccion;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Services\DataTable;

class CriptomonedaTransaccionDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {

        return datatables()
            ->eloquent($query)
            ->addColumn('action', function(CriptomonedaTransaccion $criptomonedaTransaccion){
                $id = $criptomonedaTransaccion->id;
                return view('criptomoneda_transaccions.datatables_actions',compact('criptomonedaTransaccion','id'));
            })
            ->editColumn('id',function (CriptomonedaTransaccion $criptomonedaTransaccion){

                return $criptomonedaTransaccion->id;

            })
            ->editColumn('cantidad',function (CriptomonedaTransaccion $criptomonedaTransaccion){

                return nfp($criptomonedaTransaccion->cantidad,6);

            })
            ->editColumn('precio_usd',function (CriptomonedaTransaccion $criptomonedaTransaccion){

                return nfp($criptomonedaTransaccion->precio_usd,2);

            })
            ->editColumn('precio_quetzal',function (CriptomonedaTransaccion $criptomonedaTransaccion){

                return nfp($criptomonedaTransaccion->precio_quetzal,2);

            })
            ->editColumn('created_at',function (CriptomonedaTransaccion $criptomonedaTransaccion){

                return $criptomonedaTransaccion->created_at->format('d/m/Y');

            })
            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\CriptomonedaTransaccion $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(CriptomonedaTransaccion $model)
    {
        $query = $model->newQuery()
            ->select($model->getTable().'.*')
            ->with(['criptomoneda','user'])
            ->orderBy('id','desc');

        //si el usuario no tiene permiso de ver todas las transacciones solo se le mostraran las suyas
        if (auth()->user()->cannot("Ver todas la transacciones")) {
            $query->where('user_id',auth()->user()->id);
        }

        return $query ;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                ->columns($this->getColumns())
                ->minifiedAjax()
                ->ajax([
                'data' => "function(data) { formatDataDataTables($('#formFiltersDatatables').serializeArray(), data);   }"
                ])
                ->info(true)
                ->language(['url' => asset('js/SpanishDataTables.json')])
                ->responsive(true)
                ->stateSave(false)
                ->orderBy(1,'desc')
                ->dom('
                    <"row mb-2"
                    <"col-sm-12 col-md-6" B>
                    <"col-sm-12 col-md-6" f>
                    >
                    rt
                    <"row"
                    <"col-sm-6 order-2 order-sm-1" ip>
                    <"col-sm-6 order-1 order-sm-2 text-right" l>
                    >
                ')
                ->buttons(

                    Button::make('reset')
                        ->addClass('')
                        ->text('<i class="fa fa-undo"></i> <span class="d-none d-sm-inline">Reiniciar</span>'),

                    Button::make('export')
                        ->extend('collection')
                        ->addClass('')
                        ->text('<i class="fa fa-download"></i> <span class="d-none d-sm-inline">Exportar</span>')
                        ->buttons([
                            Button::make('print')
                                ->addClass('dropdown-item')
                                ->text('<i class="fa fa-print"></i> <span class="d-none d-sm-inline"> Imprimir</span>'),
                            Button::make('csv')
                                ->addClass('dropdown-item')
                                ->text('<i class="fa fa-file-csv"></i> <span class="d-none d-sm-inline"> Csv</span>'),
                            Button::make('pdf')
                                ->addClass('dropdown-item')
                                ->text('<i class="fa fa-file-pdf"></i> <span class="d-none d-sm-inline"> Pdf</span>'),
                            Button::make('excel')
                                ->addClass('dropdown-item')
                                ->text('<i class="fa fa-file-excel"></i> <span class="d-none d-sm-inline"> Excel</span>'),
                        ]),
                );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id'),
            Column::make('fecha')->data('created_at')->name('created_at'),
            Column::make('criptomoneda')->data('criptomoneda.nombre')->name('criptomoneda.nombre'),
            Column::make('user')->data('user.name')->name('user.name'),
            Column::make('tipo'),
            Column::make('cantidad'),
            Column::make('precio_usd'),
            Column::make('precio_quetzal'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width('20%')
                ->addClass('text-center')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'criptomoneda_transaccions_datatable_' . time();
    }
}
