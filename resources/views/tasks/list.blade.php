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
                        <div class="card-header">{{ __('Task List') }}</div>
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
                                            <a class="btn btn-primary" href="#" role="button">Edit</a>
                                            <a class="btn btn-danger" href="#" role="button">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
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
