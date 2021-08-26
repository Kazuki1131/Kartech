@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mx-auto w-100">
        <div class="card-header">
            <h3 class="text-center"><i class="fas fa-pen mr-2"></i>お客様アンケート新規作成</h3>
        </div>
        <div class="card-body mx-auto w-75">
            <form action="{{ route('questionnaires.store') }}" method="POST" autocomplete="off">
                @csrf
                <div class="form-group mt-4">
                    <label for="questionnaire" class="mb-0"><h5>アンケート内容</h5></label>
                    <input class="form-control" id="questionnaire" name="questionnaire"
                    placeholder="例：ご来店のきっかけ" value="{{ old('questionnaire') }}">
                </div>
                @error('questionnaire')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="form-group mt-4 mb-0">
                    <label class="control-label m-0"><h5>アンケートのタイプ</h5></label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="js-check form-check-input" id="typeDescription" type="radio" name="questionType"
                    value="1" onclick="formSwitch()" {{ old('questionType') === '1' ? 'checked' : '' }}>
                    <label for="typeDescription" class="form-check-label">記述式</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="js-check form-check-input" id="typeSingle" type="radio" name="questionType"
                    value="2" onclick="formSwitch()" {{ old('questionType') === '2' ? 'checked' : '' }}>
                    <label for="typeSingle" class="form-check-label">選択式(単一回答のみ)</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="js-check form-check-input" id="type_multiple" type="radio" name="questionType"
                    value="3" onclick="formSwitch()" {{ old('questionType') === '3' ? 'checked' : '' }}>
                    <label for="type_multiple" class="form-check-label">選択式(複数回答可)</label>
                </div>
                <div id="singleAnswer" class="mt-4">
                    <div>選択肢を登録してください。</div>
                    <div id="inputSingleAnswer" class="answerStyle">
                        <input type="text" class="q_option" name="singleAnswers[]"
                        placeholder="選択肢(単一回答式)" value="{{ old('singleAnswers') }}">
                        <input type="button" value="－" class="deleteSingleAnswer pluralBtn">
                    </div>
                    <input type="button" value="＋" class="addSingleAnswer pluralBtn">
                </div>
                <div id="multipleAnswers" class="mt-4">
                    <div>選択肢を登録してください。</div>
                    <div id="inputMultipleAnswer" class="answerStyle">
                        <input type="text" class="q_option" name="multipleAnswers[]"
                        placeholder="選択肢(複数回答式)" value="{{ old('multipleAnswers') }}">
                        <input type="button" value="－" class="deleteMultipleAnswer pluralBtn">
                    </div>
                    <input type="button" value="＋" class="addMultipleAnswer pluralBtn">
                </div>
                <button type="submit" class="btn bg-origin-btn2 font-origin-btn btn-lg d-block mx-auto mt-4">登録する</button>
                <button type="button" class="btn bg-origin-btn btn-lg d-block mx-auto mt-3">
                    <a href="{{ route('customers.index') }}" class="mx-3">戻る</a>
                </button>
            </form>
        </div>
    </div>
</div>
@endsection