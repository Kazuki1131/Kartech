@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mx-auto w-100">
        <div class="card-header">
            <h3 class="text-center"><i class="fas fa-pen mr-2"></i>来店記録の作成</h3>
        </div>
        <div class="card-body mx-auto w-75">
            <form action="{{ route('visited_records.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="{{ $customerId }}" name="customer_id">
                <div class="form-group mt-4">
                    <label for="visited_at" class="mb-0">来店日</label>
                    <input type="date" class="form-control" id="visited_at" value="{{ old('visited_at') }}"
                    name="visited_at" style="width: 180px">
                </div>
                @error('visited_at')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <!-- 要修正：複数のメニューを選べるようにする -->
                <div class="form-group mt-4">
                    <label for="menu" class="mb-0 h5">提供メニュー</label>
                    <select name="menu" id="menu" class="form-control">
                        <option value=""></option>
                    </select>
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
                <button type="submit" class="btn btn-success btn-lg d-block mx-auto mt-4">作成する</button>
                <a href="{{ route('customers.index') }}">
                    <button type="button" class="btn btn-secondary btn-lg d-block mx-auto mt-3">　戻る　</button>
                </a>
            </form>
        </div>
    </div>
</div>
@endsection