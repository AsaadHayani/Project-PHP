<?php

class Task
{
  public $id;
  public $name;
  public $email;
  public $phone;
  public $course;
  public $created;

  // FUNCTION FOR VIEW ALL ELEMENTS
  public static function getTasks($conn)
  {
    $query = "SELECT * FROM tasks";
    $result = $conn->query($query);
    return $result->fetchAll(PDO::FETCH_ASSOC);
  }

  // FUNCTION FOR VIEW DETAILS ONE ELEMENT
  public static function getTask($conn, $id)
  {
    $query = "SELECT * FROM tasks WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindValue(":id", $id, PDO::PARAM_INT);
    $stmt->setFetchMode(PDO::FETCH_CLASS, "Task");
    if ($stmt->execute()) {
      return $stmt->fetch();
    }
  }

  // FUNCTION FOR INSERT
  public function insertTask($conn)
  {
    $query = "INSERT INTO tasks(`name`, `email`, `phone`, course, created)
      VALUES(:name, :email, :phone, :course, :created)";
    $stmt = $conn->prepare($query);
    $stmt->bindValue(":name", $this->name, PDO::PARAM_STR);
    $stmt->bindValue(":email", $this->email, PDO::PARAM_STR);
    $stmt->bindValue(":phone", $this->phone, PDO::PARAM_STR);
    $stmt->bindValue(":course", $this->course, PDO::PARAM_STR);
    $stmt->bindValue(":created", $this->created, PDO::PARAM_STR);
    if ($stmt->execute()) {
      $this->id = $conn->lastInsertId();
      return true;
    }
  }

  // FUNCTION FOR UPDATE
  public function updateTask($conn)
  {
    $query = "UPDATE tasks SET name = :name, email = :email, phone = :phone,
    course = :course, created = :created
    WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindValue(":id", $this->id, PDO::PARAM_INT);
    $stmt->bindValue(":name", $this->name, PDO::PARAM_STR);
    $stmt->bindValue(":email", $this->email, PDO::PARAM_STR);
    $stmt->bindValue(":phone", $this->phone, PDO::PARAM_STR);
    $stmt->bindValue(":course", $this->course, PDO::PARAM_STR);
    $stmt->bindValue(":created", $this->created, PDO::PARAM_STR);
    return $stmt->execute();
  }

  // FUNCTION FOR DELETE
  public function deleteTask($conn)
  {
    $query = "DELETE FROM tasks WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindValue(":id", $this->id, PDO::PARAM_INT);
    return $stmt->execute();
  }
}
