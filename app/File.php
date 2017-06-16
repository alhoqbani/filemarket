<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{
    
    use SoftDeletes;
    protected $guarded = [];
    
    public function getRouteKeyName()
    {
        return 'identifier';
    }
    
    
    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
