<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateProductFormRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{

    private $totalPage = 10;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return response()->json(Product::getResults($request->all(), $this->totalPage));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateProductFormRequest $request)
    {
        $dadosFormulario = $request->all();

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $nome = Str::of($request->name)->kebab();
            $extensao = $request->image->extension();

            $nomeArquivo = "{$nome}.{$extensao}";
            $dadosFormulario['image'] = $nomeArquivo;

            $upload = $request->image->storeAs('produtos', $nomeArquivo);

            if (!$upload) {
                return response()->json(['error' => 'Falhou a imagem'], 500);
            }
        }

        $produto = Product::create($dadosFormulario);

        return response()->json($produto, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Product::with('categoria')->findOrFail($id), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateProductFormRequest $request, Product $produto)
    {
        $dadosFormulario = $request->all();

        if ($request->hasFile('image') && $request->file('image')->isValid()) {

            if ($produto->image) {
                if (Storage::exists("produtos/{$produto->image}")) {
                    Storage::delete("produtos/{$produto->image}");
                }
            }

            $nome = Str::of($request->name)->kebab();
            $extensao = $request->image->extension();

            $nomeArquivo = "{$nome}.{$extensao}";
            $dadosFormulario['image'] = $nomeArquivo;

            $upload = $request->image->storeAs('produtos', $nomeArquivo);

            if (!$upload) {
                return response()->json(['error' => 'Falhou a imagem'], 500);
            }
        }

        $produto->update($dadosFormulario);

        return response()->json($produto);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $produto)
    {
        if (Storage::exists("produtos/{$produto->image}")) {
            Storage::delete("produtos/{$produto->image}");
        }
        return response()->json($produto->delete(), 204);
    }
}
