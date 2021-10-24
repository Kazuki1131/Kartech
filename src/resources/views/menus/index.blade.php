@extends('layouts.app')

@section('content')
<div class="container pb-5">
    <a href="{{ route('menus.create') }}" class="btn btn-origin float-right my-2">メニューを追加</a>
    <div class="table-responsive mt-1">
        <table class="table table-hover text-nowrap sample">
            <caption>この表は横スクロールできます（挟画面時のみ）</caption>
            <thead class="bg-origin-body">
                <tr>
                    <th scope="col">メニュー名</th>
                    <th scope="col">料金</th>
                    <th scope="col">メニュー概要</th>
                </tr>
            </thead>
            <tbody>
            @if ($menus)
                @foreach ($menus as $menu)
                    <tr>
                        <th scope="row">
                            <a href="{{ route('menus.edit', $menu) }}">{{ $menu->name }}</a>
                        </th>
                        <td>
                            <a href="{{ route('menus.edit', $menu) }}">{{ $menu->price }}</a>
                        </td>
                        <td>
                            <a href="{{ route('menus.edit', $menu) }}">{{ $menu->description }}</a>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
    <div class="row justify-content-center"></div>
</div>
@endsection