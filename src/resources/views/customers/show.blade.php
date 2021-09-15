@extends('layouts.app')

@section('content')
<div class="container pb-5">
    <a class="btn-origin-return float-left" href="{{ route('customers.index') }}">戻る</a>
    <a href="{{ route('visited_records.create', ['customer_id' => $customer->id]) }}" class="btn-origin float-right mb-2">来店記録の作成</a>
    <div class="card mx-auto w-100 bg-origin-card px-0">
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
                        <li class="origin-li">生年月日：{{ $customer->birthday ?? '未登録' }}</li>
                        <li class="origin-li">電話番号：{{ $customer->tel ?? '' }}</li>
                        <li class="origin-li">
                            性別：{{ $customer->gender ?  $customer->gender === 1 ? '女性' : '男性' : ''}}
                        </li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <ul>
                        <li class="origin-li-top">最終来店日：{{ $visitedRecords[0]->visited_at ?? '' }}</li>
                        <li class="origin-li">総来店回数：{{ count($visitedRecords ?? []) }}回</li>
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
            <div class="card-body h6 px-0">
                <h2 class="text-center title">ー 来店記録 ー</h2>
                @foreach($visitedRecords as $visitedRecord)
                    @foreach($imagePaths as $recordId => $imagePath)
                        @if($visitedRecord->id === $recordId)
                            <div class="h4 ml-2 subtitle">
                                【{{ $visitedRecord->visited_at ?? '来店日未登録' }}】
                            </div>
                            <div class="image">
                                @foreach($imagePath as $image)
                                    <img src="{{ Storage::disk('s3')->url($image) }}" alt="image_{{ $recordId }}">
                                @endforeach
                            </div>
                        @endif
                    @endforeach
                    <div class="row ml-2 my-4">
                        <div class="col-md-6 mb-4">
                            <div class="subtitle">- 接客メモ -</div>
                            <div class="ml-2 text">{{ $visitedRecord->memo ?? '未登録' }}</div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="subtitle">- 提供したサービス -</div>
                            @unless(empty($servicesSoldList[$visitedRecord->id]))
                            @foreach($servicesSoldList[$visitedRecord->id] as $service)
                                <div class="ml-2 text">・{{ $service->menu_name }}（¥{{ number_format($service->price_sold) }}）</div>
                            @endforeach
                            @endunless
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection