@extends('layouts.app')
@section('content')
<div class="container pb-5">
    @if (session('flash_message'))
        <div class="alert bg-origin-body text-center">
            {{ session('flash_message') }}
        </div>
    @endif
    <div class="text-center">
        <p class="inner-left">
            お店で提供しているメニューを登録してください。<br>
            メニューを登録すると、来店記録ページでお客様に提供したメニューを一緒に記録できるようになります。<br>
        </p>
    </div>
    <a class="btn-origin-return float-right" href="{{ route('customers.index') }}">顧客一覧画面</a>
    <div class="card mx-auto w-100 bg-origin-card">
        <div class="card-header card-head-origin">メニュー新規登録</div>
        <div class="card-body mx-auto w-75">
            <form action="{{ route('menus.store') }}" method="POST" autocomplete="off">
                @csrf
                <div class="form-group mt-4">
                    <label for="name" class="mb-0">メニュー名</label>
                    <input class="form-control" id="name" name="name" placeholder="例：サービスA" value="{{ old('name') }}">
                </div>
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="form-group mt-4">
                    <label for="price" class="mb-0 d-block">メニュー料金(税込)</label>
                    <input class="form-control d-inline-block" id="price" name="price" placeholder="例：11000" value="{{ old('price') }}" style="width: 170px;">
                    <span style="font-size: 20px;">円</span>
                </div>
                @error('price')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="form-group">
                    <label for="description" class="mb-0">メニュー内容</label>
                    <textarea name="description" class="form-control" cols="30" rows="3"
                    id="description" maxlength="1000" placeholder="メニューの概要を入力してください。"></textarea>
                </div>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <button type="submit" class="btn-origin d-block mx-auto mt-4">登録する</button>
            </form>
        </div>
    </div>
</div>
@endsection