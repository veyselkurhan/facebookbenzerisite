<?php
-
session_start();
$userID=$_SESSION["userID"];
$friend=array();
try{
   $db = new PDO("mysql:host=localhost;dbname=facebook",'root','');
    echo "<tr><td colspan='2' align='center'>Veritaban� Ba�lant�s� Ba�ar�yla Sa�land�.</td></tr>";
  }catch(PDOException $e){
    echo $e->getMessage();}
    $cek=$db->query("select * from Join_Group where memberID='$userID' ");
    if ($cek!=null){
        echo "<tr><td colspan='2' align='center'><b>�ye oldu�um gruplar/b></td></tr>";
          foreach($cek as $al){
echo "<tr><td colspan='2' align='center'>".$al["groupName"]."</td></tr>";  }

?>