<?php

namespace Database\Seeders;

use App\Models\TodoList;
use Illuminate\Database\Seeder;

class DemoTodoSeeder extends Seeder
{
    public function run(): void
    {
        $demoLists = [
            'Internship' => [
                'prepare interview notes',
                'submit internship documents',
            ],
            'Exchange' => [
                'buy souvenir for mum',
                'call home to check in with grandma',
            ],
            'School' => [
                'revise lecture notes',
                'complete assignment',
            ],
        ];

        TodoList::whereIn('name', array_keys($demoLists))->delete();

        foreach ($demoLists as $listName => $todos) {
            $todoList = TodoList::create([
                'name' => $listName,
            ]);

            foreach ($todos as $description) {
                $todoList->todos()->create([
                    'description' => $description,
                    'is_done' => false,
                ]);
            }
        }
    }
}
