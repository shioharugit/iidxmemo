@extends('admin.layouts.index')
@section('title', '楽曲登録 | 楽曲一覧')
@section('content')
    @include('admin.music.common.input', ['type' => 'create', 'title' => '楽曲登録'])
@endsection
