@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif
                <div class="card">
                    @if ($users->count())
                        <div class="card-header">{{ __('Add New Task') }}</div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.task.store') }}">
                                @csrf

                                <div class="form-group row">
                                    <label for="user"
                                        class="col-md-4 col-form-label text-md-right">{{ __('Assign To') }}</label>

                                    <div class="col-md-6">
                                        <select class="form-select" aria-label="Default select example" name="user_id">
                                            <option value="0">Select User</option>
                                            @foreach ($users as $user)
                                                <p>This is user </p>
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('user_id')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="task_description"
                                        class="col-md-4 col-form-label text-md-right">{{ __('Task Desctiption') }}</label>

                                    <div class="col-md-6">
                                        <textarea id="task_description" name="task_description" rows="2"
                                            cols="50">{{ old('task_description') }}</textarea>
                                        @error('task_description')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Save') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @else
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <p>No users to assign task</p>
                                    <div>
                                    </div>
                                </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
