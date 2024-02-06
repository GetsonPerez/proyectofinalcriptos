<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
 use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\UserBilletera
 *
 * @property int $id
 * @property int $user_id
 * @property int $criptomoneda_id
 * @property float $saldo
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\CriptoMoneda $moneda
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserBilletera delUsuario($user_id = null)
 * @method static \Database\Factories\UserBilleteraFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|UserBilletera newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserBilletera newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserBilletera onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|UserBilletera query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserBilletera whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserBilletera whereCriptomonedaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserBilletera whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserBilletera whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserBilletera whereSaldo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserBilletera whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserBilletera whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserBilletera withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|UserBilletera withoutTrashed()
 * @mixin \Eloquent
 */
class UserBilletera extends Model
{

    use SoftDeletes;
    use HasFactory;

    public $table = 'user_billetera';

    public $fillable = [
        'user_id',
        'criptomoneda_id',
        'saldo'
    ];

    protected $casts = [
        'saldo' => 'float'
    ];

    public static $rules = [
        'user_id' => 'required',
        'criptomoneda_id' => 'required',
        'saldo' => 'required|numeric',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public static $messages = [

    ];

    public function moneda(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\CriptoMoneda::class, 'criptomoneda_id');
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public function scopeDelUsuario($query, $user_id = null)
    {
        $user_id = $user_id ?? auth()->id();

        return $query->where('user_id', $user_id);
    }
}
