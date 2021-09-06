@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{ route('visited_records.create', ['customer_id' => $customer->id]) }}">
        <button type="button" class="btn btn-origin float-right mb-2">来店記録の作成</button>
    </a>
    <div class="card mx-auto w-100 body-origin">
        <div class="card-header p-2 h5 text-center bg-origin-body">
            <i class="fas fa-user m-2 font-weight-bold text-secondary"></i>
            <div class="d-inline font-weight-bold text-secondary">
                {{ $customer->name ?? '' }}（{{ $customer->name_kana ?? ''}}）
            </div>
        </div>
        <div class="card-body h6 bg-origin-body mt-2">
            <h2 class="text-center line-origin-color">ー <span class="font-origin-head">基本情報</span> ー</h2>
            <div class="row">
                <div class="col-md-6">
                    <ul class="list-group list-group-flush list-group-item-light mb-1">
                        <li class="list-group-item">顧客番号：{{ $customer->control_number ?? '' }}</li>
                        <li class="list-group-item">生年月日：{{ $customer->birthday ?? '' }}</li>
                        <li class="list-group-item">電話番号：{{ $customer->tel ?? '' }}</li>
                        <li class="list-group-item">
                            性別：{{ $customer->gender ?  $customer->gender === 1 ? '女性' : '男性' : ''}}
                        </li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <ul class="list-group list-group-flush list-group-item-light">
                        <li class="list-group-item">最終来店日：{{ $lastVisitDate ?? '' }}</li>
                        <li class="list-group-item">総来店回数：{{ $visitedTimes ?? 0 }}回</li>
                        <li class="list-group-item">平均単価：{{ $avgPurchasePrices ?? 0 }}円</li>
                    </ul>
                </div>
            </div>
        </div>
        @if($answerList)
            <div class="card-body h6 bg-origin-body">
                <h2 class="text-center line-origin-color">ー <span class="font-origin-head">アンケートの回答</span> ー</h2>
                <div class="row py-4">
                    <div class="col-md-6">
                        <ul class="list-group list-group-flush list-group-item-light mb-1">
                            @foreach($answerList as $index => $answer)
                                @if($index % 2 === 0)
                                    <li class="list-group-item text-center">
                                        <h5 class="font-origin-title">{{ $answer['question'] }}</h5>
                                        <div>{{$answer['answer']}}</div>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="list-group list-group-flush list-group-item-light">
                            @foreach($answerList as $index => $answer)
                                @unless($index % 2 === 0)
                                    <li class="list-group-item text-center">
                                        <h5 class="font-origin-title">{{ $answer['question'] }}</h5>
                                        <div>{{$answer['answer']}}</div>
                                    </li>
                                @endunless
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif
        @if($visitedRecords)
            <div class="card-body h6 mb-0 px-0 bg-origin-body">
                <h2 class="text-center line-origin-color">ー <span class="font-origin-head">来店記録</span> ー</h2>
                @foreach($visitedRecords as $visitedRecord)
                    <div class="py-4 mb-1">
                        <div class="px-4">
                            @foreach($imagePaths as $recordId => $imagePath)
                                @if($visitedRecord->id === $recordId)
                                    <div class="h4 ml-2 font-origin-head">
                                        {{ $visitedRecord->visited_at ?? '来店日未登録' }}
                                    </div>
                                    <div class="image">
                                        @foreach($imagePath as $image)
                                            <div class="image_mouseover">
                                                <img src="{{ Storage::disk('s3')->url($image) }}" alt="image_{{ $recordId }}">
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <div class="row ml-2">
                            <div class="col-md-6 mb-4">
                                <div class="h4 line-origin-color">- <span class="font-origin-head">接客メモ</span> -</div>
                                <div class="ml-2 font-origin-head">{{ $visitedRecord->memo ?? '未登録' }}</div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="h4 line-origin-color">- <span class="font-origin-head">提供したサービス</span> -</div>
                                <div class="ml-2 font-origin-head">メニューA</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
    <button type="button" class="btn bg-origin-btn btn-lg d-block mx-auto mt-3">
        <a href="{{ route('customers.index') }}" class="mx-3">戻る</a>
    </button>
</div>
@endsection