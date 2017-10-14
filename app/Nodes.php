<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nodes extends Model
{
    //
    protected $table = 'node';
    protected $primaryKey = 'id';

    //一对多关联
    public function childNodes()
    {
        return $this->hasMany($this,'pid');
    }
}
