<?php

namespace App\Http\Controllers;

use App\User;
use App\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    public function index(User $user) 
    {
        $galleries = Gallery::get();
        $galleries = Gallery::orderBy('created_at','desc')->paginate(9);

        return view('galleries.index',compact('user'))->with('galleries',$galleries);
    }

    public function create(User $user) 
    {
        return view('galleries.create',compact('user'));
    }

    public function store(Request $request) 
    {
        $this->validate($request, [
            'title' => 'required',
            'cover_image' => 'required|image|max:1999'
        ]);

        // Get filename with the extension
        $filenameWithExtension = $request->file('cover_image')->getClientOriginalName();
        // Get just filename
        $filename = pathinfo($filenameWithExtension, PATHINFO_FILENAME);
        // Get just extension
        $extension = $request->file('cover_image')->getClientOriginalExtension();
        // Filename to store
        $fileNameToStore= $filename.'_'.time().'.'.$extension;
        // Upload Image
        $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);

        // Create Post
        $gallery = new Gallery;
        $gallery->title = $request->input('title');
        $gallery->user_id = auth()->user()->id;
        $gallery->cover_image = $fileNameToStore;
        $gallery->save();

        return redirect()->route('galleries.show', $gallery)->with('success', 'Gallery Created');
    }

    public function show($id) 
    {
        $gallery = Gallery::with('slides')->find($id);
        return view('galleries.show')->with('gallery', $gallery);
    }

    public function edit($id)
    {
        $gallery = Gallery::find($id);

        // Check for correct user
        if(auth()->user()->id !==$gallery->user_id){
            return redirect('/galleries')->with('error', 'Unauthorized Page');
        }

        return view('galleries.edit')->with('gallery', $gallery);
    }

public function update(Request $request, $id) 
    {
        $this->validate($request, [
            'title' => 'required',
            'cover_image' => 'nullable|image|max:1999'
        ]);

        if($request->hasFile('cover_image')){
            // Get filename with the extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        }

        // Create Post
        $gallery = Gallery::find($id);
        $gallery->title = $request->input('title');
        if($request->hasFile('cover_image')){
            $gallery->cover_image = $fileNameToStore;
        }
        $gallery->save();

        return redirect()->back()->with('success', 'Gallery Updated');
    }


    public function destroy($id)
    {
        $gallery = Gallery::find($id);
        
        //Check if gallery exists before deleting
        if (!isset($gallery)){
            return redirect('/galleries')->with('error', 'No gallery Found');
        }
        // Check for correct user
        if(auth()->user()->id !==$gallery->user_id){
            return redirect('/galleries')->with('error', 'Unauthorized Page');
        }
        if($gallery->cover_image != 'noimage.jpg'){
            // Delete Image
            Storage::delete('public/cover_images/'.$gallery->cover_image);
        }
        
        $gallery->delete();
        return redirect('/dashboard')->with('success', 'Gallery Removed');
    }
}
