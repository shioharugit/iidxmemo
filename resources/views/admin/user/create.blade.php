@extends('admin.layouts.index')
@section('title', 'ユーザー登録 | ユーザー一覧')
@section('content')
    @include('admin.user.common.input', ['type' => 'create', 'title' => 'ユーザー登録'])
@endsection
