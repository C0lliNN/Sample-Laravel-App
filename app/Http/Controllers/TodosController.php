<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;

class TodosController extends Controller {
  public function index() {
    $todos = Todo::all();

    return view('todos.index')->with('todos', $todos);
  }

  public function show(Todo $todo) {
    return view('todos.show')->with('todo', $todo);
  }

  public function new() {
    return view('todos.new');
  }

  public function store() {
    $this->validateData();

    $data = request()->all();

    $todo = new Todo();
    $todo->name = $data['name'];
    $todo->description = $data['description'];
    $todo->completed = false;
    $todo->save();

    session()->flash('success', 'Todo Created Successfully');

    return redirect('todos');
  }

  public function edit(Todo $todo) {
    return view('todos.edit')->with('todo', $todo);
  }

  public function update() {
    $this->validateData();
    $data = request()->all();

    $todo = Todo::find($data['id']);
    $todo->name = $data['name'];
    $todo->description = $data['description'];
    $todo->save();

    session()->flash('success', 'Todo Updated Successfully');

    return redirect('todos');
  }

  public function destroy(Todo $todo) {

    $todo->delete();
    session()->flash('success', 'Todo Deleted Successfully');
    return redirect('todos');
  }

  public function complete(Todo $todo) {
    $todo->completed = true;
    $todo->save();

    session()->flash('success', 'Todo Completed Successfully');

    return redirect('todos');
  }

  private function validateData() {
    $this->validate(request(), [
      'name' => 'required|min:6|max:12',
      'description' => 'required',
    ]);
  }
}
