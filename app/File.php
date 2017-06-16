<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
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
    
    
    protected static function boot()
    {
        parent::boot();
        
        self::creating(function ($file) {
            $file->identifier = uniqid(true);
        });
    }
    
    public function users()
    {
        return $this->belongsTo(User::class);
    }
    
    public function scopeFinished(Builder $builder)
    {
        return $builder->where('finished', true);
    }
    
    public function isFree()
    {
        return $this->price == 0;
    }
    
    public function approvals()
    {
        return $this->hasMany(FileApproval::class);
    }
    
}
