<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Alamat;
use Auth;
class AlamatController extends Controllers
{

    function __construct()
    {

    }

    public function get($id)
    {
        return response([
            "alamat" => Alamat::where("id",$id)->get()
        ]);
    }

    public function save(Request $request)
    {
        $action = $request->action;
        if ($action == "insert") {
            try{
                $alamat = new Alamat();
                $alamat->id = $request->id;
                $alamat->nama_penerima = $request->nama_penerima;
                $alamat->kode_pos = $request->kode_pos;
                $alamat->kecamatan = $request->kecamatan;
                $alamat->kota = $request->kota;
                $alamat->jalan = $request->jalan;
                $alamat->rt = $request->rt;
                $alamat->rw = $request->rw;
                $alamat->save();

                return response(["message" => "Data Alamat berhasil ditambahkan"]);
            } catch (\Exception $e) {
                return response(["message" => $e->getMessage()]);
            }
        }else if($action == "update"){
            try{

                $alamat = Alamat::where("id_alamat",$request->id_alamat)->first();
                $alamat->id = $request->id;
                $alamat->nama_penerima = $request->nama_penerima;
                $alamat->kode_pos = $request->kode_pos;
                $alamat->kecamatan = $request->kecamatan;
                $alamat->kota = $request->kota;
                $alamat->jalan = $request->jalan;
                $alamat->rt = $request->rt;
                $alamat->rw = $request->rw;

                /*
                if ($request->file('img_brg')) {
                    $file = $request->file('img_brg');
                    $name = $file->getClientOriginalName();
                    $file->move(\base_path() ."/public/image", $name);
                    $data_pengiriman->img_brg = $name;
                } 
                */
                
                $alamat->save();

                return reponse(["message" => "Data Alamat berhasil diubah"]);
            } catch (\Exception $e) {
                return response(["message" => $e->getMessage()]);
            }
        }
    }
    public function drop ($id_alamat)
        {
            try{
                Alamat::where("id_alamat",$id_alamat)->delete();
                return response(["message" => "Data alamat berhasil dihapus"]);
            } catch (\Exception $e) {
                return response(["message" => $e->getMessage()]);
            }
        }

}
?>