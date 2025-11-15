<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::orderBy('id', 'ASC')->paginate(10);
        return view('admin.category.list',compact('categories'));
    }
    public function create(){
      return view('admin.category.create');
    }
    public function store(Request $request){
       $validator=Validator::make($request->all(),[
             'name'=>'required',
             'slug'=>'required|unique:categories',
       ]);

       if($validator->passes()){
           $categry= new Category();
           $categry->name= $request->name;
           $categry->slug= $request->slug;
           $categry->status= $request->status;
           $categry->save();

         //  $request->session()->flash('success', 'Category Added Successfully');


           return response()->json([
            'status'=>true,
             'message'=>'Category Added Successfully'
        ]);
       }else{
        return response()->json([
            'status'=>false,
             'errors'=>$validator->errors()
        ]);
       }
    }
    public function edit(){

    }
    public function update(){

    }
}
