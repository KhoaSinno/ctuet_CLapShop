<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function getProducts()
    {
        $products = Product::where('active', true)->get();

        return view('customer.product.index', [
            'title' => 'Danh sách sản phẩm',
            'products' => $products
        ]);
    }

    public function index()
    {
        $categories = Category::all();
        $latestProducts = Product::where('active', true)->orderBy('created_at', 'desc')->take(16)->get();
        // $blogPosts = BlogPost::orderBy('created_at', 'desc')->take(3)->get();
        $title = 'Trang chủ';

        // Lấy danh sách các sản phẩm bán chạy nhất
        $bestSellingProducts = Product::join('order__details', 'products.id', '=', 'order__details.productID')
            ->select('products.*')
            ->selectRaw('SUM(order__details.quantity) as total_sold')
            ->groupBy('products.id')
            ->orderByDesc('total_sold')
            ->take(8) // Lấy top 9 sản phẩm
            ->get();

        return view('customer.home', compact('categories', 'latestProducts', 'title', 'bestSellingProducts'));
    }
}
