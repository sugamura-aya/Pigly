<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];


    /*Userモデル：WeightLogモデル＝親：子＝１：多*/
    /*リレーションを繋げる（親モデル側）*/
    public function weightLogs(){

        /*「$this(Userモデル)はWeightLogモデルを複数有する」*/
        return $this->hasMany(WeightLog::class);
    }

    /*Userモデル：WeighTargetモデル＝親：子＝１対１*/
    /*リレーションを繋げる（親モデル側）*/
    public function weightTarget(){

        /*「$this(Userモデル)はWeightTargetモデルを１つ有する」*/
        return $this->hasOne(WeightTarget::class);
    }


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
