<?php 
include("./includes/includedFiles.php");
?>
<?php
$abc=4;
$songId =$_GET['id'];
$songsQuery = mysqli_query($con,"SELECT * FROM Songs WHERE id='$songId' ");
$row = mysqli_fetch_array($songsQuery);
$lyrics = $row['lyrics'];
echo "<br><br>Lyrics:<br><br>";
echo wordwrap($lyrics,25,"<br>\n");
?>