@extends('layouts.app')

@section('content')
<div class="container pb-5">
    @if (session('flash_message'))
        <div class="alert bg-origin-body text-center">
            {{ session('flash_message') }}
        </div>
    @endif
    <div class="mb-4 text-center">
        <p class="small inner-left">
            お客様が初めてのご来店の場合に、事前に同意を得ておきたい注意事項があれば、このページで同意書の作成ができます。<br>
            作成した同意書は顧客追加ページに反映され、お客様に情報を入力いただく際に同意を得ることができます。
        </p>
    </div>
    <div class="card mx-auto w-100 bg-origin-card">
        <div class="card-header card-head-origin">同意書の作成</div>
        <div class="card-body mx-auto w-75">
            <form action="{{ route('consent_forms.store') }}" method="POST" autocomplete="off">
                @csrf
                <div class="form-group mt-4">
                    <label for="content" class="mb-0">同意書記入欄</label>
                    <textarea class="form-control" id="content" name="content" cols="50" rows="20" maxlength="3000" placeholder="3000文字以内で入力してください。">{{ old('content') }}</textarea>
                </div>
                @error('content')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <button type="submit" class="btn-origin d-block mx-auto mt-4">登録する</button>
            </form>
        </div>
    </div>
</div>
@endsection