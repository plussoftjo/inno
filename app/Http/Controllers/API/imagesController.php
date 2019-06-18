<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;
use Validator;
use Image;
use Illuminate\Support\Facades\Storage;
class imagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $path = "images/".$request->dir;
        $files = array_diff(scandir($path), array('.', '..'));
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $itemCollection = collect($files);
        $perPage =300;
        $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
        $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
        $paginatedItems->setPath($request->url());
        return $paginatedItems;

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $imageData = $request->get('image');
        $fileName = $request->id.'.png';
        Image::make($request->get('image'))->save(public_path('images/'.$request->dir.'/').$fileName);

    }

    public function newImage(Request $request)
    {
         $imageData = $request->get('image');
        $fileName = $request->id.'.png';
        Image::make($request->get('image'))->save(public_path('images/'.$request->dir.'/').$fileName);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
