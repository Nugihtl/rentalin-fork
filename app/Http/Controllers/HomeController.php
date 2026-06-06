<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
{

    $categories =
    Category::all();

    $items =
    Item::latest()
        ->take(8)
        ->get();

    return view(
        'pages.home',
        compact(
            'categories',
            'items'
        )
    );

}
}