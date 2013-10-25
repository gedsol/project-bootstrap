<?php
/*
 * sasajos klase su DB
 */
class Database {

    private $mysqli;

    function __construct(){
        $this->open_database_connection();
    }
    public function open_database_connection()
    {
        $this->mysqli = new mysqli("localhost", "root", "root", "Gallery");
    }

    public function close_database_connection()
    {
        mysqli_close($this->mysqli);
    }

    function add_image($path, $name, $taken, $description)
    {
        $query = "INSERT INTO Images SET path='".$path."', name='".$name."', taken='".$taken."', description='".$description."';";
        mysqli_query($this->mysqli,$query);
    }

    function get_images()
    {
        $result = mysqli_query($this->mysqli,"SELECT path FROM Images");
        $images = array();
        while($var = $result->fetch_row()[0]){$images[]=$var;}
        return $images;
    }
    function get_images_ids()
    {
        $result = mysqli_query($this->mysqli,"SELECT imageId FROM Images");
        $imageIds = array();
        while($var = $result->fetch_row()[0]){$imageIds[]=$var;}
        return $imageIds;
    }

    function delete_image($id)
    {
        $query = "SELECT path FROM Images WHERE imageId=".$id.";";
        $result = mysqli_query($this->mysqli, $query);
        unlink("/var/www".mysqli_fetch_row($result)[0]);
        $query = "DELETE FROM Images WHERE imageId=".$id.";";
        mysqli_query($this->mysqli, $query);
    }
}