<?php

namespace App\Http\Controllers;

use App\Models\ProductComment;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\CommentImage;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function index(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $query = ProductComment::with(['user', 'images'])
            ->where('product_id', $id);

        // Tìm kiếm theo nội dung
        if ($request->filled('search')) {
            $query->where('content', 'like', '%' . $request->search . '%');
        }

        // Lọc theo số sao
        if ($request->filled('rating')) {
            $query->where('rating', $request->rating);
        }

        // Thống kê
        $totalComments = ProductComment::where('product_id', $id)->count();
        $averageRating = ProductComment::where('product_id', $id)->avg('rating');

        $comments = $query->latest()->paginate(10)->appends($request->query());

        return view('reviews.index', compact('product', 'comments', 'totalComments', 'averageRating'));
    }

    public function create($product_id)
    {
        $product = Product::findOrFail($product_id);
        return view('reviews.create', compact('product'));
    }
    public function store(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $comment = ProductComment::create([
            'product_id' => $id,
            'user_id' => Auth::id(),
            'content' => $request->content,
            'rating' => $request->rating,
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = 'comment_images/' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('comment_images'), basename($filename));
                CommentImage::create([
                    'comment_id' => $comment->id,
                    'image_url' => $filename
                ]);
            }
        }

        return redirect()->route('products.reviews', $id)->with('success', 'Đánh giá đã được thêm!');
    }
}
