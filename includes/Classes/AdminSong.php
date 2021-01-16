<?php
class AdminSong{
private $con;
private $path = "../assets/music/";
public function __construct($con){
    $this->con = $con;
}
public function save($title,$artist,$album,$genre,$minutes,$seconds,$lyrics){
    echo "<script>console.log('saving')</script>";
    $title = ucwords($title);
    $albumOrder = $this->getAlbumOrder($album);
    $duration= $this->getDuration($minutes,$seconds);
    $songPath = "assets/music/" .basename( $_FILES["song"]["name"]) ;
    return $this->insert($title,$artist,$album,$genre,$duration,$songPath,$albumOrder,$lyrics);
}
private function insert($title,$artist,$album,$genre,$duration,$songPath,$albumOrder,$lyrics){
    echo "<script>console.log('uploading file')</script>";
    if($this->uploadFile()){
        toast("reached here");
        return  $query = mysqli_query($this->con,"INSERT INTO songs (title,artist,album,genre,duration,path,albumOrder,plays,lyrics) VALUES('$title','$artist','$album','$genre','$duration','$songPath','$albumOrder','0','$lyrics') "); 
    }
    else return false;
}
private function uploadFile(){

    $newPath = $this->path . basename( $_FILES["song"]["name"]) ;
    toast("uploading");
    if(move_uploaded_file($_FILES["song"]["tmp_name"],$newPath)){
        toast (" uploaded");
        return true;
    }
    else{
        return false;
    }    
}
private function getDuration($minutes,$seconds){
    if(strlen($seconds) < 2){
        $seconds = "0".$seconds;
    }
    return $minutes . ":" . $seconds;
}
private function getAlbumOrder($albumId){
    $albumQuery = mysqli_query($this->con, "SELECT * FROM songs WHERE album='$albumId'");
    $count = mysqli_num_rows($albumQuery);
    return $count + 1;
}
}
?>