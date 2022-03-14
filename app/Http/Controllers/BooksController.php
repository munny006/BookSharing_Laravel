<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use App\Models\Publisher;
use App\Models\BookAuthor;
use Illuminate\Support\Str;
use Auth;

class BooksController extends Controller
{
	public function show($slug){
		return view('frontend.pages.books.show');
	} 

	public function create(){
		$categories = Category::all();
		$publishers = Publisher::all();
		$authors= Author::all();
		$books= Book::where('is_approved',1)->get();
		return view('frontend.pages.books.create',compact('categories','publishers','authors','books'));
	}
	public function store(Request $request)
    {
    	if(!Auth::check()){
    		abort(403,'Unauthorized action');
    	}
        $request->validate([
            'title' => 'required',
            'category_id' =>'required',
            'publisher_id' =>'required',
            'slug' => 'nullable',

            'description' => 'nullable',
            'image' => 'required',
        ]);
        $book = new Book();
        $book->title = $request->title;

        if(empty($request->slug)){
           $book->slug = Str::slug($request->title);
       }
       else{
           $book->slug = $request->slug;
       }
       $book->category_id = $request->category_id ;
       $book->publisher_id = $request->publisher_id ;
       $book->publish_year = $request->publish_year ;
       $book->description = $request->description ;
       $book->user_id= Auth::id();
       $book->is_approved= 0;
       $book->isbn = $request->isbn;
       $book->translator_id = $request->translator_id;
       $book->save();
       //image

       if($request->image){
        $file = $request->file('image');
        $ext = $file->getClientOriginalExtension();
        $name = time().'-'.$book->id.'.'.$ext;
        $path = "images/books";
        $file->move($path,$name);
        $book->image =$name;
        $book->save();
    }




       //book author
    foreach ($request->author_ids as $id) {
     $book_author = new BookAuthor();
     $book_author->book_id = $book->id;
     $book_author->author_id = $id;
     $book_author->save();
 }

 session()->flash('success','Book has been created !!');
 return redirect()->route('index');
}
}
