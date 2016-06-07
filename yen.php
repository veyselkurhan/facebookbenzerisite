
<body bgcolor='87ff63' text='000066' style="font-family:cursive">
<table align='center' border='5' cellpadding='5'><tr> <td colspan="2"><a href="http://www.BannerFans.com"><img src="http://imagizer.imageshack.com/img907/7662/OipCKW.jpg" border="0" width="728" height="90" alt="BannerFans.com" /></a></td> </tr>
<form method="get" >

<tr><td>Find Your Friend:</td><td><input type="text" name="friend"  ></td></tr>
<tr><td></td><td><input type="submit" name="find" value="ara" ></td></tr>

</form>
<form method="get" >

<tr><td colspan='2'><input type="submit" name="post" value="yazýlarým"></td></tr>

</form>

</form>
<form method="get" >

<tr><td colspan='2'><input type="submit" name="post2" value="arkadaþlarýn yazýlarý"></td></tr>

</form>
</form>
<form method="get" >

<tr><td colspan='2'><input type="submit" name="grup" value="üye olduðum gruplar"></td></tr>

</form>
</form>
<form method="get" >

<tr><td colspan='2'><input type="submit" name="create" value="create group"></td></tr>

</form>
<?php
session_start();
$userID=$_SESSION["userID"];
$friend=array();
try{
   $db = new PDO("mysql:host=localhost;dbname=facebook",'root','');
    echo "<tr><td colspan='2' align='center'>Veritabaný Baðlantýsý Baþarýyla Saðlandý.</td></tr>";
  }catch(PDOException $e){
    echo $e->getMessage();}
    $cek=$db->query("select * from Relationship r ,Users u 
    where  u.userID=r.friendID and r.userID='$userID' ");
    if ($cek!=null){
        echo "<tr><td colspan='2' align='center'><b>Arkadaþlarým Listesi</b></td></tr>";
        
    foreach($cek as $al){
echo  "<tr><td colspan='2' align='center'>".$al["name"]." ".$al["sname"]." (".$al["mail"].")"."</td></tr>";       
        }
    }
      $cek=$db->query("select * from Relationship r ,Users u 
    where  u.userID=r.userID and r.friendID='$userID' ");
      if ($cek!=null){
    foreach($cek as $al){
echo "<tr><td colspan='2' align='center'>".$al["name"]." ".$al["sname"]." (".$al["mail"].")"."</td></tr>";       
        }
    }
   
foreach($cek as $al){
$jb=$al["job"];
$hschool=$al["highschool"];
$university=$al["university"];
$rela=$al["RelationshipStatus"];
$ja=false;
$ha=false;
$ua=false;
$rl=false;
}
$b=false;
$ar=$db->query("select * from Friend_Consent where receiverID='$userID'");
echo "<form method='GET'>";
foreach($ar as $ar1){ if ($ar1!=null)echo "<tr><td colspan='2'><input type='submit' name='as' value='arkadaslýk Ýsteði var'></td></tr>";$b=true;}




if ($b==false)
echo "<tr><td colspan='2'><input type='submit' name='as' value='arkadaslýk Ýsteði yok '></td></tr>";

echo "</form>";

   
   
if(isset($_GET['as'])){
    if ($_GET['as']=="arkadaslýk Ýsteði var") echo  '<script type="text/javascript" language="javascript"> 
window.open("ekle.php"); window.close("inde.php");
</script>'; 
    
}


?>

<form>
<tr><td colspan="2" align='center' >  <br />s </td></tr>
<tr><td colspan="2" align='center'> <b>Update your profil!</b> </td></tr>
<form method="GET">
<tr><td>job:</td><td><input type="text" name ="job" value="<?php if($jb!=null){ $ja=true; echo $jb ;}?>"></td></tr>
<tr><td>highschool:</td><td><input type="text" name ="highSchool" value="<?php if($hschool!=null)  echo $hschool;?>" <?php if($hschool!=null) { $ha=true;?> disabled <?php   } ?>></td></tr>
<tr><td>university:</td><td><input type="text" name="university" value="<?php if($university!=null) echo $university;?>" <?php if($university!=null){$ua=true ;?> disabled <?php } ?>></td></tr>
<tr><td>RelationshipStatus:</td><td><input type="text" name="Relationship" value="<?php if( $rela!=null){$rl=true; echo $rela;}?>" ></td></tr>
<tr><td></td><td><input type="submit" name="sender" value="update"></td></tr>
</table>
</form>
</form>
<?php
if(isset($_GET['sender'])){
   if($ja==false) {
$job=$_GET["job"];$sql=$db->query("update Profil set job='$job' where userID='$userID'" );}
   if($ha==false) {
$school=$_GET["highSchool"];$sql=$db->query("update Profil set highschool='$school' where userID='$userID'" );}
   if($ua==false) {
$university=$_GET["university"];$sql=$db->query("update Profil set university='$university' where userID='$userID'" );}


 if($rl==false){
    
 
$relation=$_GET["Relationship"];$sql=$db->query("update Profil set RelationshipStatus='$relation' where userID='$userID'" );

}
}






if(isset($_GET['find'])){
   $_SESSION["friend"]= $_GET["friend"];echo  '<script type="text/javascript" language="javascript"> 
window.open("Arkadasekle.php"); 
</script>'; }
if(isset($_GET['post'])){
    echo  '<script type="text/javascript" language="javascript"> 
window.open("Post.php"); 
</script>'; 
    
}
if(isset($_GET['post2'])){
    echo  '<script type="text/javascript" language="javascript"> 
window.open("FPost.php"); 
</script>'; 
    
}
if(isset($_GET['create'])){
 echo  '<script type="text/javascript" language="javascript"> 
window.open("create.php"); 
</script>'; 
    
 
 }
if(isset($_GET['grup'])){
 echo  '<script type="text/javascript" language="javascript"> 
window.open("group.php"); 
</script>';     
 
 }
?>