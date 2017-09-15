<?php
/**
 * @author
 * Created by victor.
 * A.I. engineer & Software developer
 * javafolabi@gmail.com
 * On 01 06, 2017 @ 6:50 PM
 * Copyright victor © 2017. All rights reserved.
 */

namespace App\Libs\Classes;

use App\Controllers\_ErrorController;

class Database
{

  # !- Functions are organized with the CRUD format

  private $conn;
  private $status;
  public $success;

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
   * Returns columns matching specified criteria
   *
   * @param $table
   * @param $field
   * @param $value
   * @return bool|\PDOStatement
   * @internal param $id
   */
  public function select($table, $field, $value)
  {
    return $this->query("SELECT * FROM " . $table . "WHERE {$field} = :${field}", [$field => $value]);
  }

  /**
   * Selects records
   * @param $table
   * @param null $limit
   * @return array
   */
  public function selectAll($table, $limit = null)
  {
    if ($limit) $result = $this->query("SELECT * FROM {$table} LIMIT {$limit}");
    else $result = $this->query("SELECT * FROM {$table}");
    return ($result && $result->rowCount() > 0) ? $result->fetchAll() : [];
  }

  /**
   * Returns all fields where primary key matches foreign key
   *
   * @credits Victor I. Afolabi
   * @param $table1 string The first table
   * @param $table2 string The second table
   * @param $pk string The primary key field
   * @param $fk string The foreign key field
   * @return bool|\PDOStatement
   */
  public function innerJoinAll($table1, $table2, $pk, $fk)
  {
    return $this->query("SELECT * FROM {$table1} INNER JOIN {$table2} ON $pk = $fk");
  }

  /**
   * Inner join with WHERE clause
   *
   * @credits Victor I. Afolabi
   * @param $table1 string The first table
   * @param $table2 string The second table
   * @param $pk string the primary key
   * @param $fk string the foreign key
   * @param $field string specific field to select from
   * @param $value string value of the field
   * @return bool|\PDOStatement
   */
  public function innerJoin($table1, $table2, $pk, $fk, $field, $value)
  {
    return $this->query("SELECT * FROM `{$table1}` INNER JOIN `{$table2}` ON `{$table1}`.`$pk` = `$fk` WHERE $field = :{$field}",
      [$field => $value]);
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
    return (bool)$q->fetchColumn();
  }

  /**
   * Returns a specific column from a table, given another column value
   *
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

  /**
   * Updates a row in a table
   * @param $table
   * @param $bindings
   * @param $field
   * @param $record
   * @return bool|\PDOStatement
   * @internal param $id
   */
  public function update($table, $bindings, $field, $record)
  {
    $structure = "";
    foreach ($bindings as $key => $value)
      $structure .= $key . "=:" . $key . ", ";
    $structure = rtrim($structure, ", ");
    $bindings[$field] = $record;
    $result = $this->query("UPDATE " . $table . " SET {$structure} WHERE {$field} = :{$field}", $bindings);
    return $result;
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

}
