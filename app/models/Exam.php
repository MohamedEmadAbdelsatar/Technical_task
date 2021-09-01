<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $table = 'exams';
    protected $fillable = ['name'];

    public function questions(){
        return $this->belongsToMany(Question::class);
    }
}
