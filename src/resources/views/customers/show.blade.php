@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{ route('visited_records.create', ['customer_id' => $customer->id]) }}">
        <button type="button" class="btn btn-info font-weight-bold
        text-light float-right mb-2">来店記録の作成</button>
    </a>
    <div class="card mx-auto w-100">
        <div class="card-header p-2 h5 text-center bg-light">
            <i class="fas fa-user m-2 font-weight-bold text-secondary"></i>
            <div class="d-inline font-weight-bold text-secondary">
                {{ $customer->name ?? '' }}（{{ $customer->name_kana ?? ''}}）
            </div>
        </div>
        <div class="card-body h6 bg-origin-blue mt-2">
            <div class="row">
                <div class="col-md-6">
                    <ul class="list-group list-group-flush list-group-item-light mb-1">
                        <li class="list-group-item">顧客番号：{{ $customer->id ?? '' }}</li>
                        <li class="list-group-item">生年月日：{{ $customer->birthday ?? '' }}</li>
                        <li class="list-group-item">電話番号：{{ $customer->tel ?? '' }}</li>
                        <li class="list-group-item">
                            性別：{{ $customer->gender ?  $customer->gender === 1 ? '女性' : '男性' : ''}}
                        </li>
                        <li class="list-group-item">職業：{{ $customer->tel ?? '' }}</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <ul class="list-group list-group-flush list-group-item-light">
                        <li class="list-group-item">最終来店日：{{ $lastVisitDate ?? '' }}</li>
                        <li class="list-group-item">総来店回数：{{ $visitedTimes ?? 0 }}回</li>
                        <li class="list-group-item">平均単価：{{ $avgPurchasePrices ?? 0 }}円</li>
                        <li class="list-group-item">アレルギー：{{ $avgPurchasePrices ?? '未登録' }}</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card-body h6 bg-origin-blue mb-0">
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
        <div class="card-body px-0">
            @if($visitedRecords)
                @foreach($visitedRecords as $visitedRecord)
                    <div class="bg-origin-blue py-4">
                        <div class="row px-4">
                            @foreach($imagePaths as $recordId => $imagePath)
                            @if($visitedRecord->id === $recordId)
                            <div class="h4">来店日：{{ $visitedRecord->visited_at ?? '未登録' }}</div>
                            <div class="image">
                                @foreach($imagePath as $image)
                                <div><img src="{{ Storage::url($image) }}" alt="image_{{ $recordId }}"></div>
                                @endforeach
                            </div>
                            @endif
                            @endforeach
                        </div>
                        <div class="row ml-4">
                            <div class="col-md-6 mb-4">
                                <div class="h4">・接客メモ</div>
                                <div class="ml-4">{{ $visitedRecord->memo ?? '未登録' }}</div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="h4">・提供したサービス</div>
                                <div class="ml-4">メニューA</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <a href="{{ route('customers.index') }}">
        <button type="button" class="btn btn-secondary btn-lg d-block mx-auto mt-3">　戻る　</button>
    </a>
</div>
@endsection