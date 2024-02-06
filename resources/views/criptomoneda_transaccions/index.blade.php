@extends('layouts.app')

@section('titulo_pagina', 'Criptomoneda Transaccions')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Histórico simulaciones</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item">
                            <a class="btn btn-outline-success"
                               href="{{ route('transacciones.create') }}">
                                <i class="fa fa-plus"></i>
                                <span class="d-none d-sm-inline">
                                    Nueva simulación
                                </span>
                            </a>
                        </li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <div class="content">
        <div class="container-fluid">

            <div class="card card-primary collapsed-card">
                <div class="card-header">
                    <h3 class="card-title">Filtros</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                        </button>
                    </div>

                </div>

                <div class="card-body">
                    @include('criptomoneda_transaccions.filtros')
                </div>

            </div>

            <div class="clearfix"></div>
            <div class="card card-primary">
                <div class="card-body">

                    @include('criptomoneda_transaccions.table')

                </div>
            </div>
            <div class="text-center">

            </div>
        </div>
    </div>



@endsection
