<?php

namespace System;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
	protected $fillable = [
        'points'
    ];

    public function evaluations() {
        return $this->belongsTo(Evaluation::class);
    }
}
