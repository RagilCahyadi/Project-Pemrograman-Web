<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with(['category', 'photos'])
                          ->latest()
                          ->paginate(15);
        
        $categories = Category::all();
        
        return view('products.index', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'nullable|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'is_popular' => 'boolean',
            'is_active' => 'boolean'
        ]);

        // Handle thumbnail upload
        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')
                                             ->store('products', 'public');
        }

        // Map form fields to database fields
        $productData = [
            'name' => $validated['name'],
            'about' => $validated['description'], // Map description to about
            'price' => $validated['price'],
            'stock_quantity' => $validated['stock_quantity'] ?? 0,
            'stock' => $validated['stock_quantity'] ?? 0, // Keep both for compatibility
            'category_id' => $validated['category_id'],
            'thumbnail' => $validated['thumbnail'],
            'slug' => Str::slug($validated['name']),
            'is_popular' => $request->has('is_popular'),
            'is_active' => $request->has('is_active')
        ];

        Product::create($productData);

        return redirect()->route('products.index')
                        ->with('success', 'Product created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product->load('category', 'orderItems');
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'about' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'thumbnail' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
            'is_popular' => 'boolean',
            'is_active' => 'boolean'
        ]);

        // Handle thumbnail upload
        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail
            if ($product->thumbnail) {
                Storage::disk('public')->delete($product->thumbnail);
            }
            $validated['thumbnail'] = $request->file('thumbnail')
                                             ->store('products', 'public');
        }

        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_popular'] = $request->has('is_popular');
        $validated['is_active'] = $request->has('is_active');

        $product->update($validated);

        return redirect()->route('products.index')
                        ->with('success', 'Product updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            // Delete thumbnail
            if ($product->thumbnail) {
                Storage::disk('public')->delete($product->thumbnail);
            }

            // Delete associated photos
            foreach ($product->photos as $photo) {
                if ($photo->photo_path) {
                    Storage::disk('public')->delete($photo->photo_path);
                }
                if ($photo->photo_url) {
                    Storage::disk('public')->delete($photo->photo_url);
                }
            }
            $product->photos()->delete();

            // Delete the product
            $product->delete();

            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Product deleted successfully!'
                ]);
            }

            return redirect()->route('products.index')
                            ->with('success', 'Product deleted successfully!');
                            
        } catch (\Exception $e) {
            Log::error('Product deletion failed: ' . $e->getMessage());
            
            if (request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to delete product: ' . $e->getMessage()
                ], 500);
            }

            return redirect()->route('products.index')
                            ->with('error', 'Failed to delete product: ' . $e->getMessage());
        }
    }

    /**
     * Upload additional photos for the product
     */
    public function uploadPhoto(Request $request, Product $product)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('products/photos', 'public');
            
            $product->photos()->create([
                'photo_path' => $photoPath,
                'photo_url' => $photoPath  // For backward compatibility
            ]);

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Photo uploaded successfully!',
                    'photo_url' => Storage::url($photoPath)
                ]);
            }
        }

        return redirect()->route('products.edit', $product)
                        ->with('success', 'Photo uploaded successfully!');
    }

    /**
     * Delete a specific photo from the product
     */
    public function deletePhoto(Product $product, $photoId)
    {
        $photo = $product->photos()->findOrFail($photoId);
        
        if ($photo->photo_path) {
            Storage::disk('public')->delete($photo->photo_path);
        }
        
        $photo->delete();

        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Photo deleted successfully!'
            ]);
        }

        return redirect()->route('products.edit', $product)
                        ->with('success', 'Photo deleted successfully!');
    }

    /**
     * Search products via AJAX
     */
    public function search(Request $request)
    {
        $query = $request->get('q');
        
        $products = Product::with('category')
                          ->where('name', 'LIKE', "%{$query}%")
                          ->orWhere('about', 'LIKE', "%{$query}%")
                          ->limit(10)
                          ->get();

        return response()->json($products);
    }
}
