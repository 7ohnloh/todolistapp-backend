<?php

namespace App\Http\Controllers;

use App\Models\TodoList;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TodoListController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(TodoList::latest()->get());
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $todoList = TodoList::create($validated);

        return response()->json($todoList, 201);
    }

    public function show(TodoList $todoList): JsonResponse
    {
        return response()->json($todoList->load('todos'));
    }

    public function update(Request $request, TodoList $todoList): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['sometimes', 'required', 'string', 'max:255'],
        ]);

        $todoList->update($validated);

        return response()->json($todoList);
    }

    public function destroy(TodoList $todoList): JsonResponse
    {
        $todoList->delete();

        return response()->json([
            'message' => 'Todo list deleted successfully.',
        ]);
    }
}
