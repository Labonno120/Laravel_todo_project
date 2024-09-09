<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Todo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="mb-0">Edit Todo</h1>
                    <hr />

                    @if (session()->has('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('admin.todo.update', $key) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">To Do</label>
                                <input type="text" name="todo" class="form-control" placeholder="To Do" value="{{ old('todo', $todo['todo']) }}">
                                @error('todo')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">Due Date</label>
                                <input type="text" name="due_date" class="form-control" placeholder="Due Date" value="{{ old('due_date', $todo['due_date']) }}">
                                @error('due_date')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-control">
                                    <option value="Incomplete" {{ old('status', $todo['status']) == 'Incomplete' ? 'selected' : '' }}>Incomplete</option>
                                    <option value="In Progress" {{ old('status', $todo['status']) == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                    <option value="Complete" {{ old('status', $todo['status']) == 'Complete' ? 'selected' : '' }}>Complete</option>
                                </select>
                                @error('status')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="d-grid">
                                <button class="btn btn-warning">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
