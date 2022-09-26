<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    public function index()
    {
        return view('admin.news.news');
    }

    public function data()
    {
        $news = Http::get('http://perumdajepara.test/api/news/data')['data'];
        return view('admin.news.news-data', compact('news'));
    }

    public function form()
    {
        $newsCategories = Http::get('http://perumdajepara.test/api/news/form')['data'];
        return view('admin.news._form', compact('newsCategories'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|max:100|unique:news',
            'image' => 'mimes:png,jpg,jpeg|required|max:2048',
            'description' => 'required'
        ]);

        $image = $request->image;
        $newImage = time().Str::slug($image->getClientOriginalName());
        $image->move('uploads/news', $newImage);

        // Save
        $data = [
            'title' =>  $request->title,
            'description' => $request->description,
            'image' => $newImage,
            'news_category_id' => $request->news_category_id,
            'meta_keyword' => $request->meta_keyword,
            'meta_description' => $request->meta_description
        ];


        $save = Http::post('http://perumdajepara.test/api/news', $data);

        if (!empty($save['message']['name'])) {
            $error= $save['message']['name'];
            $message = implode('', $error);
            return back()->with('error', $message);
        } else {
            $message= $save['message'];
            return redirect()->route('news.edit', $save['data']['slug'])->with('success', $message);
        }
    }

    public function edit($slug)
    {
        $news = Http::get('http://perumdajepara.test/api/news/edit/'.$slug)['data'];
        $newsCategories = Http::get('http://perumdajepara.test/api/news/form')['data'];

        return view('admin.news._form', compact('news', 'newsCategories'));
    }

    public function delete($slug)
    {
        $trash = Http::delete('http://perumdajepara.test/api/news/delete/'.$slug);
        return back()->with('success', $trash['message']);
    }

    public function trash()
    {
        $newsTrash = Http::get('http://perumdajepara.test/api/news/trash')['data'];
        return view('admin.news.trash', compact('newsTrash'));
    }

    public function restore($slug)
    {
        $restore = Http::post('http://perumdajepara.test/api/news/restore/'.$slug);
        return back()->with('success', $restore['message']);

    }
}
