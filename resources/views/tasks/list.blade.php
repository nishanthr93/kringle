@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif
                <div class="card">
                    @if ($tasks->count())
                        <div class="card-header">{{ __('Task List') }}
                            <a class="btn btn-primary" href="{{route('admin.task.create')}}" role="button">Add</a>
                        </div>
                        
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">User</th>
                                    <th scope="col">Task Desctiption</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tasks as $task)
                                    <tr>
                                        <th scope="row">{{ $task->id }}</th>
                                        <td>{{ $task->user->name }}</td>
                                        <td>{{ $task->task_description }}</td>
                                        <td>
                                            <a class="btn btn-primary" href="{{route('admin.task.edit',$task)}}" role="button">Edit</a>
                                            <form action="{{route('admin.task.destroy',$task)}}" method="POST">   
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {!! $tasks->links() !!}
                        </div>
                    @else
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <p>no Tasks</p>
                                    <div>
                                    </div>
                                </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
