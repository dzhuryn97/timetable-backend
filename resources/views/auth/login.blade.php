@extends('layout')


@section('content')
    <form action="{{ route('loginProcess') }}" method="post" >

        @csrf

        <input type="email" name="email" placeholder="email" value="user@example.com">
        <input type="password" name="password" placeholder="password" value="password">

        <input type="submit" value="login">
    </form>
@endsection
