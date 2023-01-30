<?php

namespace App\Http\Controllers;

use App\Models\MenuContentImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MenuContentImageController extends Controller
{
    public function index()
    {
        $menuContentImages = MenuContentImage::with('menuContent')->get();

        return response()->json($menuContentImages);
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required',
                'url' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'menu_content_id' => 'required|exists:menu_contents,id'
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

        $menuContentImage = MenuContentImage::create([
            'title' => $request->all()['title'],
            'url' => $path,
            'menu_content_id' => $request->all()['menu_content_id'],
        ]);

        return response()->json($menuContentImage, 201);
    }

    public function show(int $id)
    {
        $menuContentImage = MenuContentImage::with('menuContent')
            ->where('id', $id)
            ->get();
        return response()->json($menuContentImage);
    }

    public function update(Request $request, int $id)
    {
        $menuContentImage = MenuContentImage::find($id);
        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required',
                'url' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'menu_content_id' => 'required|exists:menu_contents,id',
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
            'menu_content_id' => $request->all()['menu_content_id'],
        ]);

        return response()->json($menuContentImage);
    }

    public function destroy(MenuContentImage $menuContentImage)
    {
        $menuContentImage->delete();

        return response()->json(null, 204);
    }
}
