<?php
if(!file_exists('mysql.php')){
    include('setup.php');
    exit;
}
require('likeserver.php'); 
if(isset($id)){
      foreach ($posts as $post){
         if($post['id']==$id){
              $sam.=' <div class="post">'.$post['text'].'
              <div class="post-info"><i ';
                    if (userLiked($post['id'])){
                         $sam.='class="fa fa-thumbs-up like-btn"';
                    }else{ 
                         $sam.='class="fa fa-thumbs-o-up like-btn"';
                    }        
                    $sam.='data-id="'.$post['id'].'"></i>
                               <span class="likes">'.getLikes($post['id']).'</span> Like <i ';
                    if(userDisliked($post['id'])){
                         $sam.='class="fa fa-thumbs-down dislike-btn"';
                    }else{
                         $sam.='class="fa fa-thumbs-o-down dislike-btn"';
                    } 
                    $sam.='data-id="'.$post['id'].'"></i>
                    <span class="dislikes">'.getDislikes($post['id']).' </span> Dislike 
                    </div>
   	           </div>';
               echo $sam;
         }
      }
   }else{
       echo "Bitte id $id angeben";
   }
?>
