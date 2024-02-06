
<form id="formFiltersDatatables">
    <div class="form-row">


        <!-- Campo -->
        <div class="form-group col-sm-4">

            <label for="campo_fecha">Campo Fecha:</label>

            <div class="input-group mb-3">
                <input type="text" class="form-control rangofecha" name="fechas" value="" >
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button">
                        <i class="fa fa-calendar"></i>
                    </button>
                </div>
            </div>
        </div>


        <!-- Campo -->
        <div class="form-group col-sm-4">
            <label for="tipos">Usuarios:</label>
            <multiselect v-model="usuario" :options="usuarios" label="name" placeholder="Seleccione uno..." >
            </multiselect>
            <input type="hidden" name="user_id" :value="usuario ? usuario.id : null">
        </div>

        <!-- Campo -->
        <div class="form-group col-sm-4">
            <label for="estado_id">Criptomoneda: </label>
            <multiselect v-model="criptomoneda" :options="criptomonedas" track-by="id" label="nombre"
                         :multiple="true"
                         placeholder="Selecciones uno">
            </multiselect>
            <input type="hidden" name="criptomoneda_id[]" :value="item.id" v-for="item in criptomoneda">
        </div>




        <div class="form-group col-sm-12" style="padding: 0px; margin: 0px"></div>

        <!-- Campo -->
        <div class="form-group col-sm-12 text-right">
            <button type="button" @click.prevent="limpiarFormulario()" class="btn  btn-default">
                <i class="fa fa-refresh"></i> Limpiar
            </button>
            &nbsp;
            &nbsp;
            <button type="button" @click.prevent="filtrar()" id="boton" class="btn btn-info ">
                <i class="fa fa-search"></i> Filtrar
            </button>

            &nbsp;
            &nbsp;
        </div>
    </div>
</form>



@include('layouts.plugins.bootstrap_daterangepicker')

@push('scripts')
    <script>

        new Vue({
            el: '#formFiltersDatatables',
            name: 'formFilter',
            mounted() {
            },
            created() {
            },
            data: {



                criptomonedas: @json(\App\Models\CriptoMoneda::all() ?? []),
                criptomoneda: null,

                usuarios: @json(\App\Models\User::all() ?? []),
                usuario: null,





            },
            methods: {
                filtrar(){

                    table = window.LaravelDataTables["dataTableBuilder"];
                    table.draw();

                },
                limpiarCampos(){
                    this.criptomoneda = null;
                    this.usuario = null;

                    $('#formFiltersDatatables').find('input,select').each(function (index, element) {
                        $(element).val('');
                    });

                },
                async limpiarFormulario(){

                    await this.limpiarCampos();
                    this.filtrar();
                }
            },
            watch:{

            }
        });


    </script>
@endpush

