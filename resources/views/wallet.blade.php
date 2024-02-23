@extends('master')

@section('content')
    <Wallet user={{ explode(' ', auth()->user()->name)[0] }} />
@endsection
