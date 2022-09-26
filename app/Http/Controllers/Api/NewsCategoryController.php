<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class NewsCategoryController extends Controller
{
    public function index()
    {
        $newsCategory = NewsCategory::select('code', 'name', 'slug')->orderBy('created_at', 'desc')->get();
        $json = [
            'message' => 'Data successfully retrieve',
            'data' => $newsCategory
        ];

        return response($json, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100|unique:news_categories'
        ]);

        if ($validator->fails()) {
            $json = [
                'message' => $validator->errors()
            ];

            return response($json, 400);
        }

        $data = [
            'code' => 'MB.'.time(),
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ];

        $save = NewsCategory::create($data);

        $json = [
            'message' => 'Data successfully created',
            'data' => $save
        ];

        return response($json, 201);
    }

    public function update(Request $request, $slug)
    {
        $newsCategory = NewsCategory::where('slug', $slug)->first();


        // Check data
        if ($newsCategory == null) {
            $json = [
                'name' => $newsCategory->name,
                'message' => 'Data not found',
            ];

            return response($json, 404);
        }

        //Validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100|unique:news_categories'
        ]);

        if ($validator->fails()) {
            $json = [
                'message' => $validator->errors()
            ];

            return response($json, 400);
        }

        // Update
        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ];

        $update = $newsCategory->update($data);

        $json = [
            'message' => 'Data successfully updated',
            'data' => $update
        ];
        return response($json, 201);
    }

    public function destroy($slug)
    {
        $newsCategory = NewsCategory::where('slug', $slug)->first();

        // Check data
        if ($newsCategory == null) {
            $json = [
                'name' => $newsCategory->name,
                'message' => 'Data not found',
            ];

            return response($json, 404);
        }

        // Delete data
        $newsCategory->delete();

        $json = [
            'message' => 'Data successfully delete',
            'data' => $newsCategory
        ];

        return response($json, 201);
    }
}
