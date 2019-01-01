<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use Validator;
use Auth;
use DB;
use App\Http\Controllers\CommentController ;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(5);
        return view('posts/index',compact('posts'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // nampilin page buat create data
        $posts = Post::paginate(5);
        $category = Category::all();
        return view('posts/create',compact('posts'),compact('category'));
    }
    public function searchPost(Request $request)
    {   
        $search = $request->get('search');

        $posts = DB::table('posts')->where('title','like','%'.$search.'%')->paginate(2);
        return view('posts/mypost',['posts'=>$posts]);

    }
    public function searchPostt(Request $request)
    {   
        $search = $request->get('search');

        $posts = DB::table('posts')->where('title','like','%'.$search.'%')->paginate(2);
        return view('posts/index',['posts'=>$posts]);

    }
    public function mypost(){
        $posts = Post::paginate(5);

        return view ('posts/mypost',compact('posts'));
    }
    public function addComment(Request $request, $id)
    {
        // $validator = Validator::make($request->all(), [
        //    'comment' => 'required'
        // ]);

        // if($validator->fails()){
        //     return back()->withErrors($validator);
        // }

        $comment = new Comment();
        // $comment->user_id = Auth::user()->id;
        $comment->post_id = $id;
        $comment->comment = $request->comment;
        Comment::create($comment);

        return view('posts/detailpost',compact('post'),compact('comment'),compact('user'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // masukin ke databasenya
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:20|max:200',
             'caption' => 'required',
             'Image' => 'required|mimes:jpeg,png,jpg',
             'price' => 'required|integer',
             'category' => 'required|not_in:0',
         ]);
 
         if($validator->fails()) {
             return back()->withErrors($validator);
         }

        $post= new Post();
        $post->user_id = Auth::user()->id;
        $post->title = $request->title;
        $post->caption = $request->caption;
        $post->price= $request->price;
        $post->category=$request->category;
        $post = $request->except('Image');
        $post['Image'] = time().'.'.$request->file('Image')->getClientOriginalExtension();
        
        $request->file('Image')->move('img/',
            $post['Image']);
         
        Post::create($post);
        return redirect('/');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //nampilin detail data
        $post = Post::find($id);
        return view('posts/detailpost',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $posts = Post::paginate(5);
        $category = Category::all();
        // return view('posts/create',compact('posts'),compact('category'));

        $post = Post::find($id);
        // return view('edit',compact('passport','id'));
        // $post = Post::find($id);
        // return view('formupdate',compact('product'));

        // $post = Post::where('id',$id)->get();

        // $post = Post::find($id);    
        // $post->edit();
        return view('posts/edit',compact('post', 'category'));
        
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
        //
        // $post = App\Post::find($id);
        // $post = Post::where('id',$id)->get();
        // $post= \App\Post::find($id);

        $post = Post::find($id);
        $post->title = $request->title;
        $post->category = $request->category;
        $post->caption = $request->caption;
        $post->price= $request->price;

        $imgFile = $request->Image;

        $imgName = time().'.'.$imgFile->getClientOriginalExtension();
        
        $imgFile->move('img/', $imgName);
        $post->Image= $imgName;

        $post->save();
            
        // if($post->save()){
        //     Session::flash('flash_message', 'Task successfully added!');
        // }else{
        //     Session::flash('flash_message', 'Task failed!');
        // }

        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post =Post::find($id);
        $post->delete();
        return redirect()->back(); //habis datanya didelete terus langsung direfresh balik ke page sebelumnya

    }
}
