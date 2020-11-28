<?php 
include('mysql.php');
if (!$conn) {
     die("Error connecting to database: " . mysqli_connect_error($conn));
     exit();
}
$info='';
if(isset($_POST['kill'])){
    $action_kill = mysqli_real_escape_string($conn, $_POST['kill']);
}
if(isset($_POST['new_like'])){
    $action_new = mysqli_real_escape_string($conn, $_POST['new_like']);
}
if(isset($_POST['edit'])){
    $action_edit = mysqli_real_escape_string($conn, $_POST['edit']);
}
if(isset($_POST['text'])){
    $action_text = mysqli_real_escape_string($conn, $_POST['text']);
}
if (isset($action_new)) {
     $dat=date("d.m.Y | H:i");
     $query3="INSERT INTO `".$pref."posts` (`text`) VALUES ('$action_new')";
     $result = mysqli_query($conn,$query3)  or die ("MySQL-Error: " . mysqli_error($conn)); 
     if($result){
          $info.="Neuen Button erstellet <br>";
     }else{
           $info.="<div class='error'>Fehler beim erstellen von neuen eintrages </div>";
     }
}
if (isset($action_kill)) {
     $query3="DELETE FROM `".$pref."posts` WHERE `id`='$action_kill'";
     $result = mysqli_query($conn,$query3)  or die ("MySQL-Error: " . mysqli_error($conn)); 
     if($result){
          $info.="Neuen User eingetragen <br>";
     }else{
           $info.="<div class='error'>Fehler beim erstellen von neuen eintrages </div>";
     }
}
if (isset($action_edit) and isset($action_text)) {
     $query3="UPDATE `".$pref."posts` SET `text`='$action_text'  WHERE `id`='$action_edit'";
     $result = mysqli_query($conn,$query3)  or die ("MySQL-Error: " . mysqli_error($conn)); 
     if($result){
          $info.="Like Button bearbeitet <br>";
     }else{
           $info.="<div class='error'>Fehler beim bearbeiten</div>";
     }
}
?>
<!doctype html>
<html lang="de">
<head>
<title>Like Button einstellungen</title>
<style>
main{
    max-width:500px;
    width:95%;
    padding:15px;
    overflow:hidden;
    margin:0 auto;
    border:1px solid black;
    border-radius:10px;
    box-shadow:5px 5px 5px black;
}
table{
    width:100%;
    border-collapse:collapse;
    border:1px solid black;
}
td,th{
    border:1px solid black;
}
table th{
    background:lightgrey;
    border-bottom:2px solid black;
}
form{
    width:100%;
}
textarea{
    width:100%;
    margin:0 auto;
    height:200px;
}
h1{
   margin:0 auto;
   width:100%;
   text-align:center;
   padding:10px 0;
   text-decoration:underline;
}
</style>
</head>
<body>
<h1>Einstellungen Like Buttons</h1>
<main>
<?php
if (isset($action_edit) and !isset($action_text)) {
     $query3="SELECT * FROM `".$pref."posts`  WHERE `id`='$action_edit'";
     $result = mysqli_query($conn,$query3)  or die ("MySQL-Error: " . mysqli_error($conn)); 
     if (mysqli_num_rows($result) == 1) {
          $out=mysqli_fetch_array($result);
          echo "<form method='POST'><input type='hidden' name='edit' value='$action_edit'><textarea name='text'>$out[1]</textarea><input type='submit' value='button Updaten'></form>";
     }else{
          echo "<div class='error'>Fehler beim bearbeiten</div>";
     }
}else{
     echo "<p>$info</p>";
     echo "<table><tr><th>Id</th><th>Like Text</th><th></th><th></th></tr><tbody>";
$sql = "SELECT * FROM `".$pref."posts`";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
     while($out=mysqli_fetch_array($result)){
 echo "<tr>
 <td>$out[0]</td>
 <td>$out[1]</td>
 <td><form method='post'><input type='hidden' name='kill' value='$out[0]'><button type='submit'><img src='delete.png'></form></td>
  <td><form method='post'><input type='hidden' name='edit' value='$out[0]'><button type='submit'><img src='edit.png'></form></td>
 </tr>";
     }
}else{
    echo "no Inhalt";
}
echo "</tbody></table>";
echo "<form method='POST'>
      <label>Neuen Button erstellen</label><br>
      <textarea maxlength='1000' name='new_like'></textarea>
      <input type='submit' value='Neuen Button erstellen'>
      </form>";
}
?>
</body>
</html>
