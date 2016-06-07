<body bgcolor='87ff63' text='000066' style="font-family:cursive"> 
<table align='center' border='5' cellpadding='5'><tr> <td colspan="2"><a href="http://www.BannerFans.com"><img src="http://imagizer.imageshack.com/img907/7662/OipCKW.jpg" border="0" width="728" height="90" alt="BannerFans.com" /></a></td> </tr>

<?php


 session_start();
 $frs=false;
 $grs=0;
    $friend=$_SESSION["friend"];
    $userID=$_SESSION["userID"];
 
  try{
   $db = new PDO("mysql:host=localhost;dbname=facebook",'root','');
    echo "<tr><td colspan='2' align='center'>Veritabaný Baðlantýsý Baþarýyla Saðlandý</td></tr>";
    echo "<tr><td colspan='2' align='center'><b>Arkadaþlýk Ýsteði Gönder!</b></td></tr>";
  }catch(PDOException $e){
    echo $e->getMessage();}
    
    $ce=$db->query("select count(*)  from Users where name  like '%$friend%'");
$cek=$db->query("select *  from Users where name  like '%$friend%'");


$count=0;
$arr= array();


echo "<form method ='Get'>";
foreach($cek as $al){
    if($userID!=$al["userID"]){$arr[$count]=$al["userID"];$ns=$al["name"]." ".$al["sname"]; $as=$count;$p="ad".$count;$ma=$al["mail"];
$cek=$db->query("select * from Relationship where userID='$userID' ");

      if ($cek!=null){ 
    foreach($cek as $al){
        if($al["friendID"]==$arr[$count]) $frs=true;
        }
    }
    $cek=$db->query("select * from Relationship where friendID='$userID' ");
    
      if ($cek!=null){
    foreach($cek as $al){
          if($al["userID"]==$arr[$count])$frs=true;
        }
    }

if ($frs==true)echo "<tr><td>$ns ($ma):</td><td><input type='checkbox' name='c[]' value='$arr[$count]' disabled> arkadaþýnýz</td></tr> ";
else if($frs==false)echo "<tr><td>$ns ($ma):</td><td><input type='checkbox' name='c[]' value='$arr[$count]'></td></tr>"; 
$frs= false;
}
}
$cek=$db->query("select *  from Create_Group where groupName  like '%$friend%'");
foreach($cek as $al){
    $id=$al["groupID"];
    $ce=$db->query("select *  from Join_Group where groupID  = %$id");
   
    if($ce!=null){
     foreach($ce as $al1){
    if($userID==$al1["memberID"]) $grs=$grs+1;}}
    $arr[$count]=$al["groupID"];$ns=$al["groupName"]; $as=$count;$p="ad".$count;

    

if ($grs==0)echo "<tr><td>$ns ($arr[$count]):</td><td><input type='checkbox' name='g[]' value='$arr[$count]' disabled> gruba katýlmýþsýnýz</td></tr> ";
else if($grs==false)echo "<tr><td>$ns ($arr[$count]):</td><td><input type='checkbox' name='g[]' value='$arr[$count]' > grup</td></tr>"; 
$grs= 0;

}

echo "<tr><td></td><td><input type ='submit' name='ekle' value='beðen' return $count></td></tr>" ; 
echo"</form>";


   if (isset($_GET['ekle'])){
    $name=null;
    $gname=null;
    if(isset($_GET['c']))
    $name=$_GET['c'];
      if(isset($_GET['g']))
    $gname=$_GET['g'];
    if($name!=null){
   foreach($name as $al){

 $sql=("insert into Friend_Consent (senderID,receiverID)values (:senderID,:receiverID)");
   $query=$db->prepare($sql);
   
       $result= $query->execute(array(":senderID"=>$userID,":receiverID"=>$al));
     }
     
   if($result){
     echo "<tr><td colspan='2' align='center'><b>Arkadaþlýk isteði gönderildi.</b></td></tr>";
   }else{
     echo "<tr><td colspan='2' align='center'>arkadaþlýk isteði daha önce göndermiþsiniz<b></b></td></tr>";
   }
}

    


 if($gname!=null){
 foreach($gname as $al){

 $sql=("insert into Join_Group (groupID,memberID)values (:gID,:mID)");
   $query=$db->prepare($sql);
   
       $result= $query->execute(array(":gID"=>$al,":mID"=>$userID));
     }
     
   if($result){
     echo "<tr><td colspan='2' align='center'><b>gruba katýldýnýz.</b></td></tr>";
   }else{
     echo "<tr><td colspan='2' align='center'><b></b> baþarýsýz</td></tr>";
   }
}

   echo "</table>";
}
?>
