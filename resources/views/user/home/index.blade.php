@extends('user.layouts.index')
@section('title', 'IIDEXMEMO')
@section('content')
    <div aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">HOME</li>
        </ol>
    </div>

    <div class="card mt-4">
        <div class="card-header"><h2>IIDXMEMOとは？</h2></div>
        <div class="card-body">
            <p>beatmania IIDXのACに収録されている楽曲のメモを気軽に行えるサービスです。</p>
            <ul>
                <li>クリアできそうな曲</li>
                <li>スコアが伸びそうな曲</li>
                <li>好きな曲</li>
                <li>ライブ配信のリクエスト曲</li>
            </ul>
            <p>…などなど、様々な用途でメモをしたくなったときにご利用ください。</p>
            <div class="row mt-4">
                <div class="col-sm-6">
                    <p class="text-center"><a class="btn btn-primary m-2 w-200px" href="{{ route('user.preregister') }}">新規登録はこちら</a></p>
                </div>
                <div class="col-sm-6">
                    <p class="text-center"><a class="btn btn-info m-2 w-200px" href="{{ route('user.login') }}">ログインはこちら</a></p>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header"><h2>機能紹介</h2></div>
        <div class="card-body">
            <div class="card-deck">
                <div class="card">
                    <div class="card-header bg-light h5"><h3>メモ一覧</h3></div>
                    <div class="card-body">
                        <a href="{{asset('/images/home/main2.png')}}" target="_blank" rel="noopener noreferrer">
                            <img src="{{asset('/images/home/thumb2.png')}}" class="img-fluid img-thumbnail" alt="メモ一覧参考画像">
                        </a>
                        <p class="card-text mt-4">登録した楽曲メモを登録順に一覧できます。</p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-light h5"><h3>メモ詳細</h3></div>
                    <div class="card-body">
                        <a href="{{asset('/images/home/main3.png')}}" target="_blank" rel="noopener noreferrer">
                            <img src="{{asset('/images/home/thumb3.png')}}" class="img-fluid img-thumbnail" alt="メモ詳細参考画像">
                        </a>
                        <p class="card-text mt-4">楽曲の情報や、自身の登録したメモを閲覧できます。</p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-light h5"><h3>楽曲検索</h3></div>
                    <div class="card-body">
                        <a href="{{asset('/images/home/main4.png')}}" target="_blank" rel="noopener noreferrer">
                            <img src="{{asset('/images/home/thumb4.png')}}" class="img-fluid img-thumbnail" alt="楽曲検索参考画像">
                        </a>
                        <p class="card-text mt-4">メモに登録する楽曲をバージョン、フリーワード、SP・DP難易度で検索できます。</p>
                    </div>
                </div>
            </div>
            <div class="card-deck mt-4">
                <div class="card">
                    <div class="card-header bg-light h5"><h4>検索例1</h4></div>
                    <div class="card-body">
                        <a href="{{asset('/images/home/main5.png')}}" target="_blank" rel="noopener noreferrer">
                            <img src="{{asset('/images/home/thumb5.png')}}" class="img-fluid img-thumbnail" alt="検索例1参考画像">
                        </a>
                        <p class="card-text mt-4">俗称でもある程度検索できます。</p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-light h5"><h4>検索例2</h4></div>
                    <div class="card-body">
                        <a href="{{asset('/images/home/main6.png')}}" target="_blank" rel="noopener noreferrer">
                            <img src="{{asset('/images/home/thumb6.png')}}" class="img-fluid img-thumbnail" alt="検索例2参考画像">
                        </a>
                        <p class="card-text mt-4">こんな俗称にも。</p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-light h5"><h4>検索例3</h4></div>
                    <div class="card-body">
                        <a href="{{asset('/images/home/main7.png')}}" target="_blank" rel="noopener noreferrer">
                            <img src="{{asset('/images/home/thumb7.png')}}" class="img-fluid img-thumbnail" alt="検索例3参考画像">
                        </a>
                        <p class="card-text mt-4">これは俗称なのか。</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header"><h2>利用規約</h2></div>
        <div class="card-body">
            <p><h3>１．サービスのご利用</h3></p>
            <p>当サイトをご利用いただくにあたり、ユーザーの皆様は、本利用規約のすべての記載内容についてご同意いただいたものとみなされます。<br>
                本利用規約は当サイトの判断で任意に変更されます。<br>
                将来引き続きご利用になる場合は、変更後の内容にご同意いただいたものとみなされます。<br>
                また、当サイトからユーザーの皆様に直接金銭を要求することはありません。
            </p>
            <p><h3>２．禁止行為</h3></p>
            <p>当サイトをユーザーの皆様が有益にご利用いただくため、以下の行為を禁止いたします。<br>
                以下の行為を確認した場合、状況を判断した上でアカウント削除等の措置をとらせていただきます。</p>
            <ul>
                <li>サーバーに負担をかける行為</li>
                <li>ネットワーク・システムを妨害する行為</li>
                <li>当サイトがスパムと判断する行為</li>
            </ul>
            <p><h3>３．免責事項</h3></p>
            <p>当サイトは、いつでも任意の理由でサービスを停止することができます。<br>
                当サイトのご利用、またはご利用できないことによって発生した損失・損害（直接的、間接的を問わず）について、一切責任を負いません。</p>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header"><h2>その他</h2></div>
        <div class="card-body">
            <p>不具合報告・お問い合わせはTwitterまでお願いします。</p>
            <p>管理人: しおはる (<a href="https://twitter.com/shioharu_" target="_blank" rel="noopener noreferrer">twitter</a>)</p>
            <p>IIDXMEMOソース: <a href="https://github.com/shioharugit/iidxmemo" target="_blank" rel="noopener noreferrer">GitHub</a></p>
        </div>
    </div>
@endsection
