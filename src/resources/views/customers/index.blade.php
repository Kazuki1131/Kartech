@extends('layouts.app')
@section('content')
<div class="container">

    <form action="" class="row">
        <div class="input-group col-md-6">
            <input type="search" class="form-control mb-4">
            <span class="input-group-btn">
                <button type="submit" class="btn btn-info rounded-0">
                    <i class="fa fa-search text-light" aria-hidden="true"></i>
                </button>
            </span>
        </div>
        <div class="col-md-6">
            <a href="{{ route('customers.create') }}">
                <button type="button" class="btn btn-info font-weight-bold
                text-light float-right">顧客を追加</button>
            </a>
        </div>
    </form>
    <!-- 6件ずつページネーションさせる -->
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
                @foreach ($customers as $customer)
                    <tr>
                        <th scope="row">{{ $customer->id }}</th>
                        <td>
                            <a href="{{ route('customers.show', ['customer' => $customer]) }}">
                            {{ $customer->name_kana }}</a>
                        </td>
                        @foreach ($lastVisitDates as $customerId => $lastVisitDate)
                            @if ($customer->id === $customerId)
                                <td>{{ $lastVisitDate }}</td>
                            @endif
                        @endforeach
                        @foreach ($visitedTimes as $customerId => $visitedTime)
                            @if ($customer->id === $customerId)
                                <td>{{ $visitedTime }}</td>
                            @endif
                        @endforeach
                        @foreach ($averagePurchasePrices as $customerId => $averagePurchasePrice)
                            @if ($customer->id === $customerId)
                                <td>{{ $averagePurchasePrice }}円</td>
                            @endif
                        @endforeach
                        <td>{{ $customer->tel }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
        <div class="text-center">
            {{ $customers->links() }}
        </div>
</div>
@endsection
