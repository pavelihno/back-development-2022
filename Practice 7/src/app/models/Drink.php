<?php

class Drink extends Model
{
    public static function get_data()
    {
        $sql_connection = mysqli_connect("db", "root", "12345678", "appDB");

        return $sql_connection->query("SELECT * FROM drinks");
    }
}