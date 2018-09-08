@extends('layouts.app')
@section('content')

<div class="container">

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
	 <form action="AddArticle" method="POST" enctype="multipart/form-data">
	 	@csrf
	 	<div class="form-group"> 
	 		<label for="usr">Title: </label>
	 		<input type="text" name="title" class="form-control">
        @if ($errors->has('title'))
         <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('title') }}</strong>
         </span>
       @endif
	    	</div>
           <br>
	      <label for="usr">Section: </label>
	 	  <select name="section" class="col-md-4 control-label">
                                     <option value="arts">Arts</option>
                                     <option value="business">Business</option>
                                     <option value="sport">Sport</option>
                                     <option value="history">History</option>
                                     <option value="politics">Politics</option>
                                     <option value="science">Science</option>
                                     <option value="sex">Sex</option>
                                     <option value="crime">Crime</option>
                                     <option value="tech">Tech</option>
                                     <option value="world">World</option>             
           </select>
           <br>
           <br>
           <label for="usr">Image: </label>
	 	       <input type="file" name="image" id="image">
           @if ($errors->has('image'))
             <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('image') }}</strong>
           </span>
          @endif
           <br>
           <br>
	 	    
        <div> 
        <label for="usr">Body: </label>
	 		  <textarea rows="4" cols="50" name="body" class="form-control">
       
	 		</textarea>
        @if ($errors->has('body'))
             <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('body') }}</strong>
           </span>
          @endif
	 	</div>
	 </br> 
	 <input type="submit" value="Add New"/>
	</form>
</div>
@endsection