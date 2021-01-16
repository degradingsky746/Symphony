<?php 
class AdminAlbum{
    private $con;
    private $path = "../assets/images/artwork/";
    //private $path = "~/Downloads/pi/";
    public function __construct($con)
    {
        $this->con = $con;
    }
    public function save($title,$artist,$genre){
    $title = ucwords($title);
    $artworkPath = "assets/images/artwork/" . basename($_FILES["artworkPath"]["name"]) ;
    return $this->insert($title,$artist,$genre,$artworkPath);
    }
    private function insert($title,$artist,$genre,$artworkPath){
        //toast("inside insert");
        //toast($artworkPath);
        if($this->uploadFile()){
            return $query = mysqli_query($this->con,"INSERT INTO albums (title,artist,genre,artworkPath) VALUES('$title','$artist','$genre','$artworkPath')");
        }
        else return false;

    }
    private function uploadFile(){
        $newPath = $this->path . basename( $_FILES["artworkPath"]["name"]) ;
        //toast($newPath);
        //toast($_FILES["artworkPath"]["tmp_name"]);
        if(move_uploaded_file($_FILES["artworkPath"]["tmp_name"],$newPath)){
            //toast("done");
            return true;
        }
        else{
            return false;
        }
    }
}
?>