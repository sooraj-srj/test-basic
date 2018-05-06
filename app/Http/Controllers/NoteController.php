<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Note;
use Auth;

class NoteController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('note/create');
    }

    public function create_appln(Request $request){
        $input = $request->all();
        $data = Note::create_note_appln($input);
        if($data){
            return redirect()->intended('user/notes')->with('success', 'Note has been created and saved successfully!');
        }
        else{
            return redirect()->intended('notes/create')->with('error', 'Oops! Something went wrong.');
        }
    }

    public function list_my_notes(){
        $data = Note::get_notes(Auth::id());
        return view('note/list')->with('notes',$data);
    }

    public function list_notes(){
        $data = Note::get_notes();
        return view('note/list')->with('notes',$data);
    }

    public function note_page($slug = ''){
        $data = Note::get_note_details($slug);
        $comment = Note::get_comments($data->note_id);
        //dd($data);
        return view('note/details')
                ->with('comments',$comment)
                ->with('note',$data);
    }


    public function comment_appln(Request $request){
        $input = $request->all();
        $data = Note::post_comment_appln($input);
        if($data){
            return redirect()->intended('note/'.$input['slug'])->with('success', 'Comment posted successfully!');
        }
        else{
            return redirect()->intended('notes/'.$input['slug'])->with('error', 'Oops! Something went wrong.');
        }
    }

    

    
}
