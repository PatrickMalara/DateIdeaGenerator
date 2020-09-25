<?php
class Date implements JsonSerializable {
    private $id;
    private $title;
    private $category;
    private $desc;
    private $upvotes;
    private $downvotes;
    private $latitude;
    private $longitude;
    private $address;
    
    public function __construct($id, $title, $category, $desc, $upvotes, $downvotes, $latitude, $longitude, $address){
        $this->id = $id;
        $this->title = $title;
        $this->category = $category;
        $this->desc = $desc;
        $this->upvotes = $upvotes;
        $this->downvotes = $downvotes;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->address = $address;
    }
    
    public function jsonSerialize(){
        return get_object_vars($this);
    }
    
}
?>