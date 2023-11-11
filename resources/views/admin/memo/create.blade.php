@extends('admin.layouts.index')
@section('title', 'メモ登録')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">メモ登録</li>
        </ol>
    </nav>

    <div class="card">
        <h5 class="card-header">メモ登録</h5>
        <div class="card-body">
            <div class="mb-3 collapse show">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <form action="" method="POST" id="input_form">
                    @csrf
                    <button type="button" class="btn btn-primary m-2 w-150px disabled_button" onclick="submitInputForm()">登録</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        function submitInputForm() {
            if (confirm('現時点で登録されているユーザー全員に収録楽曲数分のメモのレコードを作成します。よろしいですか？')) {
                $('.disabled_button').prop('disabled', true);
                $('#input_form').attr('action', '{{route('admin.memo.store')}}');
                $('#input_form').submit();
            } else {
                return false;
            }
        }
    </script>
@endsection
