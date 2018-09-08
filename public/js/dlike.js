/*alert('nn');
$(".like").on('click',function()
{
 var like_s          = $(this).attr('data_like'); 
 var article_id      = $(this).attr('article_id'); 
 article_id = article_id.slice(0,-2);

 $.ajax({

   type: 'POST',
   url: url,
   data:{like_s:like_s,article_id:article_id,_token:token},

   success: function(data){
		    

	/*
	if(data.is_like == 1)
    $('*[article_id="'+ article_id +'_l"]').removeClass('btn-secondry').addClass('btn-success');
    $('*[article_id="'+ article_id +'_d"]').removeClass('btn-danger').addClass('btn-secondry');
    
   

	if(data.is_like == 0)
    $('*[article_id="'+ article_id + '_l"]').removeClass('btn-success').addClass('btn-secondry');
	

   } 
  

 });
});
/*
$(".dislike").on('click',function()
{
 var like_s          = $(this).attr('data_like'); 
 var article_id      = $(this).attr('article_id'); 
 article_id = article_id.slice(0,-2);
 //alert(article_id);


 $.ajax({
   
   type: 'POST',
   url: url_dis,
   data:{like_s:like_s,article_id:article_id,_token:token},

   success: function(data){
	//alert(data.is_like);
/*
	if(data.is_dislike == 1)
    $('*[article_id="'+ article_id + '_d"]').removeClass('btn-secondry').addClass('btn-danger');
    $('*[article_id="'+ article_id + '_l"]').removeClass('btn-success').addClass('btn-secondry');
	
	if(data.is_dislike == 0)
    $('*[article_id="'+ article_id + '_d"]').removeClass('btn-danger').addClass('btn-secondry')
	
   } 
  

 });
});