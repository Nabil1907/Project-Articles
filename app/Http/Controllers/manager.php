<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Comment;
use App\User;
use App\Like;
use App\Best_article;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use DB;


class manager extends Controller
{
   public function add_articles(Request $request) 
    { 
       if(Auth::check()){
      if($request->isMethod('POST'))
    	{
        $request->validate([
        'title' => 'required|max:50',
        'body' => 'required',
        'image' => 'required | mimes:jpeg,jpg,png | max:2048',
        ]);
        $article = new Article(); 
        $article->title    = $request->input('title');
        $article->body     = $request->input('body');
        $article->section  = $request->input('section');
        $article->user_id  = Auth::user()->id;
        $image    = $request->file('image'); 
        $new_name = rand().'.'.$image->getClientOriginalExtension();
        $image->move(public_path("image/tmp"),$image);
        $article->image    = $request->file('image');
        $article->save();
        { 
          $article = Article::all(); 
          $arr = array('article' =>$article); 
          return view('view',$arr);
        }
        }
     	 else 
       return view('AddArticle');
      } 
         else
        {
        return view('auth.login');
        }
    }
//$table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

    public function view(Request $request)
    {
     if(Auth::check())
     {
     if($request->isMethod('POST')){ 
      Best_article::where('article_id',$request->article_id)->delete();
      Like::where('article_id',$request->article_id)->delete();
      Comment::where('article_id',$request->article_id)->delete();
      DB::table('articles')
      ->where('id',$request->article_id)
      ->delete();
     $article = Article::all(); 
     $arr = array('article' =>$article);     return view('view',$arr);

     }
     else
     {
     $article = Article::all(); 
     $arr = array('article' =>$article); 
     return view('view',$arr);
     }

     }
     else
      return view('auth.login');
    
    }

    public function read(Request $req , $id)
    {
    if($req->isMethod('POST')) 
        {

        $com = new Comment(); 
        $com->body      = $req->input('body');
        $com->article_id= $id; 
        $com->user_name  = Auth::user()->name;  
        $com->save();
       
        } 
   
         $art = Article::find($id);
         $arr = array('article' => $art ); 
         return view('read', $arr );
          
    }


    public function edit_profile()
    { 
    return view('edit_profile',array('user'=>Auth::user())); 
    }


    public function update_account(Request $request)
    {
     if($request->isMethod('POST')){
     $user        =  Auth::user(); 
     if(!empty($request->name) ){
     if(ctype_alpha($request->name)) 
     $user->name = $request->input('name');
    else
    {
    $errors = "The Name must be string "; 
         return view('edit_profile',array('user'=>Auth::user()),compact('errors'));

    }
     
     }
     if(!empty($request->file('image')))
     {
     $image       = $request->file('image'); 
     $new_name    = time().'.'.$image->getClientOriginalExtension();
     $image->move(public_path("image/avatars"),$new_name);
     $user->image =  $new_name; 
     }
     //password 
     if(!empty($request->gender))
     {
      $user->gender = $request->gender ; 
     }
     if(!empty($request->new_pass)&&!empty($request->Retype_pass))
     { 
      if(Hash::check($request->current_pass, $user->password)){
     if($request->new_pass == $request->Retype_pass)
     {
      if(strlen($request->new_pass) > 5)
      $user->password = Hash::make($request->new_pass);
      else
      {
      $errors="The new & The retype pass must be at least 6 characters";
     return view('edit_profile',array('user'=>Auth::user()),compact('errors'));

      }
     }
     else
     {
     $errors="The new pass and retype pass must match";
     return view('edit_profile',array('user'=>Auth::user()),compact('errors'));

     }
     }
    else 
     { 
     $errors="The Current password is wrong";
     return view('edit_profile',array('user'=>Auth::user()),compact('errors'));


        }     
                }
     
     $user->save(); 
     return view('edit_profile',array('user'=>Auth::user())); 
     
     }
    }

    public function viewprofile($id)
    {
    
    $user    = User::all()->where('id',$id);
    return view('profile',compact('user'));
       
    }

    public function like(Request $request)
    {
     $like_s = $request->like_s;
     $article_id =$request->article_id;

     //know the value of like 

     $like = DB::table('likes') 
     ->where('article_id',$article_id)
     ->where('user_id',Auth::user()->id)
     ->first();
    
     if(!$like) //create new like 
     { 
       $new_like = new Like();
       $new_like->user_id   = Auth::user()->id ; 
       $new_like->article_id= $article_id;
       $new_like->like      = 1 ; 
       $new_like->save();

       $is_like = 1 ; 
       $change_like = 0;
     }
     else if($like->like ==1) //delete like 
     {
      DB::table('likes')
      ->where('article_id',$article_id)
      ->where('user_id',Auth::user()->id)
      ->delete();

      $is_like = 0 ; 
  $change_like = 0;

     }
     else if($like->like  ==0) //delete dislike 
     {
      DB::table('likes')
       ->where('article_id',$article_id)
       ->where('user_id',Auth::user()->id)
       ->update(['like'=> 1] );

       $is_like = 1 ; 
       $change_like =1;

     }
    
    $response = array(
    'is_like' =>$is_like,
    'change_like' =>$change_like,
  
    );

    return response()->json($response,200);
    }

