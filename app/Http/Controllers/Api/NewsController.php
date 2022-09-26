<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class NewsController extends Controller
{

    public function data()
    {
        $news = News::join('news_categories', 'news.news_category_id', '=', 'news_categories.id')
                      ->select('news.slug','news.title', 'news_categories.name as categoryName', 'news.image')
                      ->orderBy('news.id', 'desc')->get();
        $json = [
            'message' => 'Data successfully retrieve',
            'data' => $news
        ];

        return response($json, 200);
    }

    public function form()
    {
        $newsCategory = NewsCategory::select('id', 'name')->get();

        $json = [
            'message' => 'Data successfully retrieve',
            'data' => $newsCategory
        ];

        return response($json, 200);
    }

    public function store(Request $request)
    {
        //Validation
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:100|unique:news',
            'description' => 'required'
        ]);

        if ($validator->fails()) {
            $json = [
                'message' => $validator->errors()
            ];

            return response($json, 400);
        }

        // Save
        $data = [
            'title' =>  $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'image' => $request->image,
            'news_category_id' => $request->news_category_id,
            'meta_keyword' => $request->meta_keyword,
            'meta_description' => $request->meta_description
        ];

        $save = News::create($data);

        $json = [
            'message' => 'Data successfully created',
            'data' => $save
        ];

        return response($json, 201);
    }

    public function edit($slug)
    {
        $news = News::where('slug', $slug)->first();

        if ($news == null) {
            $json = [
                'message' => 'Data not found',
                'title' => $slug
            ];

            return response($json, 400);
        }

        $json = [
            'message' => 'Data successfully retrieve',
            'data' => $news
        ];

        return response($json, 200);
    }

    public function delete($slug)
    {
        $news = News::where('slug', $slug)->first();
        $news->delete();

        $json = [
            'message' => 'Data successfully remove to trash',
        ];

        return response($json, 201);
    }

    public function trash()
    {
        $newsTrash = News::onlyTrashed()->join('news_categories', 'news.news_category_id', '=', 'news_categories.id')
                      ->select('news.slug','news.title', 'news_categories.name as categoryName', 'news.image')
                      ->orderBy('news.id', 'desc')
                      ->get();

        $json = [
            'message' => 'Data trash successfully retrieve',
            'data' => $newsTrash
        ];

        return response($json, 200);
    }

    public function restore($slug)
    {
        News::where('slug', $slug)->restore();

        $json = [
            'message' => 'Data trash successfully restore'
        ];

        return response($json, 201);
    }
}
