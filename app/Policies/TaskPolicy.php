<?php

namespace App\Policies;

use App\Enums\TaskStatus;
use App\Models\Task;
use App\Models\User;

class TaskPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Task $task): bool
    {
        return $this->isTaskBelongsToUser($user, $task);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Task $task): bool
    {
        return $this->isTaskBelongsToUser($user, $task);
    }

    /**
     * Can't remove already done task.
     */
    public function delete(User $user, Task $task): bool
    {
        return $this->isTaskBelongsToUser($user, $task) &&
            TaskStatus::DONE->value === $task->status;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Task $task): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Task $task): bool
    {
        return false;
    }

    private function isTaskBelongsToUser(User $user, Task $task): bool
    {
        return $task->user_id === $user->id;
    }
}
