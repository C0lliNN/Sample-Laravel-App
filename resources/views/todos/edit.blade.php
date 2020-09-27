@extends('layouts.app')
<!--  -->
@section('title') Create new Todo @endSection
<!--  -->
@section('content')

<h1 class="text-center my-5">Edit Todo</h1>

<div class="row justify-content-center">
  <div class="col-md-8">
    <div class="card card-default">
      <div class="card-header">Edit Todo</div>
      <div class="card-body">
        @if($errors->any())
        <div class="alert alert-danger">
          <ul class="list-group">
            @foreach($errors->all() as $error)
            <li class="list-group-item">
              {{ $error }}
            </li>
            @endForeach
          </ul>
        </div>
        @endIf

        <form action="/update-todo" method="POST">
          @csrf
          <input type="hidden" value="{{ $todo->id }}" name="id" />
          <div class="form-group">
            <input
              type="text"
              class="form-control"
              name="name"
              placeholder="Name..."
              value="{{ $todo->name }}"
            />
          </div>
          <div class="form-group">
            <textarea
              name="description"
              id=""
              cols="30"
              rows="5"
              class="form-control"
              placeholder="Description..."
              >{{ $todo->description }}</textarea
            >
          </div>
          <div class="form-group text-center">
            <button type="submit" class="btn btn-success">
              Update Todo
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endSection
