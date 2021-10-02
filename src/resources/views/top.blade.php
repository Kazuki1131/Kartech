@extends('layouts.app')

@section('content')
<div class="bg-img">
    <div class="absolute-top">
        <h1 class="jumbotron-title">美容サロンのための<br>顧客管理アプリ。</h1>
        <div class="jumbotron-text">管理と分析をもっとスマートに。</div>
        @guest
        <a class="btn-origin-lg" href="{{ route('register') }}">無料ユーザー登録</a>
        <a href="{{ route('login.guest') }}" class="btn-origin-lg bg-guest-login">ゲストログイン</a>
        @endguest
    </div>
</div>
<div class="container-fluid text-center">
    <section class="row align-items-center">
        <div class="col-md-6">
            <img src="https://static.kartech-app.com/images/Collab-pana.png" alt="" class="img-fluid">
        </div>
        <div class="col-md-6 order-md-first">
            <div class="top-title">店舗スタッフで顧客情報を共有。</div>
            <div class="top-text">顧客情報・接客履歴を一元管理。データを検索・分析して業務の改善を図れます。</div>
        </div>
    </section>
    <section class="row align-items-center">
        <div class="col-md-6">
            <img src="https://static.kartech-app.com/images/Checklist-rafiki.png" alt="" class="img-fluid">
        </div>
        <div class="col-md-6">
            <div class="top-title">アンケートをカスタマイズ。知りたい情報を収集。</div>
            <div class="top-text">来店動機、アレルギー情報など、お客様に入力して欲しい情報をアンケート作成ページから登録すれば、お客様情報入力ページに反映されます。</div>
        </div>
    </section>
    <section class="row align-items-center">
        <div class="col-md-6">
            <img src="https://static.kartech-app.com/images/Ok-bro.png" alt="" class="img-fluid">
        </div>
        <div class="col-md-6 order-md-first">
            <div class="top-title">サービスの利用はすべて無料</div>
            <div class="top-text">顧客の管理に毎月数千円の費用を支払っていますか？コストは削減すべきです。</div>
        </div>
    </section>
    <section class="row align-items-center">
        <div class="col-md-6">
            <img src="https://static.kartech-app.com/images/development-rafiki.png" alt="" class="img-fluid">
        </div>
        <div class="col-md-6">
            <div class="top-title">あなたの意見が開発者に届きます。</div>
            <div class="top-text">欲しい機能・改善して欲しい機能、あなたの声をお聞かせください。それは次のアップデートに組み込まれる可能性があります。</div>
        </div>
    </section>
</div>
@guest
<div class="jumbotron jumbotron-fluid bg-origin-body mt-4">
    <div class="container text-center">
        <h2 class="top-title">Kartechで顧客管理を始めてみましょう！</h2>
        <div class="top-text-center">メールアドレスとパスワードを登録するだけですぐに使うことができます。</div>
        <a class="btn-origin-top" href="{{ route('register') }}">無料ユーザー登録</a>
    </div>
</div>
@endguest
@endsection
