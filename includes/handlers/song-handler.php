<?php
if(isset($_POST["SongUpload"])){
if($_POST['title'] != ""   && $_POST['minutes'] !="" && $_POST['seconds'] !="" && $_FILES['song']['name']!="" && $_POST['artist']!="0"&& $_POST['album']!="0" && $_POST['genre']!="" && $_POST['lyrics'] !=""){
        $title = $_POST['title'];
        $artist = $_POST['artist'];
        $album = $_POST['album'];
        $genre = $_POST['genre'];
        $minutes = $_POST["minutes"];
        $seconds = $_POST["seconds"];
        $lyrics = $_POST['lyrics'];
        toast("not setting");
        $titleQuery = mysqli_query($con,"SELECT title FROM songs WHERE title='$title'");
        if(mysqli_num_rows($titleQuery)>0){
            toast("checking file name");
            toast("title already exist");
            exit();
        }
        if(ceil($_FILES["song"]['size'] /(1024 * 1024)) > 20){
            toast("checking file size");
            toast("File Should not Exceed 20MB in size");
            exit();
        }

        if($adminSong->save($title,$artist,$album,$genre,$minutes,$seconds,$lyrics)){
            echo"<script>
            M.toast({html: 'new Song Added' ,classes:'blue'})
            </script>";
        }else{
            echo"<script>M.toast({html: 'Failed' ,classes:'red'})</script>";
        }
} else{
   toast("Please Fill all Details");
}
}





function toast($msg){
    echo "<script> 
    M.toast({html: '". $msg ."',classes:'red'})
    </script>";

}


?>