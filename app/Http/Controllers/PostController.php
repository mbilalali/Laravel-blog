<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PostController extends Controller
{
    const EXCERPT_LENGTH = 100;
    public function add(){
        $categories = Category::all();
        $tags = Tag::all();
//        $tags = Tags::all();
//        $data = [
//            'categories' => Category::all(),
//            'tags' => Tags::all(),
//        ];
        return view('write',['categories' => $categories, 'tags' => $tags]);
        //return view('write');
    }


    public function write(Request $request){
        $post = new Post();
        $post->title = $request->title;
        //$post->image = $request->image;
        $userid = Auth::user()->id;
        $post->user_id = $userid;

        $post->tag_id = $request->tag_id;
        $post->category_id = $request->category_id;
        $post->content = $request->blogcontent;
        $post->is_approved = "0";

        $imgData = array(
            'data'=>$request,
            'returnType'=>'request',
            'request_name'=>'image',
            'request_name_new'=>'blog',
            'folder_name'=>'blog',
            'file_name'=>'post',
        );


        $request = $this->manageAttachment($imgData);
        $post->image = $request->blog;
        $post->save();
       return redirect('blogs');
    }


    public function edit(Request $request){
        $imgData = array(
            'data'=>$request,
            'returnType'=>'request',
            'request_name'=>'blogimage',// coming from html form
            'request_name_new'=>'image', // table column name
            'folder_name'=>'blog',
            'file_name'=>'post',
        );

        $request = $this->manageAttachment($imgData);
        $post = Post::where('id',$request->id)->update($request->except('id','_token', 'blogimage'));
           return redirect(route('home'));
    }

    public function logout (){
        Auth::logout();
        return redirect('/login');
    }

    public function index(){
        $post = POST::all();
        return view('blogs', ['posts'=> $post]);
    }

    public function blogs($type=null, $slug=null){
        if($type == 'tag'){
            $tag = Tag::where('slug', $slug)->first();
           if(!$tag){return abort(404);}
            $post = $tag->posts;
        }
        else if($type == 'category'){
            $category = Category::where('slug', $slug)->first();
            if(!$category){return abort(404);}
            $post = $category->posts;
        }
        else {
            ///$comments = Comment::count();

            $post = POST::all();

//            $comments = Comment::where('post_id', $id)->get();
        }
        return view('blogs', ['posts'=> $post]);
    }


    public function editview($id){
        $post = POST::find($id);

        $categories = Category::all();
        $tags = Tag::all();
        return view('edit', ['posts'=> $post, 'categories' => $categories, 'tags'=>$tags]);
    }

    public function single($id){
        $post = POST::find($id);

        return view('single', ['posts'=> $post]);
    }

    public function show(){
        $post = POST::all();
        return view('blogs', ['post'=> $post]);
    }

    public function addComment(Request $request){


        $comment = new Comment();
        $comment->post_id = $request->post_id;
        $comment->user_id = Auth::user()->id;
        $comment->comment = $request->comment;
        $comment->save();
        return redirect()->back();
        //return redirect('list');
    }
    public function addReply(Request $request){
        $comment = new Comment();
        $comment->post_id = $request->post_id;
        $comment->user_id = Auth::user()->id;
        $comment->parent_id = $request->parent_id;
        $comment->comment = $request->reply;
        $mytime = Carbon::now();
        $comment->date = $mytime->toDateTimeString();
        $comment->save();
        return redirect()->back()->with('message', 'Your reply was added!');
    }

    public function removeReply(Request $request){
      //  dd($request->id);
        $comment = Comment::where('id',$request->id)->delete();
        return redirect()->back()->with('message', 'Comment removed!');
    }

    public function manageAttachment($imageData){
        $mainFolder = 'uploaded-files/';
        if(!is_dir($mainFolder . $imageData['folder_name']) && !mkdir($concurrentDirectory = $mainFolder . $imageData['folder_name'], 0777, true) && !is_dir($concurrentDirectory)) {
            throw new \RuntimeException(sprintf('Directory "%s" was not created', $concurrentDirectory));
        }
        $file = ($imageData['returnType'] === 'request')?$imageData['data']->file($imageData['request_name']):$imageData['data'];

        if ($file) {
            $name = $imageData['file_name'] . '-' . time() . '.' . $file->clientExtension();
            $file->move($mainFolder . $imageData['folder_name'], $name);

            if ($imageData['returnType'] === 'request') {
                $imageData['data']->request->add([$imageData['request_name_new'] => $mainFolder . $imageData['folder_name'] . '/' . $name]);
                return $imageData['data'];
            }else{
                return $mainFolder.$imageData['folder_name'].'/'.$name;
            }
        }
        return $imageData['data'];
    }

}
