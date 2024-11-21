<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class UserService
{
    public function create(array $data): User
    {
        return User::create($data);
    }

    public function getUsersWithTasks(): LengthAwarePaginator
    {
        return User::with('tasks')->paginate();
    }
}
