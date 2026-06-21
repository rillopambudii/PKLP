@extends('layouts.admin')

@section('title', 'Tambah User')

@section('content_header')
    <h1>Tambah User</h1>
@stop

@section('content')

<form action="/admin/users" method="POST">
    @csrf

    <div class="form-group mb-3">
        <label>Nama</label>
        <input type="text" name="name" class="form-control">
    </div>

    <div class="form-group mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control">
    </div>

    <div class="form-group mb-3">
        <label>Password</label>
        <input type="password" name="password" class="form-control">
    </div>

    <div class="form-group mb-3">
        <label>Role</label>
        <select name="role" class="form-control">
            <option value="Super Admin">Super Admin</option>
            <option value="Admin QHSE">Admin QHSE</option>
            <option value="Admin Operation">Admin Operation</option>
        </select>
    </div>

    <button class="btn btn-success">
        Simpan
    </button>
</form>

@stop