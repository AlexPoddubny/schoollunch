<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use App\Repositories\ProductsRepository;
use Illuminate\Http\Request;
use Spatie\Searchable\Search;
use Gate;

class ProductsController extends AdminController
{
    
    protected $product_rep;
    
    public function __construct(ProductsRepository $product_rep)
    {
        parent::__construct();
        $this->product_rep = $product_rep;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Gate::denies('Course_Create')){
            abort(403);
        }
        $this->validate($request, [
            'name' => ['required', 'max:100']
        ]);
        $result = $this->product_rep->create($request);
        if(is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }
        return redirect(route('courses.index'));
    }
    /*
    public function search(Request $request)
    {
        $searchTerm = $request->input('query');
        $searchResults = (new Search())
            ->registerModel(Product::class, 'name')
            ->perform($searchTerm);
        return view('search.product', compact('searchResults', 'searchTerm'))->render();
    }*/

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $this->title .= 'Редагування продукту: ' . $product->name;
        $this->content = view('admin.product_edit')
            ->with([
                'product' => $product
            ])
            ->render();
        return $this->renderOutput();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $result = Product::find($id)->update($request->except('_token', '_method'));
        return redirect(route('courses.index'))->with($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Gate::denies('Course_Create')){
            abort(403);
        }
        $product = Product::find($id);
        $product->course()->detach();
        $result = $product->delete();
        return redirect(route('courses.index'))->with($result);
    }
}
