@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mx-auto w-100">
        <div class="card-header p-2 h5 text-center">
            <i class="fas fa-user m-2 font-weight-bold text-secondary"></i>
            <div class="d-inline font-weight-bold text-secondary">
                {{ $customer->name ?? '' }}（{{ $customer->name_kana ?? ''}}）
            </div>
        </div>
        <div class="card-body h6 bg-light mb-0">
            <div class="row">
                <div class="col-md-6">
                    <ul class="list-group list-group-flush list-group-item-light mb-1">
                        <li class="list-group-item">顧客番号：{{ $customer->id ?? '' }}</li>
                        <li class="list-group-item">生年月日：{{ $customer->birthday ?? '' }}</li>
                        <li class="list-group-item">電話番号：{{ $customer->tel ?? '' }}</li>
                        <li class="list-group-item">職業：{{ $customer->tel ?? '' }}</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <ul class="list-group list-group-flush list-group-item-light">
                        <li class="list-group-item">最終来店日：{{ $lastVisitDate ?? '' }}</li>
                        <li class="list-group-item">総来店回数：{{ $visitedTimes ?? '' }}回</li>
                        <li class="list-group-item">平均単価：{{ $averagePurchasePrices ?? '' }}円</li>
                        <li class="list-group-item">アレルギー：{{ $averagePurchasePrices ?? '' }}円</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card-body h6 bg-light mb-0">
            <div class="row">
                <div class="col-md-6">
                    <ul class="list-group list-group-flush list-group-item-light mb-1">
                        @foreach($annotationTitles as $key => $title)
                            @if($key % 2 == 0)
                                <li class="list-group-item">{{ $title->title }}：
                                    @foreach($annotationContents as $content)
                                        @if($content->annotation_id == $title->id)
                                            {{ $content }}
                                        @endif
                                    @endforeach
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
                <div class="col-md-6">
                    <ul class="list-group list-group-flush list-group-item-light">
                        @foreach($annotationTitles as $key => $title)
                            @unless($key % 2 == 0)
                                <li class="list-group-item">{{ $title->title }}：
                                    @foreach($annotationContents as $content)
                                        @if($content->annotation_id == $title->id)
                                            {{ $content }}
                                        @endif
                                    @endforeach
                                </li>
                            @endunless
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection