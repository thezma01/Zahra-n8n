<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogPosts = [
            [
                'title' => 'Post 1',
                'author' => 'Author 1',
                'date' => '2022-01-01',
                'excerpt' => 'This is the excerpt for post 1',
            ],
            [
                'title' => 'Post 2',
                'author' => 'Author 2',
                'date' => '2022-01-15',
                'excerpt' => 'This is the excerpt for post 2',
            ],
            [
                'title' => 'Post 3',
                'author' => 'Author 3',
                'date' => '2022-02-01',
                'excerpt' => 'This is the excerpt for post 3',
            ],
        ];

        return view('blog', compact('blogPosts'));
    }
}