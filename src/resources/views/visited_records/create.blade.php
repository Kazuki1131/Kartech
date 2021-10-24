@extends('layouts.app')

@section('content')
<div class="container py-5">
    <a class="btn-origin-return float-right" href="{{ route('customers.index') }}">戻る</a>
    <div class="card mx-auto w-100 bg-origin-card">
        <div class="card-header card-head-origin">来店記録の作成</div>
        <div class="card-body mx-auto w-75">
            <p><span class="text-danger">*</span>入力必須</p>
            <form action="{{ route('visited_records.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="{{ $customerId }}" name="customer_id">
                <div class="form-group mt-4">
                    <label for="visited_at" class="mb-0"><span class="text-danger">*</span>来店日</label>
                    <input type="date" class="form-control" id="visited_at" value="{{ old('visited_at') }}"
                    name="visited_at" style="width: 180px">
                </div>
                @error('visited_at')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="form-group mt-4">
                    <label for="menu" class="mb-0 h5">提供したサービス</label>
                    <div id="menus">
                        <select name="menus[0]" id="menu" class="form-control d-inline-block w-75 mt-1">
                            <option value="">選択してください。</option>
                            @foreach($menus as $menu)
                                <option value="{{ $menu->id }}">{{ $menu->name }}（{{ number_format($menu->price) }}円）</option>
                            @endforeach
                        </select>
                        <input type="button" value="－" class="deleteMenu plural-btn">
                    </div>
                    <input type="button" value="提供したサービスの追加" id="addMenu" class="addMenu plural-btn mt-1">
                </div>
                @error('menu')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="form-group mt-4">
                    <label for="image" class="mb-0 h5">写真</label>
                    <input type="file" class="form-control" id="image" name="images[]" accept="image/*" multiple>
                </div>
                @error('image.*')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="form-group mt-4">
                    <label for="memo" class="mb-0 h5">接客メモ</label>
                    <textarea class="form-control" id="memo" name="memo">{{ old('memo') }}</textarea>
                </div>
                @error('memo')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <button type="submit" class="btn-origin d-block mx-auto mt-4">作成する</button>
            </form>
        </div>
    </div>
</div>
@endsection