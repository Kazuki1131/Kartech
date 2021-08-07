@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mx-auto w-100">
        <div class="card-header">
            <h3 class="text-center"><i class="fas fa-pen mr-2"></i>顧客情報登録</h3>
        </div>
        <div class="card-body mx-auto w-75">
            <p class="text-center h6"><span class="text-danger">*</span>は入力必須項目です</p>
            <form action="{{ route('customers.store') }}" method="POST">
                @csrf
                <div class="form-group mt-4">
                    <label for="name" class="mb-0"><h5>お客様名</h5></label>
                    <input type="text" class="form-control" id="name"
                    name="name" maxlength="30" placeholder="山田花子" autofocus>
                </div>
                @error('name')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
                <div class="form-group mt-4">
                    <label for="name_kana" class="mb-0">
                        <h5><span class="text-danger">* </span>お客様名(カナ)</h5>
                    </label>
                    <input type="text" class="form-control" id="name_kana"
                    name="name_kana" maxlength="30" placeholder="ヤマダハナコ">
                </div>
                @error('name_kana')
                    <div class="text-danger">{{ $message }}</p>
                @enderror
                <div class="form-check mt-4">
                    <label for="gender" class="form-check-label mb-0">性別</label>
                    <input type="radio" value="1" id="gender" name="gender" class="form-check-input">
                </div>
                @error('gender')
                    <div class="text-danger">{{ $message }}</p>
                @enderror
                <div class="form-group mt-4">
                    <label for="birthday" class="mb-0">
                        <h5>生年月日</h5>
                    </label>
                    <input type="date" class="form-control" id="birthday" name="birthday" style="width: 180px">
                </div>
                @error('birthday')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
                <div class="form-group mt-4">
                    <label for="tel" class="mb-0">
                        <h5>電話番号</h5>
                    </label>
                    <input type="tel" class="form-control" id="tel" name="tel">
                </div>
                @error('tel')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
                <div class="form-group mt-4">
                    <label for="email" class="mb-0">
                        <h5>メールアドレス</h5>
                    </label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>
                @error('email')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
                <div class="form-group mt-4">
                    <label for="memo" class="mb-0">
                        <h5>メモ</h5>
                    </label>
                    <textarea class="form-control" id="memo" name="memo"></textarea>
                </div>
                @error('memo')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
                <button type="submit" class="btn btn-success btn-lg d-block mx-auto mt-4">投稿する</button>
                <a href="{{ route('customers.index') }}">
                    <button type="button" class="btn btn-secondary btn-lg d-block mx-auto mt-3">　戻る　</button>
                </a>
            </form>
        </div>
    </div>
</div>
@endsection