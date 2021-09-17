@extends('layouts.app')
@section('content')
<div class="container pb-5">
    @if (session('flash_message'))
        <div class="alert bg-origin-body text-center">
            {{ session('flash_message') }}
        </div>
    @endif
    @if ($customers->count() === 0)
        <div class="alert bg-origin-body text-center">該当する顧客は0件でした。</div>
    @endif
    <form action="{{ route('customers.search') }}" method="GET">
        <div class="form-inline">
            <select name="searchColumn" class="form-control" style="width: 150px;">
                <option value="control_number">顧客番号</option>
                <option value="name">名前</option>
            </select>
            <label>で絞り込む</label>
        </div>
        <div class="row">
            <div class="input-group col-md-6">
                <input type="search" class="form-control" name="keyword">
                <button type="submit" class="input-group-prepend btn-origin-search">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </button>
            </div>
        </div>
    </form>
    <a href="{{ route('customers.create') }}" class="btn-origin float-right my-2">顧客を追加</a>
    <div class="table-responsive mt-1">
        <table class="table table-hover text-nowrap">
            <caption>この表は横スクロールできます（挟画面時のみ）</caption>
            <thead class="bg-origin-body">
                <tr>
                    <th scope="col">顧客番号</th>
                    <th scope="col">お名前</th>
                    <th scope="col">生年月日</th>
                    <th scope="col">最終来店日</th>
                    <th scope="col">総来店回数</th>
                    <th scope="col">平均単価</th>
                    <th scope="col">電話番号</th>
                </tr>
            </thead>
            <tbody>
                @if ($customers)
                    @foreach ($customers as $customer)
                        <tr>
                            <th scope="row">{{ $customer->control_number }}</th>
                            <td>
                                <a href="{{ route('customers.show', ['customer' => $customer]) }}">{{ $customer->name_kana }}</a>
                            </td>
                            <td>{{ $customer->birthday
                                ? $customer->birthday . '（' . \Carbon\Carbon::parse($customer->birthday)->age . '歳）'
                                : '未登録'}}</td>
                            <td>{{ $visitedDates[$customer->id][0] ?? ''}}</td>
                            <td>{{ count($visitedDates[$customer->id] ?? []) }}回</td>
                            <td>{{ $avgSellingPrices[$customer->id] }}円</td>
                            <td>{{ $customer->tel }}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
    @if ($customers)
    <div class="row justify-content-center">{{ $customers->links() }}</div>
    @endif
</div>

@endsection