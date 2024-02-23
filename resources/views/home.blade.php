@extends('master')

@section('content')
    <h1>My Wallet</h1>
    Olá, {{ explode(' ', auth()->user()->name)[0] }}
@endsection
