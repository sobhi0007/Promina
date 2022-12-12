<?php

namespace App\Http\Controllers;

use App\Models\Picture;
use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class PictureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {  
        $album = Album::FindOrFail($id);
        $pictures = Album::where('user_id',Auth::user()->id)->findOrFail($id);
        return view('picture.index', compact(['pictures','album']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $album = Album::where('user_id',Auth::user()->id)->findOrFail($id);
        return view('picture.create', compact('album'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request )
    {
        $this->validate($request, [
            'name' => 'required|max:100',
            'picture' => 'required|max:500000|image',
            'album'=>'required|max:100',
        ]);

        $album = Album::Find( $request->album);
        if($album){
            $picture = Picture::create([
                'name' => $request->name,
                'album_id' => $request->album
            ]);
    
            if ($picture) {
                if ($request->hasFile('picture')) {
                    $picture->addMediaFromRequest('picture')->toMediaCollection('pictures');
                }
            }
            return redirect()->back()->with('success', 'Image uploaded successfully');   
        }else{
            return redirect()->back()->with('error', 'Something went wrong !');   
          
        }


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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $picture = Picture::find($id);

        return view('picture.edit', compact('picture'));
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
        $this->validate($request, [
            'name' => 'required'
        ]);

        $picture = Picture::find($id);
        $picture->name = $request->name;
        $picture->save();

        if ($picture) {
            if ($request->hasFile('picture')) {
                $picture->clearMediaCollection('pictures');
                $picture->addMediaFromRequest('picture')->toMediaCollection('pictures');
            }
        }

        session()->flash('success', 'picture Update successfully');

        return redirect()->route('picture.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $picture = Picture::find($id);
        $picture->delete();

        session()->flash('success', 'picture Delete successfully');

        return redirect()->route('picture.index');
    }
}