<?php

namespace App\Http\Controllers;

use App\Models\SubMenuContentImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubMenuContentImageController extends Controller
{
    public function index()
    {
        $menuContentImages = SubMenuContentImage::with('subMenuContent')->get();

        return response()->json($menuContentImages);
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required',
                'url' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'sub_menu_content_id' => 'required|exists:sub_menu_contents,id',
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

        $path = '';
        if ($request->hasFile('url')) {
            $file = $request->file('url');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('menu-content-images', $fileName, 'public');
        }

        $menuContentImage = SubMenuContentImage::create([
            'title' => $request->all()['title'],
            'url' => $path,
            'sub_menu_content_id' => $request->all()['sub_menu_content_id'],
        ]);

        return response()->json($menuContentImage, 201);
    }

    public function show(int $id)
    {
        $menuContentImage = SubMenuContentImage::with('subMenuContent')
            ->where('id', $id)
            ->first();
        return response()->json($menuContentImage);
    }

    public function update(Request $request, int $id)
    {
        $menuContentImage = SubMenuContentImage::find($id);
        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required',
                'url' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'sub_menu_content_id' => 'required|exists:sub_menu_contents,id',
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

        $path = '';
        if ($request->hasFile('url')) {
            $file = $request->file('url');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('menu-content-images', $fileName, 'public');
        }

        $menuContentImage->update([
            'title' => $request->all()['title'],
            'url' => $path,
            'sub_menu_content_id' => $request->all()['sub_menu_content_id'],
        ]);

        return response()->json($menuContentImage);
    }

    public function destroy(SubMenuContentImage $menuContentImage)
    {
        $menuContentImage->delete();

        return response()->json(null, 204);
    }
}