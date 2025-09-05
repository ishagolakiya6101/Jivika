<?php

namespace App\Http\Admin\Category\Services;

use App\Http\Admin\Category\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class CategoryService{
    public function create($request){
        $category = isset($request->category_id) ? Category::find($request->get('category_id')) : [];
        if(isset($request->category_id) && empty($category))
            return redirect()->to('admin/category')->with('error','Category not found');
        $categories = Category::whereNull('parent_id')->where(function($query) use($category){
            if(!empty($category))
                $query->whereNot('id',$category->id);
        })->get();
        return view('_back.category.create', compact('categories','category'));
    }
    public function upload($request)
    {      
        if($request->hasFile('image') && $request->file('image') != null){
            $name=$request->file('image')->getClientOriginalName();  
            $path = "public/image/category/".$name;
            Storage::put($path, file_get_contents($request->file('image')));
            return $name;  
        }
        return '';
    }
    public function store($request)
    {
        $name = $this->upload($request);
        $category = Category::create([
            'name'=>$request->name,
            'description'=>$request->description,
            'parent_id'=>$request->parent_id ?? null,
            'image'=> $name ?? ''
        ]);
        return $category;
    }
    public function update($request,$category)
    {
        $name = $this->upload($request);
        $category->update([
            'name'=>$request->name,
            'description'=>$request->description,
            'parent_id'=>$request->parent_id ?? null,
            'image'=> $name ?? $category->image
        ]);
        return $category;
    }
    public function categoryById($id)
    {
        return Category::find($id);
    } 
    public function delete($category)
    {
        try {
            return $category->delete();
        } catch (\Exception $e) {
            return false; // Return false on error
        }
    }
    public function show($request)
    {
        $categories = Category::select('id','name','slug','description','image','parent_id')->with('category')->get();
        return CategoryResource::collection($categories);   
    }
}