<?php
if(file_exists('mysql.php')){
   header('Location: like.php');
   exit;
}
?>
<html>
<head>
     <style>
     pre{
        font-size:20px;
        font-weight:900;
     }
     </style>
</head>
<body>
     <h1>Setup Anleitung</h1>
     <p>Öffne die Datei <a href="like.php">like.php</a></p>
     <p>Falls noch kein Setup erstellt worden ist öffnet sich die Setupdatei</p>
     <p> Gebe dann die Datenbank Verbindungsdaten an, bei Prefix kannst du dir ggf einen anderen aussuchen ,
     oder einfach auf Likes stehen lassen.
     <p> Bei den Likes Buttons kannst du eine Frage stellen , zb wie fanden sie den Lockdown ?</p>
     <p>Nach den klick auf Setup Starten können sie die <a href="like.php">like.php</a>  wieder aufrufen und der Button ist erstellt</p>
     <p>Unter <a href="admin.php">admin.php</a> können sie weitere Button erstellen oder bearbeiten</p>
     <P>Um einen Button auf einer seite einzubinden nehmen sie Bitte die Id des Button und binden den Code so ein</p>
     <pre>
     &lt;?php 
     $id=2;
     require('include.php'); 
     ?&gt;
     </pre>
<small>Mfg basti1012</small>
<p> Bewi problemen mich bitte Privat anschreiben</p>
</body>
</html>
