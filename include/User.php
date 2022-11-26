<?php

class User
{
  public $id;
  public $username;
  public $password;

  public static function auth($conn, $email, $pass)
  {
    $query = 'SELECT * FROM form WHERE email = :email';
    $stmt = $conn->prepare($query);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
    $stmt->execute();
    $user = $stmt->fetch();
    if ($user) {
      return password_verify($pass, $user->password);
    }
  }
}
