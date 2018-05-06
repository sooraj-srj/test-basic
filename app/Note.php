<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use \DB;
use Auth;

class Note extends Authenticatable
{
    use Notifiable;

    public static function create_note_appln($input = array()){
        $data = DB::table('notes')->insert([
            'user_id'   => Auth::id(),
            'note'      => $input['note'],
            'slug'      => md5(uniqid()),
            'access'	=> $input['access']

        ]);
        return $data;
    }

    public static function get_notes($user_id = ''){
    	if(!empty($user_id)){
    		$data = DB::table('notes as n')
    				->leftJoin('users as u', 'u.id', '=', 'n.user_id')
    				->select('*', DB::raw('DATE_FORMAT(n.created_date, "%b %d, %Y") as created_at')) 
    				->orderBy('created_date', 'desc')
    				->where('n.user_id', $user_id)
    				->get();
    	}
    	else{
    		$data = DB::table('notes as n')
    				->leftJoin('users as u', 'u.id', '=', 'n.user_id')
    				->where('n.access', 'public')
    				->select('*', DB::raw('DATE_FORMAT(n.created_date, "%b %d, %Y") as created_at')) 
    				->orderBy('created_date', 'desc')
    				->get();
    	}

    	return $data;

    }


    public static function get_note_details($slug = ''){
    	$data = DB::table('notes as n')
    				->leftJoin('users as u', 'u.id', '=', 'n.user_id')
    				->select('*', DB::raw('DATE_FORMAT(n.created_date, "%b %d, %Y") as created_at'), 'n.id as note_id') 
    				->orderBy('created_date', 'desc')
    				->where('n.slug', $slug)
    				->first();
    	return $data;

    }

    public static function get_comments($note_id = ''){
    	$data = DB::table('coments as c')
    			->leftJoin('users as u', 'u.id', '=', 'c.user_id')
    			->where('c.note_id', $note_id)
    			->get();

    	return $data;

    }

    public static function post_comment_appln($input = array()){
    	$data = DB::table('coments')->insert([
    		'user_id' 	=> Auth::id(),
    		'note_id'	=> $input['note_id'],
    		'comment'	=> $input['comment']
    	]);

    	return $data;
    }
}
