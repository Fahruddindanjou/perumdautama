<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NewsCategoryController extends Controller
{
    public function index()
    {
        $newsCategories = Http::get('http://perumdajepara.test/api/news-categories')['data'];
        return view('admin.news.news-category', compact('newsCategories'));
    }

    public function store(Request $request)
    {

        $save = Http::post('http://perumdajepara.test/api/news-categories', $request->all());

        if (!empty($save['message']['name'])) {
            $error= $save['message']['name'];
            $message = implode('', $error);
            return back()->with('error', $message);
        } else {
            $message= $save['message'];
            return back()->with('success', $message);
        }

    }

    public function update(Request $request, $slug)
    {
        $update = Http::patch('http://perumdajepara.test/api/news-categories/'.$slug, $request->all());
        if (!empty($update['message']['name'])) {
            $error= $update['message']['name'];
            $message = implode('', $error);
            return back()->with('error', $message);
        } else {
            $message= $update['message'];
            return back()->with('success', $message);
        }
    }

    public function destroy($slug)
    {
        $delete = Http::delete('http://perumdajepara.test/api/news-categories/'.$slug);
        return back()->with('success', $delete['message']);
    }
}
