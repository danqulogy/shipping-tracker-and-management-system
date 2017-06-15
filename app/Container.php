<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Container extends Model
{
    protected $appends = ["number_of_goods", "state"];

    public function getStateAttribute(){
        if($this->attributes['transaction_engagement'] == 0){
            return true;
        }

        return false;
    }
    public function getNumberOfGoodsAttribute(){
        $count =  count(Good::where('container_id', $this->attributes['id'])->get());
        return $count;
    }
}
