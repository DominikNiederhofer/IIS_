<?php

namespace System;
use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Term extends Model
{
    protected $fillable = [
        'term', 'open', 'close'
    ];

    public function evaluations() {
        return $this->hasMany(Evaluation::class);
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

   public function isEnded(){
    $now = date("Y-m-d h:i:s");
    if ($this->close < $now)
        return true;
    return false;
   }

   public function isregistrated($user){
        if ($this->users()->find($user->id) == null) {
            return false;
        }
        return true;
   }
   public function hasValuate($user){
       $eval = $this->evaluations()->get();
        foreach ($eval as $key) {
           if ($key->users()->first()->id == $user->id)
                return true;
        }
        return false;
   }
}
