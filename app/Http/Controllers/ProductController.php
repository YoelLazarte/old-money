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
        $allProducts = Product::with(['type', 'sizes'])->get();
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
            // 'img' => 'required|image|mimes:png|max:400',


        ],[
            'name.required' => 'El título debe tener un valor.',
            'name.min' => 'El título debe tener al menos :min caracteres.',
            'price.required' => 'El precio debe tener un valor.',
            'price.numeric' => 'El precio debe ser un numero.',
            'description.required' => 'La descripcion debe tener un valor.',
            'description.min' => 'La descripcion debe tener al menos :min caracteres.',
            'sizes.required' => 'El talle debe tener un valor ( S, M, L, XL ).',
            'type.required' => 'Debes elegir un tipo de prenda',
            // 'img.required' => 'La imágen es obligatoria',
            // 'img.max' => 'La imágen excede los kilobytes máximos - :max',
            // 'img.mimes' => 'La imágen no tiene el formato adecuado - png'
        ]);

        //Preguntamos si el request nos trae una imágen, en caso de que sea asi (que debería ya que estamos validando), guardamos la imagen en la ruta donde se encuentran las demás
        // if ($request->hasFile('img')) {
        //     //Obtenemos el "valor" de img
        //     $image = $request->file('img');
        //     //Con el metodo time hacemos que cada archivo tenga un nombre único ya que toma segundo y luego lo concatenamos con un guión y con el nombre de la foto que sube el admin (con su respectiva extensión, en este caso .png)
        //     //Es decir, si yo subo una foto que se llama ropa1, este archivo se va a guardar asi por ejemplo 1723451820-ropa1.png
        //     $imgName = time() . '-' . $image->getClientOriginalName();
        //     //Con el método move movemos el archivo de donde lo almaceno laravel temporalmente, y con public_path generamos la ruta completa de la carpeta img dentro de la carpeta public de nuestro proyecto, nos permite que el archivo se guarde en public/img. Con el segundo parámetro le decimos como queremos que se almacene, asi que le pasamos la variable anterior
        //     $image->move(public_path('img'), $imgName);
        // }
        
        //Acá no obtenemos el valor de la img ya que no es un input
        $input = $request->all();

        
        if ($request->hasFile('cover')) {
            $input['cover'] = $request->file('cover')->store('covers', 'public');
        };


        // Agregamos el nombre de la imagen a los datos a cargar 
        // $input['img'] = $imgName; 

        $product = Product::create($input);

        

        $product->sizes()->attach($input['size_id'] ?? []);

        return redirect()
            ->route('products.index')
            ->with('feedback.message', 'La prenda <b> '. e($input['name']) .'</b> fue agregada con éxito.')
            ->with('feedback.color', 'blue');
    }



    public function editForm(int $id)
    {
        // $sizes = ['S', 'M', 'L', 'XL'];
        return view('products.edit-form', [
            'product' => Product::findOrFail($id),
            'types' => Type::all(),
            'sizes' => Size::orderBy('name')->get(),
        ]);
    }

    public function editProcess(int $id, Request $request)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|min:5',
            'price' => 'required|numeric',
            'description' => 'min:25',
            'sizes',
            // 'img' => 'image|mimes:png|max:400',
            'type' => ''
        ],[
            'name.required' => 'El título debe tener un valor.',
            'name.min' => 'El título debe tener al menos :min caracteres.',
            'price.required' => 'El precio debe tener un valor.',
            'price.numeric' => 'El precio debe ser un numero.',
            'description.required' => 'La descripcion debe tener un valor.',
            'description.min' => 'La descripcion debe tener al menos :min caracteres.',
            'sizes.required' => 'El talle debe tener un valor ( S, M, L, XL ).',
            // 'img.required' => 'La imágen es obligatoria',
            // 'img.max' => 'La imágen excede los kilobytes máximos - :max',
            // 'img.mimes' => 'La imágen no tiene el formato adecuado - png'
        ]);
        //Verificamos si existe una nueva imágen
        // if ($request->hasFile('img')) {

        //     //BORRAR ARCHIVOS https://stackoverflow.com/questions/44710894/how-to-delete-images-from-public-images-folder-in-laravel-5-url-data

        //     //Creamos una variable que contiene la ruta de la imágen
        //     //Creamos una condición que pregunta si ese archivo existe (para agregar otra capa de validación), y en caso de que sea cierto se utiliza el método unlink para borrarla
        //     $imgRoute = public_path('img/' . $product->img);
        //         if (file_exists($imgRoute)) {
        //         unlink($imgRoute);
        //         }


        //     $imgName = time() . '.' . $request->file('img')->getClientOriginalExtension();
        //     $request->file('img')->move(public_path('img'), $imgName);
    
        //     $input['img'] = $imgName;
        // }

        $input = $request->except(['_token', 'method']);


        $product = Product::findOrFail($id);

        if ($request->hasFile('cover')) {

            //BORRAR ARCHIVOS https://stackoverflow.com/questions/44710894/how-to-delete-images-from-public-images-folder-in-laravel-5-url-data

            //Creamos una variable que contiene la ruta de la imágen
            //Creamos una condición que pregunta si ese archivo existe (para agregar otra capa de validación), y en caso de que sea cierto se utiliza el método unlink para borrarla
            
            
            // Esto lo usabamos para que se borren las imagenes
            // $imgRoute = public_path('img/' . $product->img);
            //     if (file_exists($imgRoute)) {
            //     unlink($imgRoute);
            //     }


            // $imgName = time() . '.' . $request->file('img')->getClientOriginalExtension();
            // $request->file('img')->move(public_path('img'), $imgName);
    
            $input['cover'] = $request->file('cover')->store('covers', 'public');
            Storage::delete($product->cover);
        }

        $product->update($input);
        $product->sizes()->sync($request->input('sizes_fks', []));

        return redirect()
            ->route('products.admin')
            ->with('feedback.message', 'La prenda <b> '. e($input['name']) .'</b> fue actualizada con éxito.')
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
