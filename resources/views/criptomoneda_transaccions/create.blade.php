@extends('layouts.app')

@section('titulo_pagina', 'Crear Criptomoneda Transaccion')

@section('content')


    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Simular Compra y Venta de Criptomonedas</h1>
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
                <div class="card-body">

                    {!! Form::open(['route' => 'transacciones.store','class' => 'esperar']) !!}


                    <div id="cambioCriptos" class="form-row">
                        <div class="form-group col-sm-12 text-info">
                            Valor al día 1 Dolar = Q<span v-text="nf(valorQuetzalDolar)" ></span>

                        </div>


                        <!--            tabla de criptomonedas
                        ------------------------------------------------------------------------>
                        <div class="form-group col-sm-4 p-2">
                            <h5 class="mb-2">
                                Criptomonedas
                            </h5>
                            <table class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Criptomoneda</th>
                                    <th>Valor USD</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="cripto in criptomonedas">
                                    <td >
                                        <img :src="cripto.imagen" width="20" height="20" alt="" class="mr-2">
                                        <span v-text="cripto.text"></span>
                                    </td>
                                    <td v-text="nfp(cripto.valor_usdt)"></td>
                                </tr>
                                </tbody>
                            </table>

                        </div>



                        <!--            Campos transacción
                        ------------------------------------------------------------------------>
                        <div class="form-group  col-sm-8 p-2">

                            <div class="row ">
                                <div class="col text-center mb-4">

                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">



                                        <label class="btn btn-outline-warning" :class="{'active' : tipo==='compra'}">
                                            <input type="radio" name="tipo" v-model="tipo" value="compra" id="option1" autocomplete="off" >
                                            <i class="fa fa-wallet"></i>
                                            Compra
                                        </label>


                                        <label class="btn btn-outline-success" :class="{'active' : tipo==='venta'}">
                                            <input type="radio" name="tipo" v-model="tipo" value="venta" id="option2" autocomplete="off">
                                            <i class="fa fa-money-bill"></i>
                                            Venta
                                        </label>



                                    </div>
                                </div>

                            </div>

                            <div class="form-row">
                                <!-- Criptomoneda Id Field -->
                                <div class="form-group col-sm-6 " :class="{'order-12' : tipo=='compra'}" >
                                    <label for="criptomoneda_id">Criptomoneda</label>
                                    <multiselect
                                        v-model="criptomonedaSeleccionada"
                                        :options="criptomonedas"
                                        placeholder="Seleccione una criptomoneda"
                                        label="text"
                                        track-by="id">

                                    </multiselect>
                                    <span class="text-muted" v-show="criptomonedaSeleccionada">
                                        Saldo actual: <span v-text="criptomonedaSeleccionada ? nfp(criptomonedaSeleccionada.saldo_usuario) : 0"></span>
                                    </span>
                                    <input type="hidden" name="criptomoneda_id" :value="criptomonedaSeleccionada ? criptomonedaSeleccionada.id : null">
                                </div>


                                <!-- Cantidad Field -->
                                <div class="form-group col-sm-6 order-1" v-show="tipo=='venta'">
                                    <label for="cantidad">Cantidad</label>
                                    <input type="number" class="form-control" step="any" v-model="cantida_criptomonedas" name="cantida_criptomonedas">
                                </div>

                                <!-- Cantidad quetzales Field -->
                                <div class="form-group col-sm-6" v-show="tipo=='compra'">
                                    <label for="cantidad">Cantidad quetzales</label>
                                    <input type="number" class="form-control" step="any" v-model="cantida_quetzales" name="cantida_quetzales">
                                </div>
                            </div>

                            <!--            Resultados
                        ------------------------------------------------------------------------>
                            <div class="form-row">
                                <div class="form-group col-sm-12">

                                    <h5 class="mb-2">
                                        Resultado simulación
                                    </h5>
                                    <div class="row">
                                        <div class="col-sm-4" :class="{'order-12' : tipo=='compra'}">
                                            <div class="info-box">
                                            <span class="info-box-icon bg-info">

                                                <span v-show="criptomonedaSeleccionada">
                                                    <img :src="criptomonedaSeleccionada ? criptomonedaSeleccionada.imagen : ''"
                                                         width="40"
                                                         height="40"
                                                         alt=""
                                                         class="mr-2">

                                                </span>

                                                <span v-show="!criptomonedaSeleccionada">
                                                    <i class="fa fa-circle"></i>
                                                </span>
                                            </span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text" v-text="criptomonedaSeleccionada ? criptomonedaSeleccionada.text : ''"></span>

                                                    <span class="info-box-number"  v-text="nfp(totalCriptomonedas)"></span>

                                                </div>

                                            </div>

                                        </div>

                                        <div class="col-sm-4" :class="{'order-6' : tipo=='compra'}">
                                            <div class="info-box">
                                            <span class="info-box-icon bg-success">
                                                <i class="fa fa-usd"></i>
                                            </span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">Valor en dolares</span>
                                                    <span class="info-box-number" v-text="nfp(totalDolares)"></span>
                                                </div>

                                            </div>

                                        </div>

                                        <div class="col-sm-4" :class="{'order-1' : tipo=='compra'}">
                                            <div class="info-box">
                                            <span class="info-box-icon bg-warning text-white text-bold">
                                                Q
                                            </span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">Valor en quetzales</span>
                                                    <span class="info-box-number"  v-text="nfp(totalQuetzales)"></span>
                                                </div>

                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>


                        <!-- Submit Field -->
                        <div class="form-group col-sm-12 mt-2 text-right" >


                            <input type="hidden" name="cantidad" :value="tipo=='venta' ? cantida_criptomonedas : totalCriptomonedas">
                            <input type="hidden" name="precio_usd" :value="totalDolares">
                            <input type="hidden" name="precio_quetzal" :value="totalQuetzales">


                            <a href="{{ route('transacciones.index') }}"
                               class="btn btn-outline-secondary round me-1 mr-1">
                                <i class="fa fa-ban"></i>
                                Cancelar
                            </a>

                            <button type="submit" class="btn btn-success round" :disabled="!hayResultados">
                                <i class="fa fa-save"></i>
                                Guardar
                            </button>
                        </div>
                    </div>


                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>


