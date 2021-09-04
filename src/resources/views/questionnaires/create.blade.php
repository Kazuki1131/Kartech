@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mx-auto w-100 font-origin-head">
        <div class="card-header font-origin-title">
            <h3 class="text-center"><i class="fas fa-pen mr-2"></i>お客様アンケート新規作成</h3>
        </div>
        <div class="card-body mx-auto w-75">
            <form action="{{ route('questionnaires.store') }}" method="POST" autocomplete="off">
                @csrf
                <div class="form-group mt-4">
                    <label for="questionnaire" class="mb-0"><h5>アンケート内容</h5></label>
                    <input class="form-control" id="questionnaire" name="item"
                    placeholder="例：ご来店のきっかけ" value="{{ old('item') }}">
                </div>
                @error('item')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="form-group mt-4 mb-0">
                    <label class="control-label m-0"><h5>アンケートのタイプ</h5></label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="js-check form-check-input" id="typeDescription" type="radio" name="type"
                    value="0" onclick="formSwitch()" {{ old('type') === '0' ? 'checked' : '' }}>
                    <label for="typeDescription" class="form-check-label">記述式</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="js-check form-check-input" id="typeSingle" type="radio" name="type"
                    value="1" onclick="formSwitch()" {{ old('type') === '1' ? 'checked' : '' }}>
                    <label for="typeSingle" class="form-check-label">選択式(単一回答のみ)</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="js-check form-check-input" id="type_multiple" type="radio" name="type"
                    value="2" onclick="formSwitch()" {{ old('type') === '2' ? 'checked' : '' }}>
                    <label for="type_multiple" class="form-check-label">選択式(複数回答可)</label>
                </div>
                @error('type')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <div id="singleAnswer" class="mt-4">
                    <div>選択肢を登録してください。</div>
                    <div id="inputSingleAnswer" class="answerStyle">
                        <input type="text" class="q_option" name="singleAnswers[0]"
                        placeholder="選択肢(単一回答式)" value="{{ old('singleAnswers.0') }}">
                        <input type="button" value="－" class="deleteSingleAnswer pluralBtn">
                    </div>
                    <input type="button" value="＋" id="addSingle" class="addSingleAnswer pluralBtn">
                </div>
                <div id="multipleAnswers" class="mt-4">
                    <div>選択肢を登録してください。</div>
                    <div id="inputMultipleAnswer" class="answerStyle">
                        <input type="text" class="q_option" name="multipleAnswers[0]"
                        placeholder="選択肢(複数回答式)" value="{{ old('multipleAnswers.0') }}">
                        <input type="button" value="－" class="deleteMultipleAnswer pluralBtn">
                    </div>
                    <input type="button" value="＋" id="addMultiple" class="addMultipleAnswer pluralBtn">
                </div>
                @error('singleAnswers.*')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                @error('multipleAnswers.*')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <button type="submit" class="btn btn-origin btn-lg d-block mx-auto mt-4">登録する</button>
                <button type="button" class="btn bg-origin-btn btn-lg d-block mx-auto mt-3">
                    <a href="{{ route('customers.index') }}" class="mx-3">戻る</a>
                </button>
            </form>
        </div>
    </div>
</div>
@endsection