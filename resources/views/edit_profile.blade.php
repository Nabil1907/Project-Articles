@extends('layouts.app')
@section('content')  
 
<div class="container" id ="set" style="background-color: #f2f2f2;">
     <div style="margin: 50px ;border-bottom:2px solid #bfbfbf;">

@if(strlen($errors) >2)
    <div class="alert alert-danger">
        <ul>
        
                <li>{{ $errors }}</li>
        </ul>
    </div>
@endif 

     <h1 class="text-center"> Edit my profile </h1> 
     </div>
     <div style="margin: 50px ; text-align: center;">
                <h1>{{ $user->name }}'s Profile</h1>
 
     </div>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
        <form enctype="multipart/form-data" action="/edit_profile" method="POST">

            <label for="usr"><h3>Full Name  : </h3>
             </label>
           <input type="text" name="name" class="form-control" id="name" value="{{$user->name}}" style="margin-left: 150px; margin-top: -50px ;margin-bottom: 50px ">
           <label for="usr"><h3>Profile Photo : </h3>
             </label>
            <img src="/image/avatars/{{ $user->image }}" style="width:150px; height:150px; margin-left: 50px ;border :2px solid #bfbfbf;">
                <input type="file" name="image">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
        
                <br> 
                <br>
                <div> 
                    <label for="usr"><h3> Password  : </h3> <br>  
                    <div class="row">
                    <label class="col-md-4 " style="font-size: 18px">Current password </label>
                    <label class="col-md-4" style="font-size: 18px">New password </label>
                    <label class="col-md-4" style="font-size: 18px" >Retype password </label>
                </div>
                    <input type="password" name="current_pass">
                    <input type="password" name="new_pass" >
                    <input type="password" name="Retype_pass">
                </div> 

                <br> 
                <br> 

                  <label for="name" class="col-md-4 control-label"> 
                    <h3> Gender </h3>
                 </label>

                 <select name="gender" class="col-md-4 control-label" value = "{{$user->gender}}">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                                
             <input type="submit" class="pull btn btn-info" value="submit" style="margin-left: 450px; margin-top: 100px; margin-bottom: 50px;">
            </form>
        </div>
        </div>

   
</div>
@endsection