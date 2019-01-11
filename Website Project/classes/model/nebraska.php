<?php

namespace Model;

class Nebraska
{
    public $users = array("ct310", "ewanlp", "logan");
    public $id;
    public $pass;
    const FILENAME = "nebraska.model";
    const file = 'user.txt';

    public function __construct($id = null, $pass = null){
      if( strpos(file_get_contents("./user.txt"),$id) !== false) {

      }
    }
    public function lAuth(){

    }
    public function save()
    {
        $data = array();
        if (file_exists(self::FILENAME)) {
            $data = unserialize(file_get_contents(self::FILENAME));
        }
        $data[$this->field_values['id']] = $this->field_values;
        file_put_contents(self::FILENAME, serialize($data));
        $this->isStored = true;
    }
}
