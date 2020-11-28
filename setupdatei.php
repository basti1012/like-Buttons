<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <title>Installation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet">
</head>
<body>
<?php
   if(empty($_POST['dbhost']) OR empty($_POST['dbpw']) OR  empty($_POST['dbname']) OR  empty($_POST['dbuser'])){
        echo "<div class='error'>Bitte fülle alle Felder aus</div>";
        echo "<a href='javascript:history.back()'>Zurück</a>";
   }else{
        $zeile='<?php $pref="'.$_POST['pref'].'";$conn = mysqli_connect("'.$_POST['dbhost'].'", "'.$_POST['dbuser'].'", "'.$_POST['dbpw'].'", "'.$_POST['dbname'].'"); ?>';
        file_put_contents("mysql.php", $zeile);
        include('mysql.php');
        if(empty($_POST['pref'])){
            $pref='likes';
        }else{
            $pref=mysqli_real_escape_string($conn,$_POST['pref']);
        }
        
        $query4 = "CREATE TABLE `".$pref."ip`(
        `id` int(10) NOT NULL auto_increment,
        `date` datetime ,
        `ip` varchar(120) NOT NULL default '',    
        PRIMARY KEY (`id`)
        ) ENGINE=MyISAM AUTO_INCREMENT=1;";
        $result = mysqli_query($conn,$query4)  or die ("MySQL-Error bei ".$pref."ip: " . mysqli_error($conn)); 
        if($result){
             echo "Tabelle post erstellt <br>";
        }else{
             echo "<div class='error'>Fehler beim erstellen der Tabelle posts  </div>";
        }
        
        $query1="CREATE TABLE IF NOT EXISTS `".$pref."posts` (
               `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
               `text` text NOT NULL
               ) ENGINE=InnoDB DEFAULT CHARSET=latin1";
        $result = mysqli_query($conn,$query1)  or die ("MySQL-Error bei ".$pref."posts: " . mysqli_error($conn)); 
        if($result){
             echo "Tabelle post erstellt <br>";
        }else{
             echo "<div class='error'>Fehler beim erstellen der Tabelle posts  </div>";
        }
        
        $query2="CREATE TABLE IF NOT EXISTS `".$pref."rating_info` (
            `user_id` varchar(110)  NOT NULL,
            `post_id` int(11) NOT NULL,
            `rating_action` varchar(30) NOT NULL,
             CONSTRAINT UC_rating_info UNIQUE (user_id, post_id)
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1";
        $result2 = mysqli_query($conn,$query2)  or die ("MySQL-Error bei ".$pref."rating_info: " . mysqli_error($conn)); 
        if($result2){
             echo "Tabelle rating_info erstellt <br>";
        }else{
             echo "<div class='error'>Fehler beim erstellen der Tabelle rating_info  </div>";
        } 
        if(!empty($_POST['like1']) and empty($_POST['like2'])){
                $button1=mysqli_real_escape_string($conn,$_POST['like1']);
                $query3="INSERT INTO `".$pref."posts` (`id`, `text`) VALUES (1, '$button1')";      
        }elseif(empty($_POST['like1']) and !empty($_POST['like2'])){
                $button2=mysqli_real_escape_string($conn,$_POST['like2']);  
                $query3="INSERT INTO `".$pref."posts` (`id`, `text`) VALUES (1, '$button2')";
        }elseif(!empty($_POST['like1']) and !empty($_POST['like2'])){
                $button1=mysqli_real_escape_string($conn,$_POST['like1']); 
                $button2=mysqli_real_escape_string($conn,$_POST['like2']);  
                $query3="INSERT INTO `".$pref."posts` (`id`, `text`) VALUES (1, '$button1'),(2, '$button2')";
        }

        $result = mysqli_query($conn,$query3)  or die ("MySQL-Error: " . mysqli_error($conn)); 
        if($result){
             echo "Like Buttons wurden erstellt <br>";
        }else{
             echo "<div class='error'>Fehler beim erstellen der Like buttons </div>";
        }
        echo "<br><a href='like.php'>Zum Like button</a>";
}
?>
</body>
</html>
