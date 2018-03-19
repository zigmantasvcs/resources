<?php
  /**
   *
   */
  class Response
  {
    public $code, $message, $data;

    function __construct($code, $message, $data)
    {
      $this->code = $code;
      $this->message = $message;
      $this->data = $data;
    }
  }
 ?>
