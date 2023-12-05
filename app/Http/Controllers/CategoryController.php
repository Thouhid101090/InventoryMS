<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use Exception;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $row = (int) request('row',10);

        if($row<1 || $row >100){
            abort(400,'The pre_page parametre must be integer between 1 to 100');
        }

        $categories = Category::filter(request(['search']))
        ->paginate($row)
        ->appends(request()->query());
        return view('categories.index',[
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        // Category::create($request->validated());
        $category = new Category;
        $category->name=$request->name;
        $category->slug=$request->slug;


        $category->created_by=currentUserId();
        if($category->save()){
            $this->notice::success('Category has been added!');
            return redirect()->route('categories.index');

        }           
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category=Category::findorFail(encryptor('decrypt',$id));
        return view('categories.edit',compact('category'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, $id)
    {
        $category=Category::findorFail(encryptor('decrypt',$id));
        $category->name=$request->name;
        $category->slug=$request->slug;


        $category->updated_by=currentUserId();
        if( $category->save()){
            $this->notice::success('Data successfully updated');
            return redirect()->route('categories.index');
            

        }
       
      
       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $category= Category::findOrFail(encryptor('decrypt',$id));
            $category->delete();
            $this->notice::success('Data Successfully Deleted');
            return back();
        } catch (Exception $e) {
            dd($e);
        }

    }
}
