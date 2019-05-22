<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\load;
use App\active;
use App\c_image;
use App\w_image;
class mainController extends Controller
{
    public function rand_fetch() {
    	return response()->json(load::take(10)->get());
    }

    public function show($id) {

    	$items = load::where('id',$id)->firstOrFail();
    	$other = active::where('active',$items->active)->first();
    	$a = explode(',', $other->couns);
    	$b = explode(',', $other->warn);
    	$c = explode(',', $other->count);
        $a_array = array();
        $b_array = array();
        $c_array = array();
        foreach ($a as $ak) {
            $a_array[] = array('number' => $ak, 'item' => c_image::where('number',$ak)->first());
        }
        foreach ($b as $bk) {
            $b_array[] = array('number' => $bk, 'item' => w_image::where('number',$bk)->first());
        }
         foreach ($c as $ck) {
            $c_array[] = array('number' => $ck, 'item' => w_image::where('number',$ck)->first());
        }
    	return response()->json(['items' => $items , 'a'=> $a_array,'b' => $b_array,'c' => $c_array]);
    }
     public function barcode($barcode) {

    	$items = load::where('code',$barcode)->firstOrFail();
    	$other = active::where('active',$items->active)->first();
    	$a = explode(',', $other->couns);
        $b = explode(',', $other->warn);
        $c = explode(',', $other->count);
        $a_array = array();
        $b_array = array();
        $c_array = array();
        foreach ($a as $ak) {
            $a_array[] = array('number' => $ak, 'item' => c_image::where('number',$ak)->first());
        }
        foreach ($b as $bk) {
            $b_array[] = array('number' => $bk, 'item' => w_image::where('number',$bk)->first());
        }
         foreach ($c as $ck) {
            $c_array[] = array('number' => $ck, 'item' => w_image::where('number',$ck)->first());
        }
        return response()->json(['items' => $items , 'a'=> $a_array,'b' => $b_array,'c' => $c_array]);
    }

    public function show_image(Request $req)
    {
        if($req->place == 'a')
        {
            $c_image = c_image::where('number',$req->i)->get();
            return response()->json($c_image);
        }else {
            $w_image = w_image::where('number',$req->i)->get();
            return response()->json($w_image);
        }
    }

    public function activeShow($id)
    {
        $other = active::where('id',$id)->first();
        $a = explode(',', $other->couns);
        $b = explode(',', $other->warn);
        $c = explode(',', $other->count);
        $a_array = array();
        $b_array = array();
        $c_array = array();
        foreach ($a as $ak) {
            $a_array[] = array('number' => $ak, 'item' => c_image::where('number',$ak)->first());
        }
        foreach ($b as $bk) {
            $b_array[] = array('number' => $bk, 'item' => w_image::where('number',$bk)->first());
        }
         foreach ($c as $ck) {
            $c_array[] = array('number' => $ck, 'item' => w_image::where('number',$ck)->first());
        }
        return response()->json(['active' => $other , 'a'=> $a_array,'b' => $b_array,'c' => $c_array]);
    }
}
