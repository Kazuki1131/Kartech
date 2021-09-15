@extends('layouts.app')

@section('content')
<div class="container pb-5">
    <a class="btn-origin-return" href="{{ route('customers.index') }}">戻る</a>
    <div class="card mx-auto w-100 bg-origin-card">
        <div class="card-header card-head-origin">お客様情報入力</div>
        <div class="card-body mx-auto w-75">
            <form action="{{ route('customers.store') }}" method="POST" autocomplete="off">
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
                        <h5>お客様名(カナ)</h5>
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
                    <label for="memo" class="mb-0"><h5>ご要望</h5></label>
                    <textarea class="form-control" id="memo" name="memo" cols="30" rows="3" maxlength="1000">{{ old('memo') }}</textarea>
                </div>
                @error('memo')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                @isset($surveyList)
                    <div class="h4 text-center mt-4">アンケートにご協力ください</div>
                    @foreach($surveyList as $id => $survey)
                        @if($survey['type'] === 0)
                            <div class="h5 mt-4">{{ $survey['question'] }}</div>
                            <div class="form-group">
                                <textarea name="answer_text[{{ $id }}]" class="form-control" cols="30" rows="3" maxlength="1000">{{ old("answer_text.$id") }}</textarea>
                            </div>
                            @error('answer_text.*')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        @elseif($survey['type'] === 1)
                            <div class="h5 mt-4">{{ $survey['question'] }}</div>
                            <div class="form-group">
                                <select name="answer_select[{{ $id }}]" class="form-control">
                                    <option value="">選択してください</option>
                                    @foreach($survey['options'] as $option)
                                    <option value="{{ $option }}" {{ old("answer_select.$id") == "$option" ? 'selected' : '' }}>{{ $option }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('answer_select.*')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        @elseif($survey['type'] === 2)
                            <div class="h5 mt-4">{{ $survey['question'] }}（複数回答可）</div>
                            @foreach($survey['options'] as $index => $option)
                                <div class="form-check form-check-inline">
                                    <input name="answer_check[{{$id}}][{{$index}}]" type="checkbox" id="{{ $index }}" value="{{ $option }}"
                                    class="form-check-input" {{ old("answer_check.$id.$index") === "$option" ? 'checked' : '' }}>
                                    <label class="form-check-label" for="{{ $index }}">{{ $option }}</label>
                                </div>
                            @endforeach
                            @error('answer_check.*.*')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        @endif
                    @endforeach
                @endisset
                <button type="submit" class="btn-origin d-block mx-auto mt-4">完了</button>
            </form>
        </div>
    </div>
</div>
@endsection