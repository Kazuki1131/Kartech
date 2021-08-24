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
                    <input type="text" class="form-control" id="name" value="{{ old('name') }}"
                    name="name" maxlength="30" placeholder="山田花子">
                </div>
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="form-group mt-4">
                    <label for="name_kana" class="mb-0">
                        <h5><span class="text-danger">* </span>お客様名(カナ)</h5>
                    </label>
                    <input type="text" class="form-control" id="name_kana" value="{{ old('name_kana') }}"
                    name="name_kana" maxlength="30" placeholder="ヤマダハナコ">
                </div>
                @error('name_kana')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="form-group mt-4 mb-0">
                    <label class="control-label m-0"><h4>性別</h4></label>
                </div>
                <div class="form-check form-check-inline form-control-lg">
                    <input type="radio" class="form-check-input" value="1" id="woman"
                    {{ old('gender') === '1' ? 'checked' : '' }} name="gender">
                    <label for="woman" class="form-check-label">女性</label>
                </div>
                <div class="form-check form-check-inline form-control-lg">
                    <input type="radio" class="form-check-input" value="2" id="man"
                    {{ old('gender') === '2' ? 'checked' : '' }} name="gender">
                    <label for="man" class="form-check-label">男性</label>
                </div>
                @error('gender')
                    <div class="text-danger">{{ $message }}</dev>
                @enderror
                <div class="form-group mt-4">
                    <label for="birthday" class="mb-0"><h5>生年月日</h5></label>
                    <input type="date" class="form-control" id="birthday" value="{{ old('birthday') }}"
                    name="birthday" style="width: 180px">
                </div>
                @error('birthday')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="form-group mt-4">
                    <label for="tel" class="mb-0"><h5>電話番号</h5></label>
                    <input type="tel" class="form-control" id="tel" name="tel" value="{{ old('tel') }}">
                </div>
                @error('tel')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="form-group mt-4">
                    <label for="email" class="mb-0"><h5>メールアドレス</h5></label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                </div>
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="form-group mt-4">
                    <label for="memo" class="mb-0"><h5>メモ</h5></label>
                    <textarea class="form-control" id="memo" name="memo">{{ old('memo') }}</textarea>
                </div>
                @error('memo')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <button type="submit" class="btn btn-success btn-lg d-block mx-auto mt-4">登録する</button>
                <button type="button" class="btn btn-secondary btn-lg d-block mx-auto mt-3">
                    <a href="{{ route('customers.index') }}" class="mx-3">戻る</a>
                </button>
            </form>
        </div>
    </div>
</div>
@endsection