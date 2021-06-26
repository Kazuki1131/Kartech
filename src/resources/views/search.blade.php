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
            <a href="/add-customer">
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
                <tr>
                    <th scope="row">1</th>
                    <td><a href="/record">ヤマダハナコ</a></td>
                    <td>{{ NOW() }}</td>
                    <td>◯回</td>
                    <td>◯円</td>
                    <td>000-0000-0000</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>タナカタロウ</td>
                    <td>{{ NOW() }}</td>
                    <td>◯回</td>
                    <td>◯円</td>
                    <td>111-1111-1111</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>スズキイチロウ</td>
                    <td>{{ NOW() }}</td>
                    <td>◯回</td>
                    <td>◯円</td>
                    <td>222-2222-2222</td>
                </tr>
            </tbody>
        </table>
    </div>
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <li class="page-item disabled"><a class="page-link" href="#"><</a></li>
            <li class="page-item active"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">></a></li>
        </ul>
    </nav>
</div>
@endsection
