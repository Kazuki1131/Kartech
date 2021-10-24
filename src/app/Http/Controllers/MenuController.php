<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MenuRequest;
use App\Services\{InsertIntoDatabaseService, GetMenuListService};
use App\Models\Menu;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(GetMenuListService $menus)
    {
        return view('menus.index',['menus' => $menus->getAllMenusInTheShop()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('menus.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuRequest $request, InsertIntoDatabaseService $insertService)
    {
        $insertService->menus($request);
        return redirect()->route('menus.create')->with('flash_message', 'メニューが登録されました。');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        return view('menus.edit', ['menu' => $menu]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MenuRequest $request, Menu $menu)
    {
        $menu->fill($request->all())->save();
        return redirect()->route('menus.edit', ['menu' => $menu])->with('flash_message', 'メニューを更新しました。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menu = Menu::find($id);
        $menu->delete();
        return redirect()->route('menus.index')->with('flash_massage', 'メニューを削除しました');
    }
}
