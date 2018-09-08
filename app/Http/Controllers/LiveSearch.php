<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\User;

class LiveSearch extends Controller
{
    function index()
    {
     return view('live_search');
    }

    function action(Request $request)
    {
     if($request->ajax())
     {
      $output = '';
      $query = $request->get('query');
      if($query != '')
      {
       $data = DB::table('articles')
         ->where('title', 'like', '%'.$query.'%')
         ->orWhere('body', 'like', '%'.$query.'%')
         ->orWhere('section', 'like', '%'.$query.'%')
         ->orderBy('id', 'desc')
         ->get();
         
      }
      else
      {
       $data = DB::table('articles')
         ->orderBy('id', 'desc')
         ->get();
      }
      $total_row = $data->count();
      if($total_row > 0)
      {
        '<div class="container" style=" font-size: 22px; margin-left: 20px;">  
         <div class="row"> ';
       foreach($data as $art)
       {
      $output .= '
     <a href=\'/read/'.$art->id. '\'\>
        <img src="image/' .$art->image . '" class="img-thumbnail" style="margin-left:150px;">
       
      </a>
      <span class="post__title__highlight"><h4 style="margin-left:150px;"> Title : 
        ' .$art->title . ' </h4>

      </span>
       <p class="ArticleBody" style="margin-left:150px;">
            ' .str_limit(strip_tags($art->body), 50) .'

        </p>';

            if(strlen(strip_tags($art->body)) > 50):
              $output .= '... 
             
              
              <a href=\'/read/' .$art->id . '\' style="margin-left:150px;" >Read More<i class="fas fa-angle-right"></i></a>
              <br>';
            endif; 

      '</div>';
	} '</div>';
  	
     }
      }
     else
      {
       $output = '
       <tr>
        <td align="center" colspan="5">No Data Found</td>
       </tr>
       ';
      }
      $data = array(
       'table_data'  => $output,
       'total_data'  => $total_row
      );

      echo json_encode($data);
     }
    }

