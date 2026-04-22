<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::where('domain', getDomain())
            ->orderBy('created_at', 'desc')
            ->paginate(50);
        return view('adminpanel.news.index', compact('news'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required|string',
            'title'    => 'required|string|max:500',
            'content'  => 'nullable|string',
        ]);

        $item = News::create([
            'category' => $request->category,
            'title'    => $request->title,
            'content'  => $request->content,
            'domain'   => getDomain(),
        ]);

        return response()->json(['success' => true, 'item' => $item]);
    }

    public function show(News $news)
    {
        return response()->json(['success' => true, 'item' => $news]);
    }

    public function update(Request $request, News $news)
    {
        $request->validate([
            'category' => 'required|string',
            'title'    => 'required|string|max:500',
            'content'  => 'nullable|string',
        ]);

        $news->update($request->only('category', 'title', 'content'));

        return response()->json(['success' => true]);
    }

    public function destroy(News $news)
    {
        $news->delete();
        return response()->json(['success' => true]);
    }
}
