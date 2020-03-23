<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Order;
use App\detail_order;
use App\User;
use App\Alamat;
use App\Produk;
use Auth;
class OrderController extends Controller
{

  function __construct()
  {

  } 

  public function get()
    {
        $order = [];
        foreach (Order::all() as $o){
            $detail = [];
            foreach($o->detail_order as $d) {
                $itemDetail = [
                    "id_order" => $d->id_order,
                    "id" => $d->id,
                    "quantity" => $d->quantity,
                    "nama_produk" => $d->product->name
                ];
                array_push($detail, $itemDetail);
            }
            $item = [
                "id_order" => $o->id_order,
                "id" => $o->id,
                "nama_user" => $o->user->username,
                "street" => $o->address->street,
                "id_alamat" => $o->id_alamat,
                "total" => $o->total,
                "bukti_bayar" => $o->bukti_bayar,
                "status" => $o->status,
                "detail" => $detail 
            ];
            array_push($order,$item);
        }
        return response(["order" => $order]);
    }

  public function accept($id) {
    $o = Order::where("id", $id)->first();
    $o->status = "dikirim";
    $o->save();
  }

  public function decline($id) {
    $o = Order::where("id", $id)->first();
    $o->status = "ditolak";
    $o->save();
  }

  public function find(Request $request)
   {
     $find = $request->find;
     $products = Products::where("name","like","%$find%")->orWhere("description","like","%$find%")
     ->orWhere("price","like","%$find%")->get();
     return response([
       "products" => $Products
     ]);
   }

  public function save(Request $request)
   {
      try {
        $order = new Order();
        $order->id = $request->id;
        $order->id_alamat = $request->id_alamat;
        $order->total = $request->total;
        $order->status = "dipesan";
        $order->save();

        $o = Order::where("id", $request->id)->first();
        $detail_order = new detail_Order();
        $detail_order = $o->id_order;
        $detail_order->quantity = $request->quantity;
        $detail_order->save();
        
 
        return response(["message" => "Data Profil berhasil ditambahkan"]);
      }
      catch (\Exception $e) {
        return response(["message" => $e->getMessage()]);
      }
  }

  public function drop($id)
  {
    try { 
      Produk::where("id", $id)->delete();
      return response(["message" => "Data produk berhasil dihapus"]);
    } catch (\Exception $e) {
      return response(["message" => $e->getMessage()]);
    }
  }
}

?>