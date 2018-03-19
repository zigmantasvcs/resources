<?php
  /**
   *
   */
  class UserService implements iOperations
  {
    function __construct()
    {
      # code...
    }

//---------------------------------CREATE---------------------------------------
    public function create($user)
    {
        // patikriname ar user objektas ne null
        if($user == null){
          $response = new Response(3, "User parametras null", null);
          return $response;
        }

        // pasiimame prisijungimo prie duomenu bazės objektą
        $conn = ConnectionFactory::GetConnection();

        // patikriname ar prisijungimo objektas nėra null
        if($conn == null){

          $response = new Response(
            4,
            "Nepavyko prisijungti prie duomenų bazės",
            null);

          return $response;
        }

        $query =
        "INSERT INTO users (
          username,
          password,
          name,
          surname,
          birthday,
          created,
          updated)
        VALUES (?, ?, ?, ?, ?, NOW(), NOW())";

        if($stmt = $conn->prepare($query)){

          $stmt->bind_param("sssss",
            $username,
            $password,
            $name,
            $surname,
            $birthday
          );

          $username = $user->username;
          $password = $user->password;
          $name = $user->name;
          $surname = $user->surname;
          $birthday = $user->birthday;

          if($stmt->execute()){
            $response = new Response(0, "OK", null);
            return $response;
          }
          else{
            $response = new Response(1, "Problemos paleidžiant skriptą", null);
            return $response;
          }
        }
        else{
          $response = new Response(2, "MySQL sintaksės klaida", null);
          return $response;
        }
    }

//---------------------------------READ---------------------------------------
    public function read($username=null)
    {
      $conn = ConnectionFactory::GetConnection();

      if($conn == null){
        return new Response(4, "Nepavyko prisijungti prie duomenų bazės", null);
      }

      $query =
        "SELECT
          name, surname, username, birthday, password
        FROM
          users
        WHERE username=?";

      if($stmt = $conn->prepare($query)){

        $stmt->bind_param("s", $username1);

        $username1 = $username;

        if($stmt->execute()){

          $stmt->bind_result($name, $surname, $username, $birthday, $password);

          $stmt->fetch();

          return new User($name, $surname, $username, $password, $birthday);
        }
        else {
          return new Response(1, "Problemos paleidžiant skriptą", null);
        }
      }
      else{
        return new Response(2, "MySQL sintaksės klaida", null);
      }
    }


    public function update($user)
    {
      # code...prisijungimo prie db logika ir atnaujinimas
    }

    public function delete($username)
    {
      # code...prisijungimo prie db logika ir panaikinimas
    }

  }

 ?>
