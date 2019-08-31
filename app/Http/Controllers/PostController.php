<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\PostImage;
use Auth;
use Storage;

class PostController extends Controller
{
    public function index(){
        $posts = Post::with('post_images')->orderBy('created_at', 'desc')->get();
        return response()->json([
            'error' => false ,
             'data' => $posts
             ]);
    }   

    public function create(){
        $user =  auth()->user();
        $post = Post::create(
            array_merge(
            request()->except(['images']) ,
            ['user_id' => $user->id]
            )
        );
        if(request()->images){
            foreach(request()->images as  $image){
                $imagePath = Storage::disk('public')->put($user->email . '/posts/'. $post->id, $image);
 
                 PostImage::create([
                    'post_image_caption' => request()->title, 
                    'post_image_path' =>  'uploads/' . $imagePath, 
                    'post_id' => $post->id
                ]);
            }
        }

        return response()->json([
            'error' => false , 
            'data' => $post
        ]);
    }
}
