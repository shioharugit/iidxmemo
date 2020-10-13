@extends('admin.layouts.index')
@section('title', 'ユーザー更新 | ユーザー一覧')
@section('content')
    @include('admin.user.common.input', ['type' => 'edit', 'title' => 'ユーザー更新'])
@endsection
