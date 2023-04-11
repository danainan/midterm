<?php

class userModel {
    public $email;
    public $password;
    public $repeatPassword;
    
    public $conn;


    function set_data($email, $password, $repeatPassword ){
        $this->email = $email;
        $this->password = $password;
        $this->repeatPassword = $repeatPassword;
    
    }

    function set_connection($conn){
        $this->_conn = $conn;
    }


    function get_data($primary_key){

        $sql = "SELECT * FROM accounts where email = '".$primary_key."'";
        return $this->_conn-query($sql);
    }


    
    function search($email){
        $sql = "SELECT * FROM accounts where email like '%".$email."%'";
        return $this->_conn->query($sql);
    }

    function insert(){
        $sql = "INSERT INTO `accounts`(`email`,`password`,`repeatPassword`)
        VALUE('".$this->email."','".$this->password."','".$this->repeatPassword."')";
        return $this->_conn->query($sql);
    }

    function update(){
        $sql = "UPDATE `accounts` SET `email`='".$this->email."',`password`='".$this->password."',`repeatPassword`='".$this->repeatPassword."' ";
        return $this->_conn->query($sql);
    }

    function delete($primary_key){
        $sql = "DELETE FROM `accounts` WHERE `email`='".$primary_key."'";
        return $this->_conn->query($sql);
    }
}


?>