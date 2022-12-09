<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product_category;
use App\Models\product_details;
use App\Models\product_images;
use App\Models\rooms;
use App\Models\products;
class AdminController extends Controller
{
    public function add(Request $request){
        $categories_header = product_category::all();
        $rooms_header = rooms::all();
        $categories = product_category::where('room_id', $request->id_selected)->get();
        
        return view('dashboard.pro_modifier',compact('categories_header','rooms_header','categories'));
    }

    public function store(Request $request){
        // thêm sản phẩm
        $data_pro = [
            'name' => $request->input('name'),
            'product_category_id' => $request->input('product_category_id'),
            'material' => $request->input('material'),
            'room_id' => $request->input('room_id'),
            'qty' => $request->input('qty'),
            'weight' => $request->input('weight'),
            'price' => $request->input('price'),
        ];
        $product = products::create($data_pro);
        // thêm chi tiết sản phẩm
        $data_detail = [
            'product_id' => $product->id,
            'size' => $request->input('size'),
        ];
        product_details::create($data_detail);

        // thêm product_images

        // $image = array();
        $files = $request->input('image');
        $upload_path = '/front/images/image_products/';
        if($files){
            foreach($files as $file){
                $path = strval($file);
                $data_image = [
                'product_id' => $product->id,
                'path' => strval($file)
                ];
                // $file->move(public_path($upload_path),$path);
                product_images::create($data_image);
            }
        }  


        return "Thêm sản phẩm thành công!!!";
    }
    
}
