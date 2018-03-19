<?php
  /**
   *
   */
  class ExpenseService implements iOperations
  {
    function __construct()
    {
      # code...
    }

    //---------------------------------CREATE---------------------------------------
        public function create($expense)
        {
            // patikriname ar user objektas ne null
            if($expense == null){
              $response = new Response(3, "Expense parametras null", null);
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
            "INSERT INTO expenses (
              amount,
              description,
              date,
              username)
            VALUES (?, ?, NOW(), ?)";

            if($stmt = $conn->prepare($query)){

              $stmt->bind_param("dss",
                $amount,
                $description,
                $username
              );

              $amount = $expense->amount;
              $description = $expense->description;
              $username = $expense->username;

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

        public function read($expense=null)
        {
          // patikriname ar user objektas ne null
          if($expense == null){
            $response = new Response(3, "Expense parametras null", null);
            return $response;
          }

          $conn = ConnectionFactory::GetConnection();

          if($conn == null){
            return new Response(4, "Nepavyko prisijungti prie duomenų bazės", null);
          }

          $query =
            "SELECT
              amount, description, date, username
            FROM
              expenses
            WHERE username=?";

          if($stmt = $conn->prepare($query)){

            $stmt->bind_param("s", $username1);

            $username1 = $expense->username;

            if($stmt->execute()){

              $result = $stmt->get_result();

              $expensesArray = array();

              while ($row = $result->fetch_assoc()) {
                $expense = new Expense($row["amount"], $row["date"], $row["description"], $row["username"]);
                array_push($expensesArray, $expense);
              }
              return $expensesArray;
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
