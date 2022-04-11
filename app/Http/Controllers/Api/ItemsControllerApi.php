<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Items;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ShopResources;
use Illuminate\Support\Facades\Storage;

class ItemsControllerApi extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $items = Items::select('name', 'price', 'type', 'file_path', 'coupon_code', 'description', 'updated_at as uploaded')
            ->get()->toArray();

        // $contents = Storage::get('images/OXtXF7gRsNUkc95a4dKJxVz9rNEtfGNOjP4V0VFV.jpg');
        //$contents = asset('images/OXtXF7gRsNUkc95a4dKJxVz9rNEtfGNOjP4V0VFV.jpg');
        //echo "jere".$contents;
        // the ShopResources class that has the toArray method has been used in our web controllers (ShopController,
        // we just want the method to be abstracted here )
        return response()->json(['items' => ShopResources::collection($items), 'message' => 'Items Retrieved successfully'], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->input();

        //echo "Url == ".$request->fullUrl();

        //foreach ($data as $req) {
            /* $validator = $request->validate([
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
             echo "here";*/

            if ($request->hasFile('photos')) {
                $allowedfileExtension = ['jpg', 'png', 'jpeg'];
                $files = $request->file('photos');

                //foreach($files as $file){
                $filename = $files->getClientOriginalName();
                $extension = $files->getClientOriginalExtension();
                $check = in_array($extension, $allowedfileExtension);
                //$path = $request->file('photos')->store('/images');
                /*  $path = Storage::putFileAs(
                      'images', $request->file('photos'), $request->name
                  );*/
                $path1 = Storage::putFile('public/images', $request->file('photos'));
                //$img_name = str_replace('images/', '',$path1);
                // $path =  Storage::move('images/'.$img_name, 'public/images/'.$img_name);
                //echo "path == $path";die;

                if ($check) {
                    try {


                        $save = new Items;
                        $save->name = $request->name;
                        $save->type = $request->type;
                        $save->description = $request->description;
                        $save->price = $request->price;
                        $save->coupon_code = $request->coupon_code;
                        $save->file_path = $path1;

                        $save->save();
                        /*foreach ($request->photos as $photo) {
                            $filename = $photo->store('photos');
                            $validator['filename'] = $filename;
                            //$items = Items::create($validator);
                            //}
                             }*/
                        // }
                    } catch (\Illuminate\Database\QueryException $e) {
                        return response()->json(['message' => $e], 400);
                    }


                    return response()->json(['message' => 'Item uploaded successfully'], 201);

                    // TODO: install intervention/image package to automatically resize images
                    //Image::make(storage_path('app/public/profile.jpg'))->resize(300, 200);
                } else return response(['message' => 'Images must be either jpg,png or jpeg'], 401);
            } else return response(['message' => 'No photos included in your request'], 401);
       // }
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
