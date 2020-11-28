<!doctype html>
<html lang="de">
<head>
<title>Setup like buttons</title>
<style>
form{
    width:400px;
    margin:0 auto;
    padding:10px;
}
form label,form input{
    width:100%;
}
label{
    text-decoration:underline;
}
input{
    margin-bottom:10px;
}
h1{
    text-decoration:underline;
}
</style>
</head>
<body>
<div id="setupcontainer">
<form id="install" name="eingabe" action="setupdatei.php" method="post">   
     <h1>Setup starten</h1>
     <label>Datenbank Host:  </label> 
     <input type="text" id="dbhost" name="dbhost" class="input_feld">
     <label>Datenbank Name:  </label> 
     <input type="text" id="dbname" name="dbname" class="input_feld">
     <label>Datenbank User:   </label> 
     <input type="text" id="dbuser" name="dbuser" class="input_feld">
     <label>Passwort:   </label> 
     <input type="text" id="dbpw" name="dbpw"  class="input_feld">
     <label>Like Button 1   </label> 
     <input type="text" name="like1"  value="Wie fanden sie den Lockdown ?" class="input_feld">
     <label>Like Button 2  </label> 
     <input type="text" name="like2"  value="Wie finden sie den Lockdown Like" class="input_feld">   
     <label>Tabellen Prefix  </label> 
     <input type="text" name="pref"  value="like_buttons_" class="input_feld">    
     <input type="submit" class="buttonstyle" value="Setup Starten">
     <h5>Es wird eine mysql.php Datei erstellt.</h5>
</form>
</body>
</html>
