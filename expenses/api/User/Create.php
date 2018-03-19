<?php
  require_once "loader.php";

  $userService = new UserService(); // sukurimas user service objektas

  $user=get_user($_POST); // perduodam asociatyvini masyva, gauname user objektą

  $response = $userService->create($user); // paduodame user objekta create metodui, metodas grazina Response objekta

  echo json_encode($response); // Response objekca convertuojame i json ir isspasudiname

// funkcija skirta validuoti asociatyvini masyva ir sukurti User objekta
  function get_user($post)
  {
    if(!isset($post["username"])){
      return null;
    }
    if(!isset($post["password"])){
      return null;
    }
    if(!isset($post["name"])){
      return null;
    }
    if(!isset($post["surname"])){
      return null;
    }
    if(!isset($post["birthday"])){
      return null;
    }

    return new User(
      $post["name"],
      $post["surname"],
      $post["username"],
      password_hash($post["password"], PASSWORD_DEFAULT), // slaptazodis uzhashuojamas
      $post["birthday"]
    );
  }

 ?>
