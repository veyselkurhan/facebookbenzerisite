<html>
<head>

<title>
facebook
</title>

</head>
<body bgcolor='87ff63' text='000066' style="font-family:cursive"> 
<table align='center' border='5' cellpadding='5'><tr> <td colspan="2"><a href="http://www.BannerFans.com"><img src="http://imagizer.imageshack.com/img907/7662/OipCKW.jpg" border="0" width="728" height="90" alt="BannerFans.com" /></a></td> </tr>
<div id='forms1'>
<form>

<form  method="GET">
<tr> <td colspan="2" align='center'> <b> Giriþ yap </b></td> </tr>
<tr> <td align='center'>mail:</td><td><input type="text" name="mail" required /></td> </tr>
<tr> <td align='center'>password:</td><td><input type="password" name="password" required /></td> </tr>
<tr><td></td>  <td><input type="submit" name="login" value="login" required /></td> </tr>
    <input type="hidden" name="step" value="2" />

  </form>
    </div>

<div id="forms2">
<form>

<form action="" method="GET"  >

<input type="hidden" name="step" value="1" required  />
<tr> <td colspan="2" align='center'> <b> Üyeliðin yok mu? Kayýt ol!</b></td> </tr>
<tr> <td align='center'>isim:</td><td><input type="text" name="ad" required ></td> </tr>
<tr> <td align='center'>soyad:</td><td><input type="text" name="soyad" required ></td> </tr>
<tr> <td align='center'>mail:</td><td><input type="text" name="mail" required ></td> </tr>
<tr> <td align='center'>password:</td><td><input type="password" name ="password" required ></td> </tr>
<tr> <td></td> <td><input type="submit" name="sender" required value="sign in" ></td> </tr>

</form>
</div>

<?php
  if(isset($_GET['login'])){
  
   $mail=$_GET["mail"];
$password=$_GET["password"];
try{
   $db = new PDO("mysql:host=localhost;dbname=facebook",'root','');
    echo "<tr> <td colspan='2' align='center'> <b> Veritabaný baðlantýsý baþarýyla saðlandý.</b></td> </tr>";
  }catch(PDOException $e){
    echo $e->getMessage();}
$cek=$db->query("select *  from Users where mail='$mail' and sifre='$password'");//uye tablosundki tüm verileri çek 

foreach($cek as $al){//foreach $cekte ki tüm verileri tek tek $al deðiþkenine aktaracak
echo $al["name"]."<br />";//Aldýðýmýz verilerden isim sütununu ekrana bastýrdýk

	$cek=$db->query("select userID  from Users where mail='$mail'" );
				}
foreach($cek as $al){
   $userID=$al['userID'];

    session_start();
    $_SESSION["userID"]=$userID;}
		$veri_miktar=$cek->rowCount();
        
        if( $veri_miktar==1){   
     echo  '<script type="text/javascript" language="javascript"> 
window.open("yen.php"); 
</script>'; }
}
if (isset ($_GET['sender'])){
    
    $name=$_GET["ad"];
       $mail=$_GET["mail"];
          $sname=$_GET["soyad"];
          $password=$_GET["password"];
try{
   $db = new PDO("mysql:host=localhost;dbname=facebook",'root','');

    echo "<tr> <td colspan='2' align='center'> <b> Veritabaný baðlantýsý baþarýyla saðlandý.</b></td> </tr>";
  }catch(PDOException $e){
    echo $e->getMessage();
  }
date_default_timezone_set('Europe/Istanbul');



 $sql=("insert into Users (name,sname,mail,registerDate,sifre) values (:name,:sname,:mail,:date,:password) ;");
   $query=$db->prepare($sql);
   
       $result= $query->execute(array(":name"=>$name,":sname"=>$sname,":mail"=>$mail,":date"=>date('Y-m-d H:i:s'),":password"=>$password));
       $cek=$db->query("select userID  from Users where mail='$mail'" );

     foreach($cek as $al)
   $userID=$al['userID'];
   if($result){
     echo "<tr> <td colspan='2' align='center'> <b> User baþarýyla eklendi.</b></td> </tr>";
   }else{
     echo "<tr> <td colspan='2' align='center'> <b> Bir sorun oluþtu.</b></td> </tr>";
   }
 

     
     
   if($result){
     
   }else{
     echo "<tr> <td colspan='2' align='center'> <b> Bir sorun oluþtu..</b></td> </tr>";
   }
 $sql=("insert into Profil (userID) values (:userID);");
   $query=$db->prepare($sql);
 $result=$query->execute((array(":userID"=>$userID)));
  if($result){
    
   }else{
     echo "<tr> <td colspan='2' align='center'> <b> Bir sorun oluþtu..</b></td> </tr>";
   }
}
echo "</table>"

?>

</body>



