<?php

namespace App\Http\Controllers;

use App\Models\MenuContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MenuContentController extends Controller
{
    public function index()
    {
        $menuContents = MenuContent::with(['menu', 'images'])
            ->get();

        return response()->json($menuContents);
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required',
                'description' => 'required',
                'menu_id' => 'required|exists:menus,id',
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

        $menuContent = MenuContent::create([
            'title' => $request->all()['title'],
            'description' => $request->all()['description'],
            'menu_id' => $request->all()['menu_id'],
        ]);

        return response()->json($menuContent, 201);
    }

    public function show(int $id)
    {
        $menuContent = MenuContent::with(['menu', 'images'])
            ->where('id', $id)
            ->first();
        return response()->json($menuContent);
    }

    public function update(Request $request, int $id)
    {
        $menuContent = MenuContent::find($id);
        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required',
                'description' => 'required',
                'menu_id' => 'required|exists:menus,id',
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

        $menuContent->update([
            'title' => $request->all()['title'],
            'description' => $request->all()['description'],
            'menu_id' => $request->all()['menu_id'],
        ]);

        return response()->json($menuContent);
    }

    public function destroy(MenuContent $menuContent)
    {
        $menuContent->delete();

        return response()->json(null, 204);
    }
}