<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Todo::latest()->get());
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'description' => ['required', 'string', 'max:255'],
            'todo_list_id' => ['required', 'exists:todo_lists,id'],
            'is_done' => ['sometimes', 'boolean'],
        ]);

        $todo = Todo::create($validated);

        return response()->json($todo, 201);
    }

    public function show(Todo $todo): JsonResponse
    {
        return response()->json($todo);
    }

    public function update(Request $request, Todo $todo): JsonResponse
    {
        $validated = $request->validate([
            'description' => ['sometimes', 'required', 'string', 'max:255'],
            'todo_list_id' => ['sometimes', 'required', 'exists:todo_lists,id'],
            'is_done' => ['sometimes', 'boolean'],
        ]);

        $todo->update($validated);

        return response()->json($todo);
    }

    public function destroy(Todo $todo): JsonResponse
    {
        $todo->delete();

        return response()->json([
            'message' => 'Todo deleted successfully.',
        ]);
    }
}
