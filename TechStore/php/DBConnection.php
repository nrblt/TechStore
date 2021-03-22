<?php


class DBConnection{
        public $servername;
        public $username;
        public $password;
        public $dbname;
        public $tablename;
        public $con;


        // class constructor
    public function __construct(
        $dbname = "Productdb",
        $tablename = "Producttb",
        $servername = "localhost",
        $username = "root",
        $password = "root"
    )
    {
      $this->dbname = $dbname;
      $this->tablename = $tablename;
      $this->servername = $servername;
      $this->username = $username;
      $this->password = $password;


        $this->con = mysqli_connect($servername, $username, $password);


        if (!$this->con){
            die("Connection failed : " . mysqli_connect_error());
        }


        $sql = "CREATE DATABASE IF NOT EXISTS $dbname";


        if(mysqli_query($this->con, $sql)){

            $this->con = mysqli_connect($servername, $username, $password, $dbname);

            if (!mysqli_query($this->con, $sql)){
                echo "Error creating table : " . mysqli_error($this->con);
            }

        }else{
            return false;
        }
    }


    public function getData(){
        $sql = "SELECT * FROM $this->tablename";

        $result = mysqli_query($this->con, $sql);

        if(mysqli_num_rows($result) > 0){
            return $result;
        }
    }

    function addCart($product_id){


        $sql = 'INSERT INTO carts(id_product) VALUES ("'.$product_id.'")';

        $this->con->query($sql);


    }
    function getById($idk){
        $sql1 = "SELECT * FROM $this->tablename where id=$idk";
        $con1= getConnection();
        $result1 = mysqli_query($con1, $sql1);
        $ans=$result1->fetch_all(MYSQLI_ASSOC);
        return $ans;
    }

    function getById2($idk){
        $sql = "SELECT * FROM $this->tablename where id=$idk";


        $result = mysqli_query($this->con, $sql);

        if(mysqli_num_rows($result) > 0){
            return $result;
        }
    }
    function removeById($idk){
        $sql1 = "delete  FROM carts where id_product=$idk";
        $con1= getConnection();
        $result1 = mysqli_query($con1, $sql1);


    }



}




