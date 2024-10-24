@extends('layouts.app')

@section('title', 'Detail User')

@section('content')
<div class="container">
    <h1>Detail User</h1>
    <div class="card">
        <div class="card-header">
            {{ $user->nama }}
        </div>
        <div class="card-body">
            <h5 class="card-title">Name: {{ $user->name }}</h5>
            <p class="card-text">Email: {{ $user->email }}</p>
            <a href="{{ route('users.index') }}" class="btn btn-primary">Kembali</a>
        </div>
    </div>
</div>
@endsection
