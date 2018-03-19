<?php
  class Expense{
    public $amount, $expenseDate, $description, $username;

    public function __construct($amount, $expenseDate, $description, $username)
    {
      $this->amount = $amount;
      $this->expenseDate = $expenseDate;
      $this->description = $description;
      $this->username = $username;
    }
  }
 ?>
