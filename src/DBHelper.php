<?php

namespace app\src;

use app\src\DBConnect;

class DBHelper {

    public static $conn;
    public $dbdata;
    public static $dbname;
    public function __construct($dbcreds)
    {
        self::$conn = new DBConnect($dbcreds);
        $this->dbdata = self::$conn->separate($dbcreds);

        self::$dbname = $this->dbdata['db'];
        

    }


    public static function all(string $table)
    {
        $query = "SELECT * FROM {$table}";
        $stmt = self::$conn->connect->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);

        return $data;
        
    }

    public static function insert(string $table, array $data)
    {
        filter_input_array(INPUT_POST, $data);

        $fields = [];
        $values = [];

        foreach($data as $key => $value) {
            array_push($fields, $key);
            array_push($values, "'$value'");
        }

        $query = 'INSERT INTO ' . $table. '('.join(',',$fields). ') VALUES ('.join(',', $values). ')';
        $result = self::$conn->connect->query($query);

        if($result){
            echo 'success';
        }else{
            echo 'failed';
        }
        
    }

}