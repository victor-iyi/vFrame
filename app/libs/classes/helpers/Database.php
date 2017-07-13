<?php

namespace App\Libs\Classes\Helpers;

use App\Controllers\_ErrorController;

class Database
{

    private $conn;
    public $success;
    private $status;

    /**
     * Database constructor.
     */
    public function __construct()
    {
        try {
            $this->conn = new \PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8',
                DB_USERNAME, DB_PASSWORD);
            $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->success = true;
        } catch (\PDOException $e) {
            $err = new _ErrorController;
            $err->index(500, $e->getMessage());
            die();
        }
    }

    /**
     * Executes an SQL statement using PDO::prepare
     * @param $query
     * @param array|bool $bindings
     * @return bool|\PDOStatement
     */
    public function query($query, $bindings = false)
    {
        try {
            $stmt = $this->conn->prepare($query);
            if ($bindings) $stmt->execute($bindings);
            else $stmt->execute();
            $stmt->setFetchMode(\PDO::FETCH_OBJ);
            return $stmt;
        } catch (\PDOException $e) {
            return false;
        }
    }

    /**
     * Inserts data into the database.
     * @param string $table
     * @param array $bindings
     * @return bool|int
     */
    public function insert($table, $bindings)
    {
        $keys = implode(', ', array_keys($bindings));
        $named_param = ':' . implode(', :', array_keys($bindings));
        $result = $this->query("INSERT INTO {$table} ($keys) VALUES ($named_param)", $bindings);
        return $result ? (int)$this->conn->lastInsertId() : false;
    }

    /**
     * Updates a row in a table
     * @param $table
     * @param $id
     * @param $bindings
     * @return bool|\PDOStatement
     */
    public function update($table, $id, $bindings)
    {
        $structure = "";
        foreach ($bindings as $key => $value)
            $structure .= $key . "=:" . $key . ", ";
        $structure = rtrim($structure, ", ");
        $bindings['id'] = $id;
        $result = $this->query("UPDATE " . $table . " SET {$structure} WHERE id=:id", $bindings);
        return $result;
    }

  /**
   * Selects records
   * @param $table
   * @param null $limit
   * @return array
   */
    public function selectAll($table, $limit=null)
    {
        if ( $limit ) $result = $this->query("SELECT * FROM {$table} LIMIT {$limit}");
        else $result = $this->query("SELECT * FROM {$table}");
        return ($result && $result->rowCount() > 0) ? $result->fetchAll() : [];
    }

    /**
     * Deletes all entry in a table
     * @param $table
     * @return bool|\PDOStatement
     */
    public function deleteAll($table)
    {
        return $this->query("DELETE FROM {$table}");
    }

    /**
     * Deletes a row from a table
     * @param $table
     * @param $id
     * @return bool|\PDOStatement
     */
    public function delete($table, $id)
    {
        return $this->query("DELETE FROM " . $table . " WHERE id=:id", ["id" => $id]);
    }

    /**
     * Returns all columns form a row in a table
     * @param $table
     * @param $id
     * @return bool|\PDOStatement
     * */
    public function getOne($table, $id) {
        return $this->query("SELECT * FROM " .$table . "WHERE id=:id", ["id"=>$id]);
    }
    /**
     * Runs an SQL command to DROP a table
     * @param $table
     * @return bool|\PDOStatement
     */
    public function drop($table)
    {
        return $this->query("DROP TABLE {$table}");
    }

    /**
     * Returns Database connection Message
     * @return string
     */
    public function getStatusMessage()
    {
        return $this->success ? "Connection successful!" : $this->status;
    }

    /**
     * Determines if specified entry exists
     * @credit Banjo Mofesola Paul
     * @param  string $value The value to search for
     * @param  string $column The column to search under
     * @param  string $table The table to search in
     * @return bool
     */
    public function exists($value, $column, $table)
    {
        $q = $this->query("SELECT 1 FROM `$table` WHERE `$column` = :value LIMIT 1", ["value" => $value]);
        return (bool) $q->fetchColumn();
    }

    /**
     * Returns a specific column from a table, given another column value
     * @credit Banjo Mofesola Paul
     * @param string $table The table to search in
     * @param string $dis The target column whose value we're getting
     * @param string $that The known column
     * @param string $value Value of known column
     */
    public function thisFromThat($table, $dis, $that, $value)
    {
        $sql = "SELECT `$dis` FROM `$table` WHERE `$that` = :value LIMIT 1";

        $q = $this->query($sql, ['value' => $value]);
        if ($o = $q->fetchObject()) return $o->$dis;
    }

}
