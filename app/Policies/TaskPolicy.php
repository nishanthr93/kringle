<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use App\Models\Roles;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->role_id == Roles::IS_ADMIN || $user->role_id == Roles::IS_MANAGER;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Task $task)
    {
        return $user->role_id == Roles::IS_ADMIN || $user->role_id == Roles::IS_MANAGER;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Task $task)
    {
        return $user->role_id == Roles::IS_ADMIN;
    }

    /**
     * Determine whether the user can access action tab
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function adminsOnly(User $user)
    {
        return $user->role_id == Roles::IS_ADMIN || $user->role_id == Roles::IS_MANAGER;
    }

    public function normalUsers(User $user)
    {
        return $user->role_id == Roles::IS_USER;
    }
}
