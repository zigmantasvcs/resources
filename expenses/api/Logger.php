<?php
  /**
   * funkcijos paskirtis įrašyti logą į duomenų bazės lentelę events
   */
  class Logger
  {
    public static function create_db_log($file, $line, $message){

      $conn = ConnectionFactory::GetConnection();

      if($conn == null){
        create_file_log("Prisijungimo prie duomenų bazės klaida. ".$conn->connect_error, "/logs/db_logs.txt");
      }

      $query =
        "INSERT INTO events
          (created, file, line, message)
        VALUES
          (NOW(), ?, ?, ?))";

      if($stmt = $conn->prepare($query)){

        $stmt->bind_param(
          "sss",
          $file,
          $line,
          $message);

          if(!$stmt->execute()){
            create_file_log("Paleidžiant MySql skriptą įvyko klaida. ".$conn->error, "/logs/db_logs.txt");
          }
      }
      else{
        self::create_file_log("Klaida MySql skripte. ".$conn->error, "/logs/db_logs.txt");
      }
    }

    /**
     * funkcijos paskirtis įrašyti į egzistuojantį failą tekstą. arba sukurti naują failą ir įrašyti tekstą
     * su jau paruoštu datos ir laiko formatu. funkcija naudojama logui įrašyti.
     */
    public static function create_file_log($text, $file = null){

      if($file == null){
        $file = "/logs/log.txt";
      }

      $fh = fopen($file, "a");

      // jungiama data laikas dabartinis, tekstas, ir eilutės pabaigos simboliai,
      ///kurių dėka naujas įrašas bus terpiamas į naują eilutę.
      $text = self::get_date()." :: ".$text.PHP_EOL;

      fputs($fh, $text) or die();

      fclose($fh);
    }

    /**
     * generuojamas ir grąžinamas dabartinis data ir laikas pagal tam tikrą formatą.
     *
     */
    private function get_date(){
      $d = new DateTime();
      return $d->format('Y-m-d H:i:s.u');
    }

  }


 ?>