  public function dislike(Request $request)
    {
     $like_s = $request->like_s;
     $article_id =$request->article_id;

     //know the value of like 

     $dislike = DB::table('likes') 
     ->where('article_id',$article_id)
     ->where('user_id',Auth::user()->id)
     ->first();
    
     if(!$dislike) //create new like 
     { 
       $new_like = new Like();
       $new_like->user_id   = Auth::user()->id ; 
       $new_like->article_id= $article_id;
       $new_like->like      = 0 ; 
       $new_like->save();

       $is_dislike = 1 ; 
       $change_like=0;

     }
     else if($dislike->like == 0) //delete like 
     {
      DB::table('likes')
      ->where('article_id',$article_id)
      ->where('user_id',Auth::user()->id)
      ->delete();

      $is_dislike = 0 ;
      $change_like=0;
 

     }
     else if($dislike->like  == 1) //delete dislike 
     {
      DB::table('likes')
       ->where('article_id',$article_id)
       ->where('user_id',Auth::user()->id)
       ->update(['like'=> 0] );

       $is_dislike = 1 ; 
       $change_like =1;

     }
    
    $response = array(
    'is_dislike' =>$is_dislike,
    'change_like' =>$change_like,
  
    );

    return response()->json($response,200);
    }

    public function statistics()
    { 
      $users = DB::table('users')->count();
      $articles = DB::table('articles')->count();
      $likes = DB::table('likes')->count();
      $comments = DB::table('comments')->count();
     

      $most_comments = User::withCount('likes')
      ->orderBy('likes_count','desc')
      ->first(); 

     return view('statistics',compact('users','articles','likes','comments','most_comments') );

    }

    public function best(Request $request)
    { 
      $article_id = $request->article_id; 
      $best = DB::table('best_articles')
      ->where('article_id',$article_id)
      ->where('user_id',Auth::user()->id)
      ->first(); 
      
      if(!$best)
      {
      $new_best = new Best_article(); 
      $new_best->user_id = Auth::user()->id; 
      $new_best->article_id = $article_id ; 
      $new_best->value = 1 ; 
      $new_best->save(); 
      $is_best     = 1; 
      }
     else if($best->value == 1)
      {
     DB::table('best_articles')
       ->where('article_id',$article_id)
       ->where('user_id',Auth::user()->id)
        ->update(['value'=> 0] );

       $is_best = 0;
        }
    else if($best->value == 0)
      {
     DB::table('best_articles')
       ->where('article_id',$article_id)
       ->where('user_id',Auth::user()->id)
        ->update(['value'=> 1] );
        $is_best = 1 ;

      }
      $response = array(
    'is_best' =>$is_best,
    );
  
    return response()->json($response,200);

    }    

    public function view_best_articles()
    {
     if(Auth::check())
     {
     $article = Article::all();
     $arr = array('article' =>$article); 
     return view('best_articles',$arr);
     }
     else
     {
     return view('auth.login');
     } 


    }
    public function contact()
    {
    return view('contact');
    } 
    public function arts()
    {

    $article = Article::all()->where('section','arts');
    return view('section.arts',compact('article'));

    }
    public function business()
    {

    $article = Article::all()->where('section','business');
    return view('section.business',compact('article'));

    }
    public function sport()
    {

    $article = Article::all()->where('section','sport');
    return view('section.sport',compact('article'));

    }
    public function history()
    {

    $article = Article::all()->where('section','history');
    return view('section.history',compact('article'));

    }public function politics()
    {

    $article = Article::all()->where('section','politics');
    return view('section.politics',compact('article'));

    }
    public function science()
    {

    $article = Article::all()->where('section','science');
    return view('section.science',compact('article'));

    }
    public function sex()
    {

    $article = Article::all()->where('section','sex');
    return view('section.sex',compact('article'));

    }
    public function crime()
    {

    $article = Article::all()->where('section','crime');
    return view('section.crime',compact('article'));

    }
    public function tech()
    {

    $article = Article::all()->where('section','tech');
    return view('section.tech',compact('article'));

    }
    public function world()
    {

    $article = Article::all()->where('section','world');
    return view('section.world',compact('article'));

    }
  
}

