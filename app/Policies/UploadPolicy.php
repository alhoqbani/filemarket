<?php

namespace App\Policies;

use App\User;
use App\Upload;
use Illuminate\Auth\Access\HandlesAuthorization;

class UploadPolicy
{
    
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view the upload.
     *
     * @param  \App\User   $user
     * @param  \App\Upload $upload
     *
     * @return mixed
     */
    public function touch(User $user, Upload $upload)
    {
        return $user->id == $upload->user_id;
    }
    
    /**
     * Determine whether the user can create uploads.
     *
     * @param  \App\User $user
     *
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }
    
    /**
     * Determine whether the user can update the upload.
     *
     * @param  \App\User   $user
     * @param  \App\Upload $upload
     *
     * @return mixed
     */
    public function update(User $user, Upload $upload)
    {
        //
    }
    
    /**
     * Determine whether the user can delete the upload.
     *
     * @param  \App\User   $user
     * @param  \App\Upload $upload
     *
     * @return mixed
     */
    public function delete(User $user, Upload $upload)
    {
        //
    }
}
