@extends('user.layouts.index')
@section('title', 'ユーザー更新 | IIDXMEMO')
@section('content')
    @include('user.user.common.input_form', ['type' => 'edit', 'title' => 'ユーザー更新'])
@endsection
