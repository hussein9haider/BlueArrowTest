<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Note;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Dashboard\NoteRequest;

class NoteController extends Controller
{
    public function create(){
        return view('dashboard.notes.create');
    }

    public function store(NoteRequest $request){
        $data = $request->only('title','content','type');
        if($request->photo){
            $data['photo'] = $request->photo->store('notes','public');
        }
        $data['admin_id'] = auth('admin')->user()->id;
        $data['hash'] = Hash::make(now());
        Note::create($data);
         session()->flash('success',__('dashboard.added successfully'));
        return redirect(route('dashboard'));
    }

    public function show($hash,$id){
        $note = Note::where([['id',$id],['hash',$hash]])->first();
        if(!$note){
            return abort(404);
        }
        return view('dashboard.notes.show',['note'=>$note]);
    }

    public function delete($id){
        $note = Note::findOrfail($id);
        $note->delete();
        session()->flash('success',__('dashboard.deleted successfully'));
        return redirect(route('dashboard'));
    }
}
