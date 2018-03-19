<?php
  session_start();
  require_once "loader.php";

  try{
    $expenseService = new ExpenseService();

    $expense=get_expense($_POST); // perduodam asociatyvini masyva

    $response = $expenseService->create($expense);

    echo json_encode($response);
  }
  catch(Exception $e){
    $response = new Response(3, "Nenumatyta klaida. ", null);
    echo json_encode($response);
  }

  function get_expense($post)
  {
    if(!isset($post["amount"])){
      return null;
    }
    if(!isset($post["description"])){
        return null;
    }
    if(!isset($_SESSION["username"])){

      return null;
    }
    if(!isset($post["date"])){
      return null;
    }

    return new Expense(
      $post["amount"],
      $post["date"],
      $post["description"],
      $_SESSION["username"]
    );
  }

 ?>
