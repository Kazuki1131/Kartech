@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mx-auto w-100">
        <div class="card-header p-2 h5 text-center">
            <i class="fas fa-user m-2 font-weight-bold text-secondary"></i>
            <p class="d-inline font-weight-bold text-secondary">山田花子(ヤマダハナコ)</p>
        </div>
        <div class="card-body h6 bg-light mb-0">
            <div class="row">
                <div class="col-md-6">
                    <ul class="list-group list-group-flush list-group-item-light mb-1">
                        <li class="list-group-item">顧客番号：0001</li>
                        <li class="list-group-item">生年月日：{{ NOW() }}</li>
                        <li class="list-group-item">電話番号：090-1234-5678</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <ul class="list-group list-group-flush list-group-item-light">
                        <li class="list-group-item">最終来店日：{{ NOW() }}</li>
                        <li class="list-group-item">総来店回数：◯回</li>
                        <li class="list-group-item">平均単価：〇〇円</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection