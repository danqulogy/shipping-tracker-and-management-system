<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipient extends Model
{
    protected $appends = [
        'full_name'
    ];

    public function getFullNameAttribute(){
        return $this->attributes['first_name'].' '. $this->attributes['other_names'];
    }
}
