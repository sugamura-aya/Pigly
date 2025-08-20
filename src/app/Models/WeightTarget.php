<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeightTarget extends Model
{
    use HasFactory;

    protected $table = 'weight_target'; 

    protected $fillable = [
        'target_weight',
        /*リレーションを設定するため、外部キーのuser_idにも許可リストをつける*/
        'user_id'
    ];

    /*Userモデル：WeighTargetモデル＝親：子＝１対１*/
    /*リレーションを繋げる（子モデル側）*/
    public function user(){

        /*「$this(WeighTargetモデル)は1つのUserモデルに属する」*/
        return $this->belongsTo(User::class);
    }   

}
