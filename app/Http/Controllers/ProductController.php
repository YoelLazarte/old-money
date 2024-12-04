<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Type;
use App\Models\Size;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{


    public function index(){
        $allProducts = Product::with(['type', 'sizes'])->paginate(10);
        return view('products.index', [
            'products' => $allProducts
        ]);
    }

    public function view(int $id){
        return view('products.view', [
            'product' => Product::findOrFail($id)
        ]);
    }

    public function admin(){
        $allProducts = Product::with(['type', 'sizes'])->paginate(10);
        return view('products.admin', [
            'products' => $allProducts
        ]);
    }

    public function createForm()
    {
        return view('products.create-form', [
            'types' => Type::all(),
            'sizes' => Size::orderBy('name')->get(),
        ]);
    }

    public function createProcess(Request $request)
{
    $request->validate([
        'name' => 'required|min:5',
        'price' => 'required|numeric',
        'description' => 'min:25',
        'sizes' => '',
        'type' => '',
        'cover' => 'nullable|image|mimes:jpeg,png,jpg|max:10240'
    ], [
        'name.required' => 'El título debe tener un valor.',
        'name.min' => 'El título debe tener al menos :min caracteres.',
        'price.required' => 'El precio debe tener un valor.',
        'price.numeric' => 'El precio debe ser un numero.',
        'description.required' => 'La descripcion debe tener un valor.',
        'description.min' => 'La descripcion debe tener al menos :min caracteres.',
        'sizes.required' => 'El talle debe tener un valor ( S, M, L, XL ).',
        'type.required' => 'Debes elegir un tipo de prenda',
        'cover.image' => 'El archivo debe ser una imagen.',
        'cover.mimes' => 'La imagen debe tener el formato adecuado (jpeg, png, jpg).',
        'cover.max' => 'La imagen excede el tamaño máximo permitido (10MB).'
    ]);

    $input = $request->all();

    if ($request->hasFile('cover')) {
        $filename = $request->file('cover')->getClientOriginalName();
        $path = $request->file('cover')->storeAs('covers', $filename, 'public');
        $input['cover'] = $filename;
    }

    $product = Product::create($input);

    $product->sizes()->attach($input['size_id'] ?? []);

    return redirect()
        ->route('products.index')
        ->with('feedback.message', 'La prenda <b>' . e($input['name']) . '</b> fue agregada con éxito.')
        ->with('feedback.color', 'blue');
}




    public function editForm(int $id)
    {
        // $sizes = ['S', 'M', 'L', 'XL'];
        $product = Product::findOrFail($id);
        return view('products.edit-form', [
            'product' => Product::findOrFail($id),
            'types' => Type::all(),
            'sizes' => Size::orderBy('name')->get(),
            'selectedSizes' => $product->sizes->pluck('size_id')->toArray()
        ]);
    }

    public function editProcess(int $id, Request $request)
{
    $product = Product::findOrFail($id);

    $request->validate([
        'name' => 'required|min:5',
        'price' => 'required|numeric',
        'description' => 'min:25',
        'sizes' => '',
        'type' => ''
    ], [
        'name.required' => 'El título debe tener un valor.',
        'name.min' => 'El título debe tener al menos :min caracteres.',
        'price.required' => 'El precio debe tener un valor.',
        'price.numeric' => 'El precio debe ser un numero.',
        'description.required' => 'La descripcion debe tener un valor.',
        'description.min' => 'La descripcion debe tener al menos :min caracteres.',
        'sizes.required' => 'El talle debe tener un valor ( S, M, L, XL ).',
    ]);

    $input = $request->except(['_token', 'method']);

    if ($request->hasFile('cover')) {
        if ($product->cover) {
            Storage::delete('public/covers/' . $product->cover);
        }

        $filename = $request->file('cover')->getClientOriginalName();
        $path = $request->file('cover')->storeAs('covers', $filename, 'public');
        $input['cover'] = $filename;
    }

    $product->update($input);

    $product->sizes()->sync($request->input('size_id', []));


    return redirect()
        ->route('products.admin')
        ->with('feedback.message', 'La prenda <b>' . e($input['name']) . '</b> fue actualizada con éxito.')
        ->with('feedback.color', 'blue');
}


    public function deleteProcess(int $id)
    {
        $product = Product::findOrFail($id);

        // $imgRoute = public_path('img/' . $product->img);
        // if (file_exists($imgRoute)) {
        // unlink($imgRoute);
        // }


        $product->sizes()->detach();
        $product->delete();

        return redirect()
            ->route('products.admin')
            ->with('feedback.message', 'La prenda <b> '. e($product->name) .'</b> fue eliminada con éxito.')
            ->with('feedback.color', 'blue');
    }


    
}
