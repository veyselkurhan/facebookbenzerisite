<body bgcolor='87ff63' text='000066' style="font-family:cursive">
<table align='center' border='5' cellpadding='5'><tr> <td colspan="3"><a href="http://www.BannerFans.com"><img src="http://imagizer.imageshack.com/img907/7662/OipCKW.jpg" border="0" width="728" height="90" alt="BannerFans.com" /></a></td> </tr>

<?php

session_start();
   $userID=$_SESSION["userID"];
   echo "<tr><td colspan='3'><b><center>Arkadaþlarýn Yazýlarý</center></td></tr>";
  try{
   $db = new PDO("mysql:host=localhost;dbname=facebook",'root','');

  }catch(PDOException $e){
    echo $e->getMessage();}

$cek=$db->query("select * from Relationship where userID='$userID' ");
      if ($cek!=null){ 
    foreach($cek as $al){$friendID=$al["friendID"];$cek=$db->query("select * from Post where userID='$friendID' order by dati desc ");
        foreach($cek as $al1){ $ns=$al1["userID"];
    $ce=$db->query("select name from Users where userID='$ns'");
    
  $ce1=$db->query("select sname from Users where userID='$ns'");
  foreach($ce as $a){
    foreach($ce1 as $b){
    echo "<tr>";
    echo "<td>".$a["name"]." ".$b["sname"]." (".$ns.")"."</td>";
    echo"<td><strong> title: ".$al1["postTitle"]."</strong><br /> post: ".$al1["postDetail"]."</td>";

   echo "<td>".$al1["dati"]."</td></tr>";}
        }}}
    }
    $cek=$db->query("select * from Relationship where friendID='$userID' ");
    if ($cek!=null){ 
   foreach($cek as $al){$friendID=$al["userID"];$cek=$db->query("select * from Post where userID='$friendID' order by dati desc ");
        foreach($cek as $al1){ $ns=$al1["userID"];
    $ce=$db->query("select name from Users where userID='$ns'");
  $ce1=$db->query("select sname from Users where userID='$ns'");
     foreach($ce as $a){
    foreach($ce1 as $b){
   echo " <strong> title:".$al1["postTitle"]."\n </strong";
   
    echo "post:\t".$al1["postDetail"]."\t</td><td> time:".$al1["dati"]."\t";echo $a["name"]." ".$b["sname"]." (".$ns.")".")";;}
        }}}
    }
    echo "</table>"
?>
</body>