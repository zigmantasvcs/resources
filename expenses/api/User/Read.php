<?php
  session_start();
  require_once "loader.php"; // uzkrauname klases
  $userService = new UserService(); // sukuriame UserService objekta

  $form_user = get_user($_POST); // sukuriame User objekta is gato $_post asociatyvinio masyvo

  $user = $form_user->username; // is objekto pasiimame tik username, nes tik jo mums reikia duomenims is db paimti, username db yra unikalus

  $database_user = $userService->read($user); // paduodame username (user) serviso metodui read ir mums grazina User objekta is duomenu bazes

  if($database_user == null){ // pasitikriname ar vartotojo objektas ne null grąžintas, jei null, grąžiname klaidos pranešimą
    $response = new Response(1, "Prisijungimo klaida", null);
    echo json_encode($response);
  }
  else if(password_verify($form_user->password, $database_user->password)){ // pasitikriname ar gautas slaptažodis iš db atitinka įvestą formoje
    $_SESSION["name"] = $database_user->name;
    $_SESSION["surname"] = $database_user->surname;
    $_SESSION["username"] = $database_user->username;
    header("Location: ../../index.php"); // nukreipiame į pagrindinį
  }

  // metodas skirtas duomenims is asociatyvinio post masyvo surinkti ir sudeti į User objekta
  function get_user($post){
    if(!isset($post["username"])){
      return null;
    }

    if(!isset($post["password"])){
      return null;
    }
    // onjektas kuriamas tik su vartotojo vardu ir slaptazodziu, nes mums tiek ir tereikia siam atvejui, nuskaitymui
    return new User(
      null,
      null,
      $post["username"],
      $post["password"],
      null
    );
  }
 ?>
