@extends('layouts.app')

@section('content')
<div class="container pb-5">
    @if (session('flash_message'))
        <div class="alert bg-origin-body text-center">
            {{ session('flash_message') }}
        </div>
    @endif
    <div class="text-right">
        <a class="btn-origin-return" href="{{ route('customers.index') }}">戻る</a>
    </div>
    <div class="card mx-auto w-100 bg-origin-card">
        <div class="card-header card-head-origin">お客様アンケート新規作成</div>
        <div class="card-body mx-auto w-75">
            <form action="{{ route('surveys.store') }}" method="POST" autocomplete="off">
                @csrf
                <div class="form-group mt-4">
                    <label for="survey" class="control-label">アンケート内容</label>
                    <input class="form-control" id="survey" name="question"
                    placeholder="例：ご来店のきっかけ" value="{{ old('question') }}">
                </div>
                @error('question')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="form-group mt-4">
                    <label class="control-label">アンケートのタイプ</label>
                    <div class="form-check form-check">
                        <input class="js-check form-check-input" id="typeDescription" type="radio" name="type"
                        value="0" onclick="formSwitch()" {{ old('type') === '0' ? 'checked' : '' }}>
                        <label for="typeDescription" class="form-check-label">記述式</label>
                    </div>
                    <div class="form-check form-check">
                        <input class="js-check form-check-input" id="typeSingle" type="radio" name="type"
                        value="1" onclick="formSwitch()" {{ old('type') === '1' ? 'checked' : '' }}>
                        <label for="typeSingle" class="form-check-label">選択式(単一回答のみ)</label>
                    </div>
                    <div class="form-check form-check">
                        <input class="js-check form-check-input" id="type_multiple" type="radio" name="type"
                        value="2" onclick="formSwitch()" {{ old('type') === '2' ? 'checked' : '' }}>
                        <label for="type_multiple" class="form-check-label">選択式(複数回答可)</label>
                    </div>
                </div>
                @error('type')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <div id="singleAnswer" class="mt-4">
                    <label>選択肢を登録してください。</label>
                    <div id="inputSingleAnswer" class="answer-style">
                        <input type="text" class="q_option" name="singleAnswers[0]"
                        placeholder="選択肢(単一回答式)" value="{{ old('singleAnswers.0') }}">
                        <input type="button" value="－" class="deleteSingleAnswer plural-btn">
                    </div>
                    <input type="button" value="＋" id="addSingle" class="addSingleAnswer plural-btn">
                </div>
                <div id="multipleAnswers" class="mt-4">
                    <label>選択肢を登録してください。</label>
                    <div id="inputMultipleAnswer" class="answer-style">
                        <input type="text" class="q_option" name="multipleAnswers[0]"
                        placeholder="選択肢(複数回答式)" value="{{ old('multipleAnswers.0') }}">
                        <input type="button" value="－" class="deleteMultipleAnswer plural-btn">
                    </div>
                    <input type="button" value="＋" id="addMultiple" class="addMultipleAnswer plural-btn">
                </div>
                @error('singleAnswers.*')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                @error('multipleAnswers.*')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <button type="submit" class="btn-origin d-block mx-auto mt-4">登録する</button>
            </form>
        </div>
    </div>
</div>
@endsection