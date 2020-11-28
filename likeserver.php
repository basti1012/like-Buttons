<?php 
include('mysql.php');
$tab1='like_buttons_rating_info';
$user_id=$_SERVER['REMOTE_ADDR'];
if (!$conn) {
     die("Error connecting to database: " . mysqli_connect_error($conn));
     exit();
}

$sql = "SELECT * FROM `".$pref."ip` WHERE `ip`='$user_id'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
  	 $out=mysqli_fetch_array($result);
     $user_id=$out[0];
}else{
     $dat=date("d.m.Y | H:i");
     $query3="INSERT INTO `".$pref."ip` (`ip`,`date`) VALUES ('$user_id', NOW())";
     $result = mysqli_query($conn,$query3)  or die ("MySQL-Error: " . mysqli_error($conn)); 
     if($result){
       //    echo "Neuen User eingetragen <br>";
     }else{
        //   echo "<div class='error'>Fehler beim erstellen von neuen eintrages </div>";
     }
     $user_id=mysqli_insert_id($conn);
}

if (isset($_POST['action'])) {
    $post_id = mysqli_real_escape_string($conn, $_POST['post_id']);
    $action = mysqli_real_escape_string($conn, $_POST['action']);
    switch ($action) {
         case 'like':
         $sql="INSERT INTO `$tab1` (user_id, post_id, rating_action) 
                VALUES ($user_id, $post_id, 'like') 
         	   ON DUPLICATE KEY UPDATE rating_action='like'";
         break;
  	     case 'dislike':
           
         $sql="INSERT INTO `$tab1` (user_id, post_id, rating_action) 
               VALUES ($user_id, $post_id, 'dislike') 
         	   ON DUPLICATE KEY UPDATE rating_action='dislike'";
         break;
  	     case 'unlike':
           
	     $sql="DELETE FROM `$tab1` WHERE `user_id`='$user_id' AND `post_id`='$post_id'";
	     break;
  	     case 'undislike':
           
      	 $sql="DELETE FROM `$tab1` WHERE `user_id`='$user_id' AND `post_id`='$post_id'";
         break;
  	     default:
  		 break;
  }
  mysqli_query($conn, $sql);
  echo getRating($post_id);
  exit(0);
}


function getLikes($id){
global $tab1;
     global $conn;
     $sql = "SELECT COUNT(*) FROM `$tab1` 
  		     WHERE `post_id` = '$id' AND `rating_action`='like'";
     $rs = mysqli_query($conn, $sql);
     $result = mysqli_fetch_array($rs);
     return $result[0];
}

function getDislikes($id){
global $tab1;
  global $conn;
  $sql = "SELECT COUNT(*) FROM `$tab1` 
  		  WHERE `post_id` = '$id' AND `rating_action`='dislike'";
  $rs = mysqli_query($conn, $sql);
  $result = mysqli_fetch_array($rs);
  return $result[0];
}

function getRating($id){
  global $tab1;
  global $conn;
  $rating = array();
  $likes_query = "SELECT COUNT(*) FROM `$tab1` WHERE `post_id` = '$id' AND `rating_action`='like'";
  $dislikes_query = "SELECT COUNT(*) FROM `$tab1` 
		  			WHERE `post_id` = '$id' AND `rating_action`='dislike'";
  $likes_rs = mysqli_query($conn, $likes_query);
  $dislikes_rs = mysqli_query($conn, $dislikes_query);
  $likes = mysqli_fetch_array($likes_rs);
  $dislikes = mysqli_fetch_array($dislikes_rs);
  $rating = [
  	'likes' => $likes[0],
  	'dislikes' => $dislikes[0]
  ];
  return json_encode($rating);
}

function userLiked($post_id){
    global $conn;
    global $tab1;
    global $user_id;
    $sql = "SELECT * FROM `$tab1` WHERE `user_id`='$user_id' 
  		  AND `post_id`='$post_id' AND `rating_action`='like'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
    	return true;
    }else{
    	return false;
    }
}
function userDisliked($post_id){
    global $conn;
    global $tab1;
    global $user_id;
    $sql = "SELECT * FROM `$tab1` WHERE `user_id`='$user_id' 
  		  AND `post_id`='$post_id' AND `rating_action`='dislike'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
    	return true;
    }else{
    	return false;
    }
}

$sql = "SELECT * FROM `".$pref."posts`";
$result = mysqli_query($conn, $sql);
$posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>
