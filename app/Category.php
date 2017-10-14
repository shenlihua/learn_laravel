<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends BaseModel
{
    //
    protected $table = 'category';
    protected $primaryKey = 'id';

    //一对多关联
    public function cateDown()
    {
        return $this->hasMany($this,'pid');
    }
}
