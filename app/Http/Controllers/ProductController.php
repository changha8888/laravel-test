<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Request;
//use Illuminate\Http\Request;
use App\Product;
use App\Cate;
use App\Image;
use App\Http\Requests\ProductRequest;
use Input,File;

class ProductController extends Controller {

	public function getAdd(){
        $cate = Cate::select('id','name','parent_id')->get()->toArray();
        return view('admin.product.add', compact('cate'));

    }
    public function postAdd(ProductRequest $request){
        $file_name = $request->file('fImages')->getClientOriginalName();
        $product = new Product;
        $product->name = $request->txtName;
        $product->alias = $request->txtName;
        $product->price = $request->txtPrice;
        $product->intro = $request->txtIntro;
        $product->content = $request->txtContent;
        $product->image = $file_name;
        $product->keywords = $request->txtKeywords;
        $product->description = $request->txtDescription;
        $product->user_id = 1;
        $product->cate_id = $request->sltParent;
        $request->file('fImages')->move('resources/upload/',$file_name);
        $product->save();
        $product_id = $product->id;
        if(Input::hasFile('fProductDetail')){
            foreach(Input::file('fProductDetail') as $file){
                $product_img = new Image();
                if(isset($file)){
                    $product_img->image = $file->getClientOriginalName();
                    $product_img->product_id  = $product_id;
                    $file->move('resources/upload/detail/', $file->getClientOriginalName());
                    $product_img->save();
                }
            }
        }

        return redirect()->route('admin.product.getList')->with(['flash_level'=>'success','flash_message'=>'Them san pham thanh cong']);
    }
    public function getList(){
        $data = Product::select('id','name','price','created_at','cate_id')->orderBy('id','DESC')->get()->toArray();
        return view('admin.product.list',compact('data'));
    }
    public function getEdit($id){
        $cate = Cate::select('id','name','parent_id')->get()->toArray();
        $data = Product::find($id);
        $product_image = Product::find($id)->images->toArray();
        return view('admin.product.edit',compact('cate','data','product_image'));

    }
    public function postEdit(Request $request, $id){
        $product = Product::find($id);
        $product->name = Request::input('txtName');
        $product->price = Request::input('txtPrice');
        $product->intro = Request::input('txtIntro');
        $product->content = Request::input('txtContent');
        $product->keywords = Request::input('txtKeywords');
        $product->description = Request::input('txtDescription');
        $img_current = 'resources/upload/detail'.Request::input('img_current');
        if(!empty(Request::file('fImages'))){
            $file_name = Request::file('fImages')->getClientOriginalName();
            $product->image = $file_name;
            Request::file('fImages')->move('resources/upload/detail',$file_name);
            if(File::exists($img_current)){
                File::delete($img_current);
            }
        }else{
            echo "ko co file";
            }
        $product->save();

        $product_id = $product->id;
        if(Input::hasFile('fProductDetail')){
            foreach(Input::file('fProductDetail') as $file){
                $product_img = new Image();
                if(isset($file)){
                    $product_img->image = $file->getClientOriginalName();
                    $product_img->product_id  = $product_id;
                    $file->move('resources/upload/detail/', $file->getClientOriginalName());
                    $product_img->save();
                }
            }
        }


        return redirect()->route('admin.product.getList')->with(['flash_level'=>'success','flash_message'=>'Sưa san pham thanh cong']);

    }
    public function getDelImg($id){
        if(Request::ajax()){
            $idHinh = (int)Request::get('idHinh');
            $image_detail = Image::find($idHinh);
            if(!empty($image_detail)){
                $img = 'resources/upload/detail/'.$image_detail->image;
                if(File::exists($img)){
                    File::delete($img);
                }
                $image_detail->delete();
            }
            return 1;
        }

    }

}
