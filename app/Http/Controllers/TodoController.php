<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function AllTodo(Request $request)
    {
        return User::with('todos')->where('email','=',$request->header('id'))->first();
    }

    public function StoreTodo(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'required|string|max:500',
        ]);

        $todo = new Todo([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->header('id'),
        ]);

        $todo->save();
        return response()->json($todo, Response::HTTP_CREATED);
    }

    public function SingleTodo(Request $request, $id)
    {

        return Todo::where('todos.id', '=', $id)
            ->where('user_id', '=', $request->header('id'))
            ->first();
    }

    public function UpdateTodo(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'required|string|max:500',
        ]);

        $todo = Todo::where('id', $id)
            ->where('user_id', $request->header('id'))
            ->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        if($todo==null) {
            return response()->json("Not updated");
        }

        return response()->json($todo);
    }

    public function DeleteTodo(Request $request, $id)
    {
        $todo = Todo::where('id', '=', $id)
            ->where('user_id', '=', $request->header('id'))
            ->first();


        if ($todo==null) {
            return response()->json(['message' => 'Todo item not found.']);
        }

        $todo->delete();

        return response()->json(['message' => 'Todo item deleted successfully.']);
    }
}
