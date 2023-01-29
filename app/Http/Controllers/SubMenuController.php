<?php

namespace App\Http\Controllers;

use App\Models\SubMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubMenuController extends Controller
{
    public function index()
    {
        $subMenus = SubMenu::with(['menu', 'contents'])->get();

        return response()->json($subMenus);
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
                'menu_id' => 'required|exists:menus,id'
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

        $subMenu = SubMenu::create([
            'name' => $request->all()['name'],
            'url' => $request->all()['url'],
            'order' => $request->all()['order'],
            'visible' => $request->all()['visible'],
            'menu_id' => $request->all()['menu_id']
        ]);

        return response()->json($subMenu, 201);
    }

    public function show(int $id)
    {
        $subMenu = SubMenu::with(['menu', 'contents'])
            ->where('id', $id)
            ->first();

        return response()->json($subMenu);
    }

    public function update(Request $request, int $id)
    {
        $subMenu = SubMenu::find($id);
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'url' => 'required',
                'order' => 'required',
                'visible' => 'required',
                'menu_id' => 'required|exists:menus,id'
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

        $subMenu->update([
            'name' => $request->all()['name'],
            'url' => $request->all()['url'],
            'order' => $request->all()['order'],
            'visible' => $request->all()['visible'],
            'menu_id' => $request->all()['menu_id']
        ]);

        return response()->json($subMenu);
    }

    public function destroy(SubMenu $subMenu)
    {
        $subMenu->delete();

        return response()->json(null, 204);
    }
}