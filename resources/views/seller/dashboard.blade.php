@extends('layouts.app')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold">Dashboard Seller</h1>
    <p>Selamat datang, {{ auth()->user()->shop_name }}!</p>
</div>
@endsection
