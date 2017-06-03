<?php
/**
 * @author
 * Created by victor.
 * A.I. engineer & Software developer
 * javafolabi@gmail.com
 * On 03 06, 2017 @ 3:52 PM
 * Copyright victor © 2017. All rights reserved.
 */


namespace App\Libs\Classes;

use App\Controllers\_ErrorController;

class Database
{

  private $conn = null;
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
   * @return array
   */
  public function selectAll($table)
  {
    $result = $this->query("SELECT * FROM {$table}");
    return ($result->rowCount() > 0) ? $result->fetchAll() : [];
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
