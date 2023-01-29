<?php

namespace App\Http\Controllers;

use App\Models\SubMenuContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubMenuContentController extends Controller
{
    public function index()
    {
        $subMenuContents = SubMenuContent::with(['submenu', 'images'])
            ->get();

        return response()->json($subMenuContents);
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required',
                'description' => 'required',
                'sub_menu_id' => 'required|exists:sub_menus,id',
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

        $subMenuContent = SubMenuContent::create([
            'title' => $request->all()['title'],
            'description' => $request->all()['description'],
            'sub_menu_id' => $request->all()['sub_menu_id'],
        ]);

        return response()->json($subMenuContent, 201);
    }

    public function show(int $id)
    {
        $subMenuContent = SubMenuContent::with(['submenu', 'images'])
            ->first();
        return response()->json($subMenuContent);
    }

    public function update(Request $request, int $id)
    {
        $subMenuContent = SubMenuContent::find($id);
        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required',
                'description' => 'required',
                'sub_menu_id' => 'required|exists:sub_menus,id',
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

        $subMenuContent->update([
            'title' => $request->all()['title'],
            'description' => $request->all()['description'],
            'sub_menu_id' => $request->all()['sub_menu_id'],
        ]);

        return response()->json($subMenuContent);
    }

    public function destroy(SubMenuContent $subMenuContent)
    {
        $subMenuContent->delete();

        return response()->json(null, 204);
    }
}