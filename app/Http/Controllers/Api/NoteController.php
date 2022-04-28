<?php

namespace App\Http\Controllers\Api;

use App\Models\Note;
use App\Models\Admin;
use Illuminate\Support\Str;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class NoteController extends Controller
{
   use GeneralTrait;
	public function get(Request $request){
		try{
			$limit = $request->limit ? $request->limit : 10 ;
			$skip = $request->skip ? $request->skip : 0 ;

			$notes = Note::select('id','admin_id','title','content','photo','type','hash')
			->when($request->type , function($query) use($request){
					return $query->where('type',$request->type);
			})
			->where('admin_id',auth('admin-api')->user()->id)
			->limit($limit)
			->skip($skip)
			->latest()
			->get();
			return $this->returnData('notes', $notes);
		}catch (\Throwable $th) {
			return $this->returnError($th->getCode() , $th->getMessage()); 
		}
	}

	public function store(Request $request){
		try{
			$rules = [
				'title' => 'required|string|max:191',
            'content' => 'required|string',
            'type' => 'required|string|in:urgent,date,normal',
            'photo' => 'nullable|image|mimes:png,jpg',
			];
			$validator = Validator::make($request->all() , $rules);
			if($validator->fails()){
				$code = $this->returnCodeAccordingToInput($validator);
				return $this->returnValidationError($code , $validator);
			}

			$data = $request->only('title','content','type');
			if($request->photo){
				$data['photo'] = $request->photo->store('notes','public');
			}
			$data['admin_id'] = auth('admin-api')->user()->id;
			$data['hash'] = Hash::make(now());
			$note =  Note::create($data);
			return $this->returnData('note', $note);
		}catch (\Throwable $th) {
			return $this->returnError($th->getCode() , $th->getMessage()); 
		}
	}


	public function update(Request $request){
		try{
			$rules = [
				'title' => 'required|string|max:191',
            'content' => 'required|string',
            'type' => 'required|string|in:urgent,date,normal',
            'photo' => 'nullable|image|mimes:png,jpg',
			];
			$validator = Validator::make($request->all() , $rules);
			if($validator->fails()){
				$code = $this->returnCodeAccordingToInput($validator);
				return $this->returnValidationError($code , $validator);
			}
			$note = Note::where([['id',$request->note_id],['admin_id',auth('admin-api')->user()->id]])->first();
			if(!$note){
				return $this->returnError('404','not found'); 
			}
			$data = $request->only('title','content','type');
			if($request->photo){
				$data['photo'] = $request->photo->store('notes','public');
				$path = Str::after($note->photo,'storage/');    
            Storage::disk('public')->delete($path); 
			}
			$note->update($data);
			return $this->returnData('note', $note);
		}catch (\Throwable $th) {
			return $this->returnError($th->getCode() , $th->getMessage()); 
		}
	}

	public function delete($id){
		try{
			$note = Note::findOrfail($id);
			$note->delete();
			return $this->returnSuccessMessage('delete success');
		}catch (\Throwable $th) {
			return $this->returnError($th->getCode() , $th->getMessage()); 
		}
	}

  
}
