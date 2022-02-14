<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Items;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ShopResources;

class ItemsControllerApi extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Items::all();
      //  dd($items);

        // the ShopResources class that has the toArray method has been used in our web controllers (ShopController,
         // we just want the method to be abstracted here )
        return response([ 'items' => ShopResources::collection($items), 'message' => 'Items Retrieved successfully'], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'type' => 'required|max:255',
            'price' => 'required|max:10',
            'photos' => 'required',
            'coupon_code' => 'max:255'
        ]);

        if ($validator->fails()) {
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        if($request->hasFile('photos')){
         $allowedfileExtension = ['jpg','png','jpeg'];
         $files = $request->file('photos');

         foreach($files as $file){
         $filename = $file->getClientOriginalName();
         $extension = $file->getClientOriginalExtension();
         $check = in_array($extension,$allowedfileExtension);

         //dd($check);
        if($check){
        $items = Item::create($request->all());
        foreach ($request->photos as $photo) {
        $filename = $photo->store('photos');
        $validator['filename'] = $filename;
        $items = Items::create($validator);
              }
        }

        return response(['items' => new ShopResources($items), 'message' => 'Items uploaded successfully'], 201);

    // TODO: install intervention/image package to automatically resize images
   //Image::make(storage_path('app/public/profile.jpg'))->resize(300, 200);
    }
}
    else return response(['message' => 'No photos included in your request'], 401);

}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function show(Item $items)
    {
        return response(['items' => new ShopResources($items), 'message' => 'Retrieved successfully'], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $items)
    {
        $items->update($request->all());

        return response(['items' => new ShopResources($items), 'message' => 'Update successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $items)
    {
        $items->delete();

        return response(['message' => 'Deleted']);
    }
}
