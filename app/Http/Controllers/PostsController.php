<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\storage;
use App\Http\Controllers\Controller;
use App\Post;
use App\Card;

class PostsController extends Controller
{ 
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except'=>['index','show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        /*$request->session()->flash('error', 'Test');‏*/
        $posts = post::orderBy('created_at','desc')->paginate(10);
        return view('posts.index')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required',
            'body'=>'required',
            'cover_image'=>'image|nullable|max:1999'
        ]);

        //here to handle image upload ya engy eh m3aya wala nseety

        if($request->hasFile('cover_image')){
            //geting file name with ext
            $fileNameWithExt=$request->file('cover_image')->getClientOriginalName();
            //get just name
            $filename = pathinfo($fileNameWithExt,PATHINFO_FILENAME);
            //getting ext from here
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            //file name to be saved
            $fileNameToStore=$filename.'_'.time().'.'.$extension;
            // for upload men hna
            $path = $request->file('cover_image')->storeAS('public/cover_image',$fileNameToStore);
        }else{
            $fileNameToStore = 'noimage.jpg';
        }

        //create card
        $post = new Post;
        $post-> title = $request->input('title');
        $post-> body = $request->input('body');
        $post->user_id=auth()->user()->id;
        $post->cover_image=$fileNameToStore;
        $post->save();

        return redirect('/posts')->with('success','Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $post = Post::find($id);
        $cards = $post->cards()->get();
        /*var_dump($post->cards()->get()->toArray());*/
        return view('posts.show')->with([
            'post' => $post,
            'cards' => $cards
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   // check for correct user
         $post = Post::find($id);
        if(auth()->user()->id !==$post->user_id)
        {
            return redirect('/posts')->with('error','Unauthorized page');
        }
        
         return view('posts.edit')->with('post',$post);
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
        $this->validate($request,[
            'title'=>'required',
            'body'=>'required'
        ]);

         //here to handle image upload ya engy eh m3aya wala nseety

        if($request->hasFile('cover_image')){
            //geting file name with ext
            $fileNameWithExt=$request->file('cover_image')->getClientOriginalName();
            //get just name
            $filename = pathinfo($fileNameWithExt,PATHINFO_FILENAME);
            //getting ext from here
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            //file name to be saved
            $fileNameToStore=$filename.'_'.time().'.'.$extension;
            // for upload men hna
            $path = $request->file('cover_image')->storeAS('public/cover_image',$fileNameToStore);
        }

        //create card
        $post = Post::find($id);
        $post-> title = $request->input('title');
        $post-> body = $request->input('body');
        if ($request->hasFile('cover_image')) {
            $post->cover_image = $fileNameToStore; 
        }
        $post->save();

        return redirect('/posts')->with('success','Card Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post=post::find($id);
      /*  if(auth()->user()->id !==post->user_id){
            return redirect('/posts')->with('error','you do not want to go there');
        }*/

        if ($post->cover_image !='noimage.jpg') {
            //delete the image
            Storage::delete('public/cover_image/'.$post->cover_image);
        }
        $post->delete();
        return redirect('/posts')->with('success','Card Deleted');
    }

    public function createCard($id) {
        $post = Post::find($id);

        if ($post === null) {
            //... Post couldn't be found
        }

        return view('posts.create-card')->with([
            'post' => $post
        ]);
    }

    public function storeCard(Request $request, $id) {
        $post = Post::find($id);

        $this->validate($request,[
            'title' => 'required',
            'body' => 'required',
        ]);

        $card = new Card;
        $card->title = $request->input('title');
        $card->body = $request->input('body');
        $card->post_id = $post->id;
        $card->status = 'TODO';
        $order->order = 0;
        $card->save();

        return redirect("/posts/{$id}")->with('success', 'Card Created');
    }
}


