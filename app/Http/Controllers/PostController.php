<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::query()
            ->orderBy('name')
            ->get();

        $activeCategoryId = $request->query('category');

        $posts = Post::query()
            ->with('category')
            ->when($activeCategoryId, function ($query) use ($activeCategoryId) {
                $query->where('category_id', $activeCategoryId);
            })
            ->orderBy('title')
            ->get();

        return view('welcome', [
            'categories' => $categories,
            'posts' => $posts,
            'activeCategoryId' => $activeCategoryId,
        ]);
    }
}
