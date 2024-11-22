<?php

namespace App\Services;

use App\Http\Requests\Task\UpdateTaskRequest;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class TaskService
{
    public function update(UpdateTaskRequest $request, Task $task): void
    {
        $data = $request->validated();

        if ($request->status) {
            $data['completed_at'] = Carbon::now();
        }

        $task->update($data);
    }

    public function get(Request $request): Collection
    {
        $search = $request->search;

        return Task::query()->with('subtasks')
            ->where('user_id', [$request->user()->id])
            ->where('parent_id', null)
            ->when($request->search, function ($query) use ($search) {
                $query->whereFullText(['title', 'description'], $search);
            })->when($request->priority, function ($query) use ($request) {
                $query->where('priority', [$request->priority]);
            })->when($request->status, function ($query) use ($request) {
                $query->where('status', [$request->status]);
            })->when($request->created_at, function ($query) use ($request) {
                $query->orderby('created_at', $request->created_at);
            })->when($request->completed_at, function ($query) use ($request) {
                $query->orderby('completed_at', $request->completed_at);
            })->get();
    }
}
