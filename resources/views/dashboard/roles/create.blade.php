<!-- resources/views/dashboard/roles/create.blade.php -->
@extends('dashboard.layouts.main')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h1>Create Role</h1>
        <form action="{{ route('roles.store') }}" method="POST">
            @csrf
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            <button type="submit">Create</button>
        </form>
    </div>
@endsection
