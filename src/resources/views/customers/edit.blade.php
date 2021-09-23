@extends('layouts.app')

@section('content')
<div class="container pb-5">
    @if (session('flash_message'))
        <div class="alert bg-origin-body text-center">
            {{ session('flash_message') }}
        </div>
    @endif
    <a class="btn-origin-return" href="{{ route('customers.show', $customer) }}">顧客詳細画面</a>
    <div class="card mx-auto w-100 bg-origin-card">
        <div class="card-header card-head-origin">お客様情報更新</div>
        <div class="card-body mx-auto w-75">
            <form action="{{ route('customers.update', $customer) }}" method="POST" autocomplete="off">
                @method('PATCH')
                @csrf
                <input type="hidden" name="id" value="{{ $customer->id }}">
                <div class="form-group mt-4">
                    <label for="control_number" class="mb-0">顧客番号</label>
                    <input type="text" class="form-control" id="control_number" value="{{ old('control_number', $customer->control_number) }}"
                    name="control_number" maxlength="6" placeholder="例：123">
                </div>
                @error('control_number')
                    <div class="text-danger">{{ $message }}</div>
                @enderror                <div class="form-group mt-4">
                    <label for="name" class="mb-0">お客様名</label>
                    <input type="text" class="form-control" id="name" value="{{ old('name', $customer->name) }}"
                    name="name" maxlength="30" placeholder="例：山田花子">
                </div>
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="form-group mt-4">
                    <label for="name_kana" class="mb-0">お客様名(カナ)</label>
                    <input type="text" class="form-control" id="name_kana" value="{{ old('name_kana', $customer->name_kana) }}"
                    name="name_kana" maxlength="30" placeholder="例：ヤマダハナコ">
                </div>
                @error('name_kana')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="form-group mt-4 mb-0">
                    <label class="control-label m-0">性別</label>
                </div>
                <div class="form-check form-check-inline form-control-lg">
                    <input type="radio" class="form-check-input" value="1" id="woman"
                    {{ intval(old('gender', $customer->gender)) === 1 ? 'checked' : '' }} name="gender">
                    <label for="woman" class="form-check-label">女性</label>
                </div>
                <div class="form-check form-check-inline form-control-lg">
                    <input type="radio" class="form-check-input" value="2" id="man"
                    {{ intval(old('gender', $customer->gender)) === 2 ? 'checked' : '' }} name="gender">
                    <label for="man" class="form-check-label">男性</label>
                </div>
                @error('gender')
                    <div class="text-danger">{{ $message }}</dev>
                @enderror
                <div class="form-group mt-4">
                    <label for="birthday" class="mb-0">生年月日</label>
                    <input type="date" class="form-control" id="birthday" value="{{ old('birthday', $customer->birthday) }}"
                    name="birthday" style="width: 180px">
                </div>
                @error('birthday')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="form-group mt-4">
                    <label for="tel" class="mb-0">電話番号</label>
                    <input type="tel" class="form-control" id="tel" name="tel" value="{{ old('tel', $customer->tel) }}">
                </div>
                @error('tel')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="form-group mt-4">
                    <label for="email" class="mb-0">メールアドレス</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $customer->email) }}" placeholder="例：example@email.com">
                </div>
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="form-group mt-4">
                    <label for="memo" class="mb-0">お客様メモ</label>
                    <textarea class="form-control" id="memo" name="memo" cols="30" rows="3" maxlength="1000">{{ old('memo', $customer->memo) }}</textarea>
                </div>
                @error('memo')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <button type="submit" class="btn-origin d-block mx-auto mt-4">更新</button>
            </form>
        </div>
    </div>
</div>
@endsection