@endsection


@push('scripts')
    <script>
        const app = new Vue({
            el: '#cambioCriptos',
            created() {
                this.conusultaEnTiempoReal();
                this.obtenerValorDolarQuetzal();


            },

            mounted() {
                let criptoRecibida = '{{request()->criptomoneda_id}}';
                if(criptoRecibida){
                    this.criptomonedaSeleccionada = this.criptomonedas.find(cripto => cripto.id == criptoRecibida);
                }
            },
            data: {
                criptomonedas: @json(\App\Models\CriptoMoneda::all()),
                criptomonedaSeleccionada: null,
                cantida_quetzales: @json(old('cantida_quetzales',0)),
                cantida_criptomonedas: @json(old('cantida_criptomonedas',0)),
                valorCriptoMonedaDolar: 0,

                valorQuetzalDolar: 7.5,
                tipo: 'venta'
            },
            methods: {
                nfp: function(numero){

                    numero = numero || 0;

                    return number_format(numero,6)
                },
                nf: function(numero){

                    numero = numero || 0;

                    return number_format(numero,6)

                },

                async consultaValorCriptoMoneda(){

                    esperar();


                    if(this.criptomonedaSeleccionada == null){
                        alertWarning('Debe seleccionar una criptomoneda');
                        return;

                    }

                    if(this.cantida_criptomonedas <= 0){
                        alertWarning('Debe ingresar un monto mayor a 0');
                        return;
                    }

                    let nombreCriptoMoneda = this.criptomonedaSeleccionada.nombre.toLowerCase();


                    let url = 'https://api.coingecko.com/api/v3/simple/price?ids='+nombreCriptoMoneda+'&vs_currencies=usd';

                    try {

                        let response = await axios.get(url);

                        this.valorCriptoMonedaDolar = response.data[nombreCriptoMoneda].usd;



                    }catch (e) {

                        notifyErrorApi(e)

                    }

                    finEspera();


                },
                conusultaEnTiempoReal(){

                    this.criptomonedas.forEach(cripto => {
                        let nombre = cripto.simbolo.toLowerCase();

                        let cliente = new WebSocket('wss://stream.binance.com:9443/ws/'+nombre+'usdt@kline_1s');

                        cliente.onmessage = (event) => {
                            data = JSON.parse(event.data);
                            console.log("Valor "+nombre+": "+data.k.c);

                            cripto.valor_usdt = data.k.c;
                        };
                    });



                },
                async obtenerValorDolarQuetzal(){

                    console.log('obtenerValorDolarQuetzal')

                    let url = 'https://api.currencyapi.com/v3/latest?apikey=cur_live_XG4YHgqfoxdceFDmwrP5yDsvzhbMt34IOaKRtypL&?base_currency=USD&currencies=GTQ';

                    try {

                        let response = await axios.get(url);

                        let monedas = response.data.data;


                        console.log("Valor quetzal a dollar: ",monedas.GTQ.value)

                        this.valorQuetzalDolar = monedas.GTQ.value;


                    }catch (e) {

                        iziTe('Error al obtener valor del dolar');
                        notifyErrorApi(e)

                    }

                }

            },
            computed: {
                totalDolares(){

                    if(this.tipo == 'compra'){

                        return this.cantida_quetzales / this.valorQuetzalDolar;

                    }else {

                        if (this.criptomonedaSeleccionada ){
                            return this.criptomonedaSeleccionada.valor_usdt * this.cantida_criptomonedas;

                        }

                        return 0;

                    }


                },
                totalQuetzales(){

                    if(this.tipo == 'compra'){

                        return this.cantida_quetzales;

                    }else{

                        if (this.criptomonedaSeleccionada ){
                            return this.totalDolares * this.valorQuetzalDolar

                        }

                        return 0;
                    }

                },
                totalCriptomonedas(){
                    if(this.tipo == 'venta'){

                        return this.cantida_criptomonedas;

                    }else{

                        if (this.criptomonedaSeleccionada ){

                            return this.totalDolares / this.criptomonedaSeleccionada.valor_usdt;

                        }

                        return 0;
                    }
                },
                hayResultados(){
                    return this.totalDolares > 0;
                }
            },
        });
    </script>
@endpush
