@extends('admin.layouts.index')
@section('title', '楽曲更新 | 楽曲一覧')
@section('content')
    @include('admin.music.common.input', ['type' => 'edit', 'title' => '楽曲更新'])
@endsection
