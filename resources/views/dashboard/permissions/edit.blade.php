<!-- resources/views/dashboard/permissions/edit.blade.php -->
@extends('dashboard.layouts.main')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h1>Edit Permission</h1>
        <form action="{{ route('permissions.update', $permission) }}" method="POST">
            @csrf
            @method('PUT')
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="{{ $permission->name }}" required>
            <button type="submit">Update</button>
        </form>
    </div>
@endsection
