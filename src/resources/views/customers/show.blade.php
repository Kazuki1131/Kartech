@extends('layouts.app')

@section('content')
<div class="container pb-5">
    <a href="{{ route('visited_records.create', ['customer_id' => $customer->id]) }}">
        <button type="button" class="btn btn-origin float-right mb-2">来店記録の作成</button>
    </a>
    <div class="card mx-auto w-100 bg-origin-card">
        <div class="card-header card-head-origin py-4">
                <i class="fas fa-user m-2 font-weight-bold text-secondary"></i>
                {{ $customer->name ?? '' }}（{{ $customer->name_kana ?? ''}}）
        </div>
        <div class="card-body h6 mb-0">
            <h2 class="text-center title">ー 基本情報 ー</h2>
            <div class="row">
                <div class="col-md-6">
                    <ul>
                        <li class="origin-li-top">顧客番号：{{ $customer->control_number ?? '' }}</li>
                        <li class="origin-li">生年月日：{{ $customer->birthday ?? '' }}</li>
                        <li class="origin-li">電話番号：{{ $customer->tel ?? '' }}</li>
                        <li class="origin-li">
                            性別：{{ $customer->gender ?  $customer->gender === 1 ? '女性' : '男性' : ''}}
                        </li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <ul>
                        <li class="origin-li-top">最終来店日：{{ $lastVisitDate ?? '' }}</li>
                        <li class="origin-li">総来店回数：{{ $visitedTimes ?? 0 }}回</li>
                        <li class="origin-li">平均単価：{{ $avgPurchasePrices ?? 0 }}円</li>
                    </ul>
                </div>
            </div>
        </div>
        @if($surveyList)
            <div class="card-body h6 mb-0">
                <h2 class="text-center title">ー アンケートの回答 ー</h2>
                <div class="row py-4">
                    <div class="col-md-6">
                        <ul class="list-group mb-1">
                            @foreach($surveyList as $index => $survey)
                                @if($index % 2 === 0)
                                    <li class="list-group-item text-center bg-origin-card">
                                        <h5 class="">{{ $survey['question'] }}</h5>
                                        <div>{{$survey['answer']}}</div>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="list-group">
                            @foreach($surveyList as $index => $survey)
                                @unless($index % 2 === 0)
                                    <li class="list-group-item text-center bg-origin-card">
                                        <h5 class="">{{ $survey['question'] }}</h5>
                                        <div>{{$survey['answer']}}</div>
                                    </li>
                                @endunless
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif
        @if($visitedRecords)
            <div class="card-body h6 mb-0 px-0">
                <h2 class="text-center title">ー 来店記録 ー</h2>
                @foreach($visitedRecords as $visitedRecord)
                    <div class="py-4 mb-1">
                        <div class="px-4">
                            @foreach($imagePaths as $recordId => $imagePath)
                                @if($visitedRecord->id === $recordId)
                                    <div class="h4 ml-2">
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
                                <div class="h4">- 接客メモ -</div>
                                <div class="ml-2 text">{{ $visitedRecord->memo ?? '未登録' }}</div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="h4">- 提供したサービス -</div>
                                <div class="ml-2 text">メニューA</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
    <div class="text-center mt-4">
        <a class="btn-origin-return" href="{{ route('customers.index') }}">戻る</a>
    </div>
</div>
@endsection