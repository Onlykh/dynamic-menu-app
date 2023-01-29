<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::with(['contents', 'submenus'])->get();

        return response()->json($menus);
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'url' => 'required',
                'order' => 'required',
                'visible' => 'required',
            ]
        );

        if ($validator->fails()) {
            return response()->json(
                [
                    'add_game_status' => 'failed',
                    'errors'    => $validator->errors()
                ],
                400
            );
        }

        $menu = Menu::create([
            'name' => $request->all()['name'],
            'url' => $request->all()['url'],
            'order' => $request->all()['order'],
            'visible' => $request->all()['visible'],
        ]);

        return response()->json($menu, 201);
    }

    public function show(int $id)
    {
        $menu = Menu::with(['contents', 'submenus'])
            ->where('id', $id)
            ->first();
        return response()->json($menu);
    }

    public function update(Request $request, int $id)
    {
        $menu = Menu::find($id);
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'url' => 'required',
                'order' => 'required',
                'visible' => 'required',
            ]
        );

        if ($validator->fails()) {
            return response()->json(
                [
                    'add_game_status' => 'failed',
                    'errors'    => $validator->errors()
                ],
                400
            );
        }

        $menu->update([
            'name' => $request->all()['name'],
            'url' => $request->all()['url'],
            'order' => $request->all()['order'],
            'visible' => $request->all()['visible'],
        ]);

        return response()->json($menu);
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();

        return response()->json(null, 204);
    }
}