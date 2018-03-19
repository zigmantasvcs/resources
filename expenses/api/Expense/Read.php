<?php
  session_start();
  require_once "loader.php";
  $expenseService = new ExpenseService();

  $form_expense=get_expense($_POST); // perduodam asociatyvini masyva. kad gautume formos reiksmes Expense objekto pavidalu, realiai siuo atveju tik username paduodamas, bet galima praplesti, taip sukuriant filtra

  $database_expenses = $expenseService->read($form_expense); // paduodame Expense objekta, o read metodas grazina irasus

// jeigu nieko negrazina grazinam klaidos pranesima
  if($database_expenses == null){
    $response = new Response(1, "Prisijungimo klaida", null);
    echo json_encode($response);
  }
  else {
    // kitu atveju grazinam Expenses masyva ideta i json
    $response = new Response(0, "OK", $database_expenses);
    echo json_encode($response);
  }

// metodas kuris validuoja $_post asociatyvini masyva ir grazina Expense objekta.
  function get_expense($post){

    if(!isset($_SESSION["username"])){
      return null;
    }
    return new Expense(
      null,
      null,
      null,
      $_SESSION["username"]
    );
  }
 ?>
