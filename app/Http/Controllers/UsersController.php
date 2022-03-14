<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use App\Models\Publisher;
use App\Models\BookAuthor;
use App\Models\User;
use Illuminate\Support\Str;
use Auth;

class UsersController extends Controller
{
	public function profile($username){
		$user = User::where('username',$username)->first();
		if(!is_null($user)){
			return view('frontend.pages.users.show',compact('user'));
		}
		return redirect()->route('index');
	} 

	public function books($username){
		$user = User::where('username',$username)->first();
		if(!is_null($user)){
			return view('frontend.pages.users.books',compact('user'));
		}
		return redirect()->route('index');
	} 

}
