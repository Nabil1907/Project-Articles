@extends('layouts.app')
@section('content')  
<link rel="stylesheet" type="text/css" href="../css/sheet.css">
<link rel="stylesheet" href="../font-awesome-4.7.0/css/font-awesome.min.css">
<div class="container">
@foreach($user as $user)

<div  style="  width:350px ; height: 700px; background: #e6e6e6 ;  box-shadow: 10px 10px 5px grey; margin-left: 350px ">  
          <img src="/image/avatars/{{$user->image}}" style="width: 320px ; height: 300px ; border-radius: 50% ;  ">
          <h3 style="margin-left: 130px; margin-top: 20px;"> {{$user->name}}</h3> 
          <br> 
          <h4> Email : {{$user->email}}</h4>
          <h4> Gender : {{$user->gender}}</h4>
          <br>
          <br> 
          <div style="margin-left: 70px;">
          <i class="fab fa-facebook" style="font-size: 40px; border-radius: 50px; "></i>
          <i href="#" class="fa fa-twitter" style="font-size: 40px; border-radius: 50px; "></i>
          <i href="#" class="fa fa-google" style="font-size: 40px; border-radius: 50px; "></i>
          <i href="#" class="fa fa-instagram" style="font-size: 40px; border-radius: 50px; "></i>
        </div>
          <br> 
          <br> 

</div>    
@foreach($user->article as $art) 
 <div style="background-color: #f2f2f2; width:820px ; height: 500px ; margin:30px; margin-left:200px;">
          <div style=" font-size: 22px; margin-left: 20px;">
            <a href="profile/{{$art->user_id}}" >
           <img src="/image/avatars/{{$user->image}}" style="width:50px; height:50px;  border-radius:50% ; margin-top: 10px; margin-bottom: 15px;">
                                      {{$art->user->name}}
            </a> 
          </div>
        
    <div class="thumbnail" style="margin-left: 10px;" >
      
      
       <a href='{{ "/read/".$art->id }}'>
        <img src="/image/{{$art->image}}" class="img-thumbnail" >
        <div class="caption">
        </div>
      </a>
      <span class="post__tit    le__highlight"><h4> Title : 
        {{$art->title}} </h4>

      </span>
       <p class="ArticleBody">
            {{ str_limit(strip_tags($art->body), 50) }}

        </p>

            @if (strlen(strip_tags($art->body)) > 50)
              ... 
             
              
              <a href='{{ "/read/".$art->id }}' >Read More<i class="fas fa-angle-right"></i></a>
              <br>
            @endif
       @php 
         $like_count = 0 ;
         $dislike_count = 0 ;

         $like_statu = "btn-secondry";
         $dislike_statu = "btn-secondry";
       @endphp 


       @foreach($art->like as $like)
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
       @if(Auth::user()->id==$art->user->id)
      <form enctype="multipart/form-data" action="/view" method="POST"> 
      {{ csrf_field() }}
      <input type="hidden" name="article_id" value="{{$art->id}}">
      <input type="submit" name="Delete" value="Delete" class="btn btn-danger" style="float: right;  ">
      </form>
        @endif 
        <button  type="button" data_like="{{$like_statu}}" article_id ="{{$art->id}}_l" class="like btn {{$like_statu}}">
          <i class="far fa-thumbs-up"></i>
 
          like
         <b> <span class="like_count">{{$like_count}}</span></b>
        </button>
        <button  type="button" data_like="{{$like_statu}}" article_id ="{{$art->id}}_d" class="dislike btn {{$dislike_statu}}">Dislike
          <i class="far fa-thumbs-down"></i>

         <b><span class="dislike_count">{{$dislike_count}}</span></b>
        </button> 

          <p style="margin-left: 660px;"> 
          {{$art->created_at}}
        </p>
    
    </div>
    </div>
    <br/>
@endforeach
@endforeach
 </div>

@endsection