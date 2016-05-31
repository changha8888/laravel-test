<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\CateRequest;
use Illuminate\Http\Request;
use App\Cate;

class CateController extends Controller {

    public function getList(){
        $item = Cate::select('id','name','parent_id')->orderBy('id','DESC')->get()->toArray();
        return view('admin.cate.list', compact('item'));
    }
	public function getAdd(){
        $parent = Cate::select('id','name','parent_id')->get()->toArray();
        return view('admin.cate.add',compact('parent'));
    }
    public function postAdd(CateRequest $request){
        $cate = new Cate;
        $cate->name = $request->txtCateName;
        $cate->alias = $request->txtCateName;
        $cate->order = $request->txtOrder;
        $cate->parent_id = $request->sltParent;
        $cate->keywords = $request->txtKeywords;
        $cate->description = $request->txtDescription;
        $cate->save();
        return redirect()->route('admin.cate.getList')->with(['flash_level'=>'success','flash_message'=>'Them danh muc thanh cong']);
    }

    public function getEdit($id){
        $data = Cate::findOrFail($id)->toArray();
        $parent = Cate::select('id','name','parent_id')->get()->toArray();
        return view('admin.cate.edit',compact('parent','data','id'));
    }
        public function postEdit(Request $request,$id){
        $this->validate($request,
            ["txtCateName"=>"required"],
            ["txtCateName.required"=>"Please Enter Name Category"]
            );
            $cate = Cate::find($id);
            $cate->name = $request->txtCateName;
            $cate->alias = $request->txtCateName;
            $cate->order = $request->txtOrder;
            $cate->parent_id = $request->sltParent;
            $cate->keywords = $request->txtKeywords;
            $cate->description = $request->txtDescription;
            $cate->save();
            return redirect()->route('admin.cate.getList')->with(['flash_level'=>'success','flash_message'=>'Sưa danh muc thanh cong']);
    }
    public function getDel($id){
        $parent = Cate::where('parent_id',$id)->count();
        if($parent == 0){
            $cate = Cate::find($id);
            $cate->delete();
            return redirect()->route('admin.cate.getList')->with(['flash_level'=>"Success", 'flash_message'=>'Xoa thanh cong']);
        }
        else{
           echo "<script type='text/javascript'>
                    alert('Sorry! You can not Delete This category');
                    window.location='";
                    echo route('admin.cate.list');
            echo"'
                </script>";
        }


    }

}
