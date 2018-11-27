<?php

namespace System;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
	protected $fillable = [
        'max_students', 'max_points'
    ];

    public function courses() {
        return $this->belongsTo(Course::class);
    }

    public function terms() {
        return $this->hasMany(Term::class);
    }
    public function finalterms(){
    	$ter = $this->terms()->get();
		$var = array();
    	foreach ($ter as $pom_term) {
    		if ($pom_term->type == 'final'){
    			$var.append($pom_term);
    		}
    	}
    	return $var;
    }
}
