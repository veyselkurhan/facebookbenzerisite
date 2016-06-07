<body bgcolor='87ff63' text='000066' style="font-family:cursive">
<table align='center' border='5' cellpadding='5'><tr> <td colspan="2"><a href="http://www.BannerFans.com"><img src="http://imagizer.imageshack.com/img907/7662/OipCKW.jpg" border="0" width="728" height="120" alt="BannerFans.com" /></a></td> </tr>
<form method="GET" >

<tr><td>Post Title:</td><td><input type="text" name="PosTitle"></td></tr>
<tr><td>Post Detail:</td><td><textarea name="PostDetail" cols="40" rows="5"></textarea></td></tr>
<tr><td colspan="2" align="center"><input type="submit" name="send" value="send message"></td></tr>

</form>

<?php
session_start();
  
    $userID=$_SESSION["userID"];
try{
   $db = new PDO("mysql:host=localhost;dbname=facebook",'root','');
   
  }catch(PDOException $e){
    echo $e->getMessage();}

$cek=$db->query("select *  from Post where userID='$userID' order by dati desc  ");
 echo "<tr><td colspan='2' align='center'><u>Last Posts</u></td></tr>";
foreach($cek as $al){ 
    
    echo "<tr><td>title: <strong>".$al["postTitle"]."</strong><br /> post: ".$al["postDetail"]."\t</td><td>".$al["dati"]."</td></tr>";}
if(isset($_GET["send"]))
{
$posTitle=$_GET["PosTitle"];
$postDetail=$_GET["PostDetail"];
    
  $sql=("insert into Post (postTitle,postDetail,userID,dati) values (:t,:d,:u,:da) ;");
   $query=$db->prepare($sql);
   
       $result= $query->execute(array(":t"=>$posTitle,":d"=>$postDetail,":u"=>$userID,":da"=>date('Y-m-d H:i:s')));
       
       
       if ($result){echo "<tr><td colspan='2' align='center'>Post gönderildi.</td></tr>";}
       else echo "<tr><td colspan='2' align='center'>Post gitmeyi ya, garip bi sorun oldu.</td></tr>";
}
echo "</table>";
?>
</body>