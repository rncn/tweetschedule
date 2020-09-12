@extends('layouts.app')
@section('content')

        <h2>ようこそ</h2>
        @if(! Auth::check())
        <p class="alert alert-danger">ログインしてください</p>
        @endif

        
@endsection