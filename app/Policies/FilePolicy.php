<?php

namespace App\Policies;

use App\User;
use App\File;
use Illuminate\Auth\Access\HandlesAuthorization;

class FilePolicy
{
    
    use HandlesAuthorization;
    
    public function touch(User $user, File $file)
    {
        return $user->id == $file->user_id;
    }
    
    
    /**
     * Determine whether the user can view the file.
     *
     * @param  \App\User $user
     * @param  \App\File $file
     *
     * @return mixed
     */
    public function view(User $user, File $file)
    {
        //
    }
    
    /**
     * Determine whether the user can create files.
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
     * Determine whether the user can update the file.
     *
     * @param  \App\User $user
     * @param  \App\File $file
     *
     * @return mixed
     */
    public function update(User $user, File $file)
    {
        //
    }
    
    /**
     * Determine whether the user can delete the file.
     *
     * @param  \App\User $user
     * @param  \App\File $file
     *
     * @return mixed
     */
    public function delete(User $user, File $file)
    {
        //
    }
}
