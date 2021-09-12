@extends('layouts.app')
@section('content')
<div class="container pb-5">

    <form action="" class="row">
        <div class="input-group col-md-6">
            <input type="search" class="form-control mb-4">
            <span class="mb-4">
                <button type="submit" class="btn-origin-search">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </button>
            </span>
        </div>
        <div class="col-md-6">
        </div>
    </form>
    <a href="{{ route('customers.create') }}" class="btn-origin float-right mb-2">顧客を追加</a>
    <!-- 10件ずつページネーションさせる -->
    <div class="table-responsive mt-1">
        <table class="table table-hover text-nowrap">
            <caption>この表は横スクロールできます（挟画面時のみ）</caption>
            <thead class="thead-light">
                <tr>
                    <th scope="col">顧客番号</th>
                    <th scope="col">お名前</th>
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
                            @foreach ($lastVisitDates as $customerId => $lastVisitDate)
                                @if ($customer->id === $customerId)
                                    <td>{{ $lastVisitDate }}</td>
                                @endif
                            @endforeach
                            @foreach ($visitedTimes as $customerId => $visitedTime)
                                @if ($customer->id === $customerId)
                                    <td>{{ $visitedTime }}回</td>
                                @endif
                            @endforeach
                            @foreach ($avgPurchasePrices as $customerId => $avgPurchasePrice)
                                @if ($customer->id === $customerId)
                                    <td>{{ $avgPurchasePrice }}円</td>
                                @endif
                            @endforeach
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