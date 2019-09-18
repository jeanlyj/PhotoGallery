<?php

namespace App\Http\Controllers;

use App\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SlidesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    public function create($galleryId) {
        return view('slides.create')->with('galleryId', $galleryId);
    }

    public function store(Request $request) {
        $this->validate($request, [
            'title' => 'required',
            'slide' => 'required|image|max:1999'
        ]);

        // Get filename with the extension
        $filenameWithExtension = $request->file('slide')->getClientOriginalName();
        // Get just filename
        $filename = pathinfo($filenameWithExtension, PATHINFO_FILENAME);
        // Get just extension
        $extension = $request->file('slide')->getClientOriginalExtension();
        // Filename to store
        $fileNameToStore= $filename.'_'.time().'.'.$extension;
        // Upload Image
        $request->file('slide')->storeAs('public/galleries/' . $request->input('gallery-id'), $fileNameToStore);

        // Create Post
        $slide = new Slide();
        $slide->title = $request->input('title');
        $slide->alt = $request->input('alt');
        $slide->user_id = auth()->user()->id;
        $slide->slide = $fileNameToStore;
        $slide->gallery_id = $request->input('gallery-id');
        $slide->save();

        return redirect('/galleries/' .$request->input('gallery-id'))->with('success', 'Slide Uploaded');
    }

    public function show($id) {
        $slide = Slide::find($id);

        return view('slides.show')->with('slide', $slide);
    }

    public function destroy($id) {
        $slide = Slide::find($id);

         // Check for correct user
        if(auth()->user()->id !==$slide->user_id){
            return redirect('/galleries')->with('error', 'Unauthorized Page');
        }

        if (Storage::delete('public/galleries/'.$slide->gallery_id.'/'.$slide->slide)) {
            $slide->delete();
            
            return redirect()->back()->with('success', 'Photo Deleted successfully!');
        }    
    }
}
