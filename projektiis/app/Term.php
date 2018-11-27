<?php

namespace System;
use DateTime;
use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    public function evaluations() {
        return $this->hasMany(System\Evaluation);
    }

    public function exams() {
        return $this->belongsTo(Exam::class);
    }

    public function questions() {
        return $this->hasMany(System\Question);
    }

    public function users() {
        return $this->belongsToMany(User::class);
    }

   public function registration() {
    $now = date("Y-m-d h:i:s");
    $date = $this->open;

    if ($now > $this->open && $now > $this->close){
        return "ended ".$this->close;
    } else if ($now > $this->open && $now < $this->close) {
        return "ends ".$this->close;
    } else if ($now < $this->open){
        return "starts ".$this->open;
    }
   }
}
