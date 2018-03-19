<?php
  session_start();
?>
<nav>
  <div class="nav-wrapper">
    <a href="#!" class="brand-logo">Logo</a>
    <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
    <ul class="right hide-on-med-and-down">
      <?php
        require "navlogic.php";
       ?>
    </ul>
    <ul class="side-nav" id="mobile-demo">
      <?php
        require "navlogic.php";
       ?>
    </ul>
  </div>
</nav>
