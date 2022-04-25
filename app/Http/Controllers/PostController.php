<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all()->sortByDesc('updated_at');
       return view('admin.posts.posts', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'description' => 'required|min:10|max:1000',
            'image' => 'required|image|mimes:jpeg,bmp,png,jpg'
        ]);


        if ($request->hasFile('image')) {

            $name = $request->file('image')->store('images', 'public');

            Post::create([
                'title' => $request->get('title'),
                'description' => $request->get('description'),
                'image' => $name,
            ]);
        }
        return redirect()->route('posts.index')->with('status', 'Post has been Saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('admin.posts.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'description' => 'required|min:10|max:1000',
            'image' => 'required|image|mimes:jpeg,bmp,png,jpg'
        ]);
        if ($request->hasFile('image')) {

            $name = $request->file('image')->store('images', 'public');

            $post = Post::find($post->id);
            $post->title = $request->title;
            $post->description = $request->description;
            $post->image = $name;
            $post->save();
        }
        return redirect()->route('posts.index')->with('status', 'Post has been Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        Storage::delete($post->image);

        $post->delete();
        return redirect()->route('posts.index')->with('status', 'Post has been Deleted!');
    }
}
