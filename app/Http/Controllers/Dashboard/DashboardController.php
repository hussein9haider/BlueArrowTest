<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Note;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(Request $request){

        $notes = Note::select('id','admin_id','title','content','photo','type','hash')
        ->when($request->type , function($query) use($request){
            return $query->where('type',$request->type);
        })
        ->where('admin_id',auth('admin')->user()->id)
        ->latest()
        ->paginate(10);

        return view('dashboard.index',[
            'notes' => $notes,
        ]);
    }
}
