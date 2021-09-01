<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $table = 'answers';

    public function question(){
        return $this->belongsTo(Question::class);
    }
}
