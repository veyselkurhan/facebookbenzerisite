<body bgcolor='87ff63' text='000066' style="font-family:cursive">
<table align='center' border='5' cellpadding='5'><tr> <td colspan="2"><a href="http://www.BannerFans.com"><img src="http://imagizer.imageshack.com/img907/7662/OipCKW.jpg" border="0" width="728" height="90" alt="BannerFans.com" /></a></td> </tr>


<?php
    
  try{
   $db = new PDO("mysql:host=localhost;dbname=facebook",'root','');
    echo "<tr><td colspan='2' align='center'> Veritabaný Baðlantýsý Baþarýyla Saðlandý </td></tr>";
  }catch(PDOException $e){
    echo $e->getMessage();}

session_start();
  
    $userID=$_SESSION["userID"];
$arr=$db->query("select * from Users u,Friend_Consent f where f.senderID=u.userID and f.receiverID='$userID'");
echo "<form method ='Get'>";
foreach($arr as $al){
    $ns=$al["name"].$al["sname"]; $p=$al["senderID"];
echo "<tr><td>"."$ns.($p):</td><td><input type='checkbox' name='c[]' value='$p'></td></tr>"; }
echo "<tr><td><input type ='submit' name='ekle' value='ekle' >" ; 
echo "</td><td><input type='submit' name='reddet' value='reddet'></td></tr>";
echo"</form>";
   if (isset($_GET['ekle'])){
    $name=$_GET['c'];
   foreach($name as $al){

 $sql=("insert into Relationship (userID,friendID)values (:userID,:friendID)");
   $query=$db->prepare($sql);
   
       $result= $query->execute(array(":userID"=>$userID,":friendID"=>$al));
    

   if($result){
     echo "<tr><td>Arkadaþlýk isteði kabul edildi.</td></tr>";
   }else{
     echo "<tr><td>Bir sorun oluþtu.</td></tr>";
}
  $sql=("delete  from  Friend_Consent where senderID='$al' and receiverID='$userID'");
      $result=$db->exec($sql);
   }
}

else if(isset($_GET['reddet'])){     $name=$_GET['c'];
 foreach($name as $al){$sql=("delete  from  Friend_Consent where senderID='$al' and receiverID='$userID'");
 $result=$db->exec($sql);

echo "</table>";
    
}
}
?>