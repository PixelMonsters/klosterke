<?php

namespace App\Http\Controllers;

use App\Enum\ProductCategory;
use App\Models\Product;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::query()
            ->orderBy('category')
            ->orderBy('sells_before')
            ->get();

        $categories = ProductCategory::cases();

        return view('products.index', [
            'products' => $products->groupBy(fn (Product $product) => $product->category->value),
            'categories' => $categories,
        ]);
    }
}
