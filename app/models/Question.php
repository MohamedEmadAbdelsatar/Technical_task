<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';
    protected $fillable = ['body','level'];

    public function answers(){
        return $this->hasMany(Answer::class);
    }

    public function exams(){
        return $this->belongsToMany(Exam::class);
    }
}
