@extends('layouts.app')

@section('content')
<div class="container py-5">
    <a class="btn-origin-return float-right" href="{{ route('customers.show', $visitedRecord->customer_id) }}">戻る</a>
    <form name="deleteform" method="POST" action="{{ route('visited_records.destroy', $visitedRecord) }}">
        @method('delete')
        @csrf
        <button type="submit" class="btn rounded-pill" onClick="return Check()">
            <i class="far fa-trash-alt mr-1"></i>この来店記録を削除
        </button>
    </form>
    <div class="card mx-auto w-100 bg-origin-card">
        <div class="card-header card-head-origin">来店記録の編集</div>
        <div class="card-body mx-auto w-75">
            <p><span class="text-danger">*</span>入力必須</p>
            <form action="{{ route('visited_records.update', $visitedRecord) }}" method="POST">
                @csrf
                <div class="form-group mt-4">
                    <label for="visited_at" class="mb-0"><span class="text-danger">*</span>来店日</label>
                    <input type="date" class="form-control" id="visited_at" value="{{ old('visited_at', $visitedRecord->visited_at) }}"
                    name="visited_at" style="width: 180px">
                </div>
                @error('visited_at')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="form-group mt-4">
                    <label for="memo" class="mb-0 h5">接客メモ</label>
                    <textarea class="form-control" id="memo" name="memo">{{ old('memo', $visitedRecord->memo) }}</textarea>
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