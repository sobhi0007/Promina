<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use App\Models\Album;
use App\Models\Picture;
use Illuminate\Http\Request;
use App\DataTables\AlbumDataTable;
use Illuminate\Support\Facades\Auth;
class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AlbumDataTable $dataTable)
    {
        return $dataTable->render('albums.index');
   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $request->validate([
        'name'=> 'required|max:100'
       ]);

       $name = Album::where('user_id',Auth::user()->id)->where('name',$request->name)->first();
        if($name){
            return redirect('albums')->with('error', 'Album already exists   ');
        }else{
        
            Album::create([
                'name'=>$request->name,
                'user_id'=>Auth::user()->id
                ]);
                return redirect('albums')->with('success', 'New album created successfully ');
        }

       
    }

  
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function show(Album $album)
    {
        
        $pictures = Album::where('user_id',Auth::user()->id)->findOrFail($album->id)->pictures;
        return  view('albums.show', compact('pictures','album'));     
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function edit(Album $album)
    {
     return  view('albums.edit', compact('album'));     
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Album $album)
    {

        $album =  Album::findOrFail($album->id);

        $data = $request->validate([
            'name'=>'required|max:100'
        ]);

        $album->name = $request->name;
        $album->save();
        return redirect()->back()->with('status','Album updated successfully');
    
    }





public function forcedelete($id)
{
   Album::findOrFail($id)->delete();
   return redirect('albums')->with('status','Album deleted successfully');
}

public function deleteOptions($id)
{
   $album_current = Album::where('user_id',Auth::user()->id)->findOrFail($id);
   $album_all = Album::where('user_id',Auth::user()->id)->where('name','!=',$album_current->name)->get();

 return  view('albums.delete_options', compact(['album_current','album_all']));

}
    



public function changeAlbum(Request $request)
{
     $request->validate([
        'album'=> 'required',
       ]);

    $new_album = Album::findOrFail($request->album);
    $old_album = Album::findOrFail($request->old_album);

    $pictures =  Picture::where('album_id', $old_album->id)->get();


   foreach ($pictures as $picture ) {
        $move = Picture::find($picture->id);
        $move->album_id =  $new_album->id;
        $move->save();
   }
   Album::findOrFail($old_album->id)->delete();
   return redirect('albums')->with('status','Pictures moved to '. $new_album->name . 'album and '. $old_album->name.' deleted successfully');
}


}