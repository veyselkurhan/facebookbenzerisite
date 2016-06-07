
<body bgcolor='87ff63' text='000066' style="font-family:cursive"> 
<table align='center' border='5' cellpadding='5'><tr> <td colspan="2"><a href="http://www.BannerFans.com"><img src="http://imagizer.imageshack.com/img907/7662/OipCKW.jpg" border="0" width="728" height="90" alt="BannerFans.com" /></a></td> </tr>
</form>
<form method="get" >
<
GroupName<input type="text" name="name" >
<input type="submit" name="create" value="create group">

<?php
session_start();
$userID=$_SESSION["userID"];
try{
   $db = new PDO("mysql:host=localhost;dbname=facebook",'root','');
    echo "<tr><td colspan='2' align='center'>Veritabaný Baðlantýsý Baþarýyla Saðlandý.</td></tr>";
  }catch(PDOException $e){
    echo $e->getMessage();}
if(isset($_GET["create"]))

if ($_GET["name"]!=null){
    {$name=$_GET["name"];
     $sql=("insert into Create_Group (groupName,creatorID)values (:name,:id)");
   $query=$db->prepare($sql);
   
       $result= $query->execute(array(":name"=>$_GET["name"],":id"=>$userID));
       
          if($result){
     echo "<tr><td>group oluþturuldu</td></tr>";
   }else{
     echo "<tr><td>Bu isim kullanýlýyor.</td></tr>";
}

       
$cek=$db->query("select groupID  from Create_Group where groupName='$name'");
if($cek!=null){
foreach($cek as $al){
       $sql=("insert into Join_Group (groupID,memberID)values (:name,:id)");
   $query=$db->prepare($sql);
   
   
       $result= $query->execute(array(":name"=>$al["groupID"],":id"=>$userID));
}
 

       echo "<tr><td>group oluþturuldu</td></tr>";
   }else{
     echo "<tr><td>Bu isim kullanýlýyor.</td></tr>";
}

    
}
}


?>
</body>