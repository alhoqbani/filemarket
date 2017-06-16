<?php

namespace App\Providers;

use App\File;
use App\Policies\FilePolicy;
use App\Policies\UploadPolicy;
use App\Upload;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        File::class   => FilePolicy::class,
        Upload::class => UploadPolicy::class,
    ];
    
    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        
        //
    }
}
