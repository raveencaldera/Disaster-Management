<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'place', 'type', 'description', 'reporter_id', 'verifier_id', 'status', 'lat', 'long', 'level'
    ];

    public function reporter() {
        return $this->belongsTo('App\User');
    }

}
