<!-- resources/views/dashboard/roles/edit.blade.php -->
@extends('dashboard.layouts.main')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h1>Edit Role</h1>
        <form action="{{ route('roles.update', $role) }}" method="POST">
            @csrf
            @method('PUT')
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="{{ $role->name }}" required>
            <button type="submit">Update</button>
        </form>
    </div>
@endsection
