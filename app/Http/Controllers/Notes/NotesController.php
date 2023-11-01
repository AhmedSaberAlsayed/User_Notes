<?php

namespace App\Http\Controllers\Notes;

use App\Http\Controllers\Controller;
use App\Http\Requests\deleterequest;
use App\Http\Requests\noterequest;
use App\Http\Requests\notes\Storerequest;
use App\Http\Requests\notes\Updaterequest;
use App\Http\Traits\ImagesTrait;
use App\Models\note;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotesController extends Controller
{
    use ImagesTrait;

    public function indexall()
    {
        $notes = note::all();
        return view("notes.indexall", compact("notes"));
    }
    
    public function index(){
        $user=Auth::user();
        $notes = note::where('user_id',$user->id)->get();
        return view("notes.index",compact("notes"));
    }
    public function create(){
        
        
        return view("notes.create");
    }
    public function store(Storerequest $storerequest){
        $fileName= time() . '_images.jpg';
        $this->uploadimg($storerequest->images, $fileName, 'images');
        $id= Auth::id();
        note::create([
            'title'=> $storerequest->title,
            'body'=> $storerequest->body,
            'user_id'=> $id,
            'images'=> $fileName 
        ]);
        return redirect()->route("notes.index")->with("success","note was added");
}

public function delete($notes_id){
    $notes= note::find( $notes_id );

    unlink(public_path($notes->images));
     $notes->delete();
     session()->flash('done','note was deleted');
     return redirect()->route('notes.index');
}
public function edit(Request $Request){
    $notes = note::where('id',$Request->notes_id)->first();
    return view('notes.edit', compact('notes'));
}
public function update(Updaterequest $request) 
{
    $notes=note::where('id',$request->notes_id)->first();
    $fileName= time() . '_images.jpg';
    $this->uploadimg($request->images, $fileName, 'images' ,$notes->images);
    $notes->update([
        'title'=> $request->title,
        'body'=> $request->body,
        'images'=>$fileName
    ]);
    return redirect(route('notes.index'));
}
}
