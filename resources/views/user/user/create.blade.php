@extends('user.layouts.index')
@section('title', 'ユーザー新規登録')
@section('content')
    @include('user.user.common.input_form', ['type' => 'create', 'title' => 'ユーザー新規登録'])
@endsection
