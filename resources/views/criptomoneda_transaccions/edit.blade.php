@extends('layouts.app')

@section('titulo_pagina', 'Editar Criptomoneda Transaccion' )

@section('content')



    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Editar Criptomoneda Transacción</h1>
                </div>
                <div class="col ">
                    <a class="btn btn-outline-info float-right"
                       href="{{ route('transacciones.index') }}"
                    >
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;
                        <span class="d-none d-sm-inline">Regresar</span>
                    </a>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <div class="content">
        <div class="container-fluid">

            @include('layouts.partials.request_errors')

            <div class="card">

                {!! Form::model($criptomonedaTransaccion, ['route' => ['transacciones.update', $criptomonedaTransaccion->id], 'method' => 'patch','class' => 'esperar']) !!}

                <div class="card-body">
                    <div class="row">
                        @include('criptomoneda_transaccions.fields')
                    </div>
                </div>

{{--                <div class="card-footer text-end">--}}

{{--                    <a href="{{ route('transacciones.index') }}"--}}
{{--                       class="btn btn-outline-secondary round me-1">--}}
{{--                        <i class="fa fa-ban"></i>--}}
{{--                        Cancelar--}}
{{--                    </a>--}}

{{--                    <button type="submit" class="btn btn-success round">--}}
{{--                        <i class="fa fa-save"></i>--}}
{{--                        Guardar--}}
{{--                    </button>--}}
{{--                </div>--}}

                {!! Form::close() !!}


            </div>
        </div>
    </div>


@endsection
