<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{
    
    use SoftDeletes;
    protected $guarded = [];
    
    const APPROVAL_PROPERTIES = [
        'title',
        'overview_short',
        'overview',
    ];
    
    
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
    
    public function uploads()
    {
        return $this->hasMany(Upload::class);
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
    
    public function needsApproval(array $approvalProperties)
    {
        if ($this->currentPropertiesDifferToGiven($approvalProperties)) {
            return true;
        }
        
        return false;
    }
    
    /**
     * @param array $approvalProperties
     *
     * @return bool
     */
    protected function currentPropertiesDifferToGiven(array $approvalProperties): bool
    {
        return array_only($this->toArray(), self::APPROVAL_PROPERTIES) != $approvalProperties;
    }
    
    public function createApproval(array $approvalProperties)
    {
        $this->approvals()->create($approvalProperties);
    }
    
}
