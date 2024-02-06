<!-- Criptomoneda Id Field -->
<div class="col-sm-12">
    {!! Form::label('criptomoneda_id', 'Criptomoneda:') !!}
    <p>{{ $criptomonedaTransaccion->criptomoneda->text }}</p>
</div>

<!-- User Id Field -->
<div class="col-sm-12">
    {!! Form::label('user_id', 'User:') !!}
    <p>{{ $criptomonedaTransaccion->user->name }}</p>
</div>

<!-- Tipo Field -->
<div class="col-sm-12">
    {!! Form::label('tipo', 'Tipo:') !!}
    <p class="{{$criptomonedaTransaccion->tipo =='venta' ? 'text-success' : 'text-warning'}} text-uppercase">{{ $criptomonedaTransaccion->tipo }}</p>
</div>

<!-- Cantidad Field -->
<div class="col-sm-12">
    {!! Form::label('cantidad', 'Cantidad:') !!}
    <p>{{ nf($criptomonedaTransaccion->cantidad) }}</p>
</div>

<!-- Precio Field -->
<div class="col-sm-12">
    {!! Form::label('precio_usd', 'Precio:') !!}
    <p>{{ nfp($criptomonedaTransaccion->precio_usd) }}</p>
</div>

