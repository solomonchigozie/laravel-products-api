<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{

    public function index(){
        $products = Products::all();
        return response()->json(["products"=>$products], 200);
    }

    public function show($id){
        $products = Products::find($id);
        if($products):
            return response()->json(["products"=>$products], 200);
        else:
            return response()->json(["message"=>"No Record Found"], 404);
        endif;        
    
    }

    public function store(Request $request){

        //validation
        $request->validate([
            'name'=>'required|max:191',
            'description'=>'required|max:191',
            'price'=>'required|max:191',
            'qty'=>'required|max:191',
            'note'=>'required|max:191',
            'delivery'=>'required|max:101',
        ]);
        
        $product  = new Products();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->qty = $request->qty;
        $product->price = $request->price;
        $product->delivery = $request->delivery;
        $product->note = $request->note;

        //save
        $product->save();

        //send response 
        return response()->json(["message"=>"Product added successfully"]);
    }
}
