<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
 use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\CriptomonedaTransaccion
 *
 * @property int $id
 * @property int $criptomoneda_id
 * @property int $user_id
 * @property string $tipo
 * @property string $cantidad
 * @property string $precio_usd
 * @property string $precio_quetzal
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\CriptoMoneda $criptomoneda
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\CriptomonedaTransaccionFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|CriptomonedaTransaccion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CriptomonedaTransaccion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CriptomonedaTransaccion onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CriptomonedaTransaccion query()
 * @method static \Illuminate\Database\Eloquent\Builder|CriptomonedaTransaccion whereCantidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CriptomonedaTransaccion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CriptomonedaTransaccion whereCriptomonedaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CriptomonedaTransaccion whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CriptomonedaTransaccion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CriptomonedaTransaccion wherePrecioQuetzal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CriptomonedaTransaccion wherePrecioUsd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CriptomonedaTransaccion whereTipo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CriptomonedaTransaccion whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CriptomonedaTransaccion whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CriptomonedaTransaccion withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CriptomonedaTransaccion withoutTrashed()
 * @mixin \Eloquent
 */
class CriptomonedaTransaccion extends Model
{

    use SoftDeletes;
    use HasFactory;

    const TIPO_COMPRA = 'compra';
    const TIPO_VENTA = 'venta';

    public $table = 'criptomoneda_transacciones';

    public $fillable = [
        'criptomoneda_id',
        'user_id',
        'tipo',
        'cantidad',
        'precio_usd',
        'precio_quetzal'
    ];

    protected $casts = [
        'tipo' => 'string',
        'cantidad' => 'decimal:2',
        'precio_usd' => 'decimal:2',
        'precio_quetzal' => 'decimal:2'
    ];

    public static $rules = [
        'criptomoneda_id' => 'required',
        'user_id' => 'nullable',
//        'tipo' => 'required|string',
//        'cantidad' => 'required|numeric',
//        'precio_usd' => 'required|numeric',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public static $messages = [
        'criptomoneda_id.required' => 'La criptomoneda es requerida',
        'user_id.required' => 'El usuario es requerido',
        'tipo.required' => 'El tipo es requerido',
        'cantidad.required' => 'La cantidad es requerida',
        'precio_usd.required' => 'El precio_usd es requerido',

    ];

    public function criptomoneda(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\CriptoMoneda::class, 'criptomoneda_id');
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}
