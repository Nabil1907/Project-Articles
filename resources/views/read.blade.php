@extends('layouts.app')
@section('content')
<link rel="stylesheet" type="text/css" href="../css/sheet.css">
<link rel="stylesheet" href="../font-awesome-4.7.0/css/font-awesome.min.css">
<div class="container" id="nop" style="margin-bottom: 50px;">
  <div class="row">
    <div class="col-sm-8" style="background-color: #f0f0f5">
         @php 
       $is_best ="defult_star" ;
       $value   = "Add Best"; 

    foreach($article->best_articles as $best)
    if($best->user_id==Auth::user()->id && $best->value==1)
    {
      $is_best = "best_star";
      $value   = "Remove Best";
     } 
    @endphp 

      <button  type="button"  class="best btn btn-defult"  article_id ="{{$article->id}}" style="float: right; font-size: 20px; margin: 10px;"> 
       <i class="{{$is_best}} fa fa-star"></i> {{$value}} 
        </button>
       <div style=" font-size: 22px; margin-left: 20px;">
            <a href="profile/{{$article->user_id}}" >
           <img src="/image/avatars/{{ $article->user->image}}" style="width:50px; height:50px;  border-radius:50% ; margin-top: 10px; margin-bottom: 15px;">
                                      {{$article->user->name}}
            </a> 
          </div> 
      <div class="thumbnail">
         <span class="post__title__highlight"><h4> Title : 
         {{$article->title}} </h4>
         </span>
          <img src="/image/{{$article->image}}" class="img-thumbnail" >
          <div class="caption">
               <p class="ArticleBody"> Body: 
               {{$article->body}}
               </p>
          </div>
           @php 
         $like_count = 0 ;
         $dislike_count = 0 ;

         $like_statu = "btn-secondry";
         $dislike_statu = "btn-secondry";
       @endphp 


       @foreach($article->like as $like)
       @php
       
       if($like->like==1)
       { $like_count++; }

       if($like->like==0)
       { $dislike_count++; }
       
       if(Auth::check())
       {
        if($like->like ==1 &&  $like->user_id == Auth::user()->id )
         $like_statu = "btn-success";

       if($like->like ==0 &&  $like->user_id == Auth::user()->id )
         $dislike_statu = "btn-danger";
       } 
       
       @endphp
       @endforeach
       @if(Auth::user()->id==$article->user->id)
      <form enctype="multipart/form-data" action="/view" method="POST"> 
      {{ csrf_field() }}
      <input type="hidden" name="article_id" value="{{$article->id}}">
      <input type="submit" name="Delete" value="Delete" class="btn btn-danger" style="float: right;  ">
      </form>
        @endif 
        <button  type="button" data_like="{{$like_statu}}" article_id ="{{$article->id}}_l" class="like btn {{$like_statu}}">
          <i class="far fa-thumbs-up"></i>
 
          like
         <b> <span class="like_count">{{$like_count}}</span></b>
        </button>
        <button  type="button" data_like="{{$like_statu}}" article_id ="{{$article->id}}_d" class="dislike btn {{$dislike_statu}}">Dislike
          <i class="far fa-thumbs-down"></i>

         <b><span class="dislike_count">{{$dislike_count}}</span></b>
        </button> 
       <p style="margin-left: 660px;"> 
          {{$article->created_at}}
        </p>
         
    
    </div>
     
      <table class="table table-striped" style="margin-top: 10px;">
          <tr> 
            <td>Comments</td>
          </tr>
          @foreach($article->comment as $c)
          <tr>
            <td > 
             <h4>  {{$c->user_name}} </h4>       
              {{$c->body}} 
              <p style="float: right"> {{$c->created_at}}</p>     
            </td>
            </tr>
          @endforeach
            </table>
       <form action="/read/{{$article->id}}" method="POST">
        @csrf
        <div class="form-group">
          <textarea rows="4" cols="70" name="body" ></textarea>
        </div>
       <br> 
       <input type="submit" value="Add comment" class="btn btn-primary" style="margin-bottom: 10px;">
      </form>
       </div>
    </div>
  </div>


@include('layouts.footer')

@endsection