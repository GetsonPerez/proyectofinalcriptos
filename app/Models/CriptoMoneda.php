<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
 use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\CriptoMoneda
 *
 * @property int $id
 * @property string $nombre
 * @property string|null $simbolo
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read mixed $imagen
 * @property-read mixed $text
 * @property-read mixed $valor_usdt
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CriptomonedaTransaccion> $transaciones
 * @property-read int|null $transaciones_count
 * @method static \Database\Factories\CriptoMonedaFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|CriptoMoneda newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CriptoMoneda newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CriptoMoneda onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CriptoMoneda query()
 * @method static \Illuminate\Database\Eloquent\Builder|CriptoMoneda whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CriptoMoneda whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CriptoMoneda whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CriptoMoneda whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CriptoMoneda whereSimbolo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CriptoMoneda whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CriptoMoneda withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CriptoMoneda withoutTrashed()
 * @mixin \Eloquent
 */
class CriptoMoneda extends Model
{

    use SoftDeletes;
    use HasFactory;

    public $table = 'criptomonedas';

    const BITCOIN =      1;
    const ETHEREUM =     2;
    const TETHER  =      3;
    const BINANCE_COIN = 4;

    protected $appends = ['text', 'valor_usdt', 'imagen', 'saldo_usuario'];

    public $fillable = [
        'nombre',
        'simbolo'
    ];

    protected $casts = [
        'nombre' => 'string',
        'simbolo' => 'string'
    ];

    public static $rules = [
        'nombre' => 'required|string|max:255',
        'simbolo' => 'nullable|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public static $messages = [

    ];

    public function transaciones(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\CriptomonedaTransaccion::class, 'criptomonda_id');
    }

    public function getTextAttribute()
    {
        return $this->nombre . ' (' . $this->simbolo . ')';

    }

    public function getValorUsdtAttribute()
    {

        if ($this->id == self::TETHER)
            return 1;

        return 0;
    }

    public function getImagenAttribute()
    {
        switch ($this->id) {
            case self::BITCOIN:
                return 'https://s2.coinmarketcap.com/static/img/coins/64x64/1.png';
                break;
            case self::ETHEREUM:
                return 'https://s2.coinmarketcap.com/static/img/coins/64x64/1027.png';
                break;
            case self::TETHER:
                return 'https://s2.coinmarketcap.com/static/img/coins/64x64/825.png';
                break;
            case self::BINANCE_COIN:
                return 'https://s2.coinmarketcap.com/static/img/coins/64x64/1839.png';
                break;
            default:
                return 'https://s2.coinmarketcap.com/static/img/coins/64x64/1.png';
                break;
        }

    }

    public function userBilletera()
    {
        return $this->hasOne(UserBilletera::class,'criptomoneda_id')->delUsuario();
    }

    public function getSaldoUsuarioAttribute()
    {
        return $this->userBilletera->saldo ?? 0;

    }
}
