<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\GetTasksRequest;
use App\Http\Requests\Task\StoreTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(
        GetTasksRequest $request,
        TaskService $service
    ): AnonymousResourceCollection
    {
        $data = $service->get($request);

        return TaskResource::collection($data)
            ->additional(['count' => $data->count()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request): JsonResponse
    {
        $task = $request->user()->tasks()->create(
            $request->validated()
        );

        return response()->json(
            [
                'id' => $task->id,
                'parent_id' => $task->parent_id,
                'message' => 'Task has been created'
            ],
            Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @throws AuthorizationException
     */
    public function show(Task $task): TaskResource
    {
        $this->authorize('view', $task);

        return TaskResource::make($task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @throws AuthorizationException
     */
    public function update(
        UpdateTaskRequest $request,
        TaskService $service,
        Task $task
    ): JsonResponse
    {
        $this->authorize('update', $task);

        $service->update($request, $task);

        return response()->json(
            ['message' => 'Task has been updated'],
            Response::HTTP_OK
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @throws AuthorizationException
     */
    public function destroy(Task $task): JsonResponse
    {
        $this->authorize('delete', $task);

        $task->delete();

        return response()->json(
            ['message' => 'Task has been deleted'],
            Response::HTTP_NO_CONTENT
        );
    }
}
