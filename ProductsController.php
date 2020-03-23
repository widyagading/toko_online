<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Products;
use Auth;
class ProductsController extends Controller
{
 
  function __construct()
  {

  }

  public function get()
  {
    return response([
      "products" => Products::all()
    ]);
  }

  public function find(Request $request)
  {
    $find = $request->find;
    $products = Products::where("name","like","%$find%")->get();
    return response([
      "products" => $products
    ]);
  }

  public function save(Request $request)
  {
    $action = $request->action;
    if ($action == "insert") {
      try {

        $products = new Products();
        $products->name = $request->name;
        $products->available_quantity = $request->available_quantity;
        $products->price = $request->price;
        $products->description = $request->description;

        if($request->file('image')){
          $file = $request->file('image');
          $name = $file->getClientOriginalName();
          $file->move(\base_path()."/public/images", $name);
          $products->image = $name;
        }
        $products->save();

        return response(["message" => "Data produk berhasil ditambahkan"]);
      } catch (\Exception $e) {
        return response(["message" => $e->getMessage()]);
      }
    }else if($action == "update"){
      try {
        $tujuan_upload = 'public/image';
        $file = $request->file('image');
        $products = Products::where("id",$request->id)->first();
        $products->name = $request->name;
        $products->available_quantity = $request->available_quantity;
        $products->price = $request->price;
        $products->description = $request->description;
        if($request->file('image')){
          $file = $request->file('image');
          $name = $file->getClientOriginalName();
          $file->move(\base_path()."/public/images", $name);
          $products->image = $name;
        }        $products->save();
 

        return response(["message" => "Data produk berhasil diubah"]);
      } catch (\Exception $e) {
        return response(["message" => $e->getMessage()]);
      }
    }
  }

  public function drop($id)
  {
    try {
      Products::where("id", $id)->delete();
      return response(["message" => "Data products berhasil dihapus"]);
    } catch (\Exception $e) {
      return response(["message" => $e->getMessage()]);
    }
  }
}
 ?>
