<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use App\Models\Publisher;
use App\Models\BookAuthor;
use Illuminate\Support\Str;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::all();
        return view('backend.pages.books.index',compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $categories = Category::all();
       $publishers = Publisher::all();
       $authors= Author::all();
       $books= Book::where('is_approved',1)->get();
       return view('backend.pages.books.create',compact('categories','publishers','authors','books'));
   }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
       $book->user_id= 1;
       $book->is_approved= 1;
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
 return  back();
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::find($id);

        $categories = Category::all();
        $publishers = Publisher::all();
        $authors= Author::all();
        $books= Book::where('is_approved',1)->where('id','!=',$id)->get();
        return view('backend.pages.books.edit',compact('categories','publishers','authors','books','book'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $book =Book::find($id);
       $request->validate([
        'title' => 'required',
        'category_id' =>'required',
        'publisher_id' =>'required',
        'slug' => 'nullable',

        'description' => 'nullable',
        'image' => 'nullable',
    ]);
       
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
     //$book->user_id= 1;
     //$book->is_approved= 1;
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
    $book_authors = BookAuthor::where('book_id',$book_id)->get();
    foreach ($book_author as $author) {
        $author->delete();
    }
    foreach ($request->author_ids as $id) {

     $book_author = new BookAuthor();
     $book_author->book_id = $book->id;
     $book_author->author_id = $id;
     $book_author->save();
 }

 session()->flash('success','Book has been updated !!');
 return  back();
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {

        $book =Book::find($id);

        $book->delete();
        session()->flash('success','Book has been deleted !!');
        return  back();
    }
}
