<?php
  /**
   * CRUD operations
   */
  interface iOperations
  {
    public function create($object);
    public function read($id = null);
    public function update($object);
    public function delete($id);
  }
 ?>
