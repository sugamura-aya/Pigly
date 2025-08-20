<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeightLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'weight',
        'calories',
        'exercise_time',
        'exercise_content',
        /*リレーションを設定するため、外部キーのuser_idにも許可リストをつける*/
        'user_id'
    ];

    /*Userモデル：WeightLogモデル＝親：子＝多：１*/
    /*リレーションを繋げる（子モデル側）*/
    public function user(){

        /*「$this(WeightLogモデル)は１つのUserモデルに属する」*/
        return $this->belongsTo(User::class);
    }

}
