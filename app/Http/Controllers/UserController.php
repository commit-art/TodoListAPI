<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserController extends Controller
{
    public function __construct(protected UserService $service)
    {
    }

    public function create(StoreUserRequest $request): UserResource
    {
        return UserResource::make(
            $this->service->create($request->validated())
        );
    }

    public function index(): AnonymousResourceCollection
    {
        $users = $this->service->getUsersWithTasks();

        return UserResource::collection($users);
    }
}
