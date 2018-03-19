<?php require_once("pageparts/top.php"); ?>
<?php require_once("pageparts/nav.php"); ?>
<style>


</style>
<div class="container">
  <h1>Prisijungimas</h1>
  <section>
    <div class="row">
      <form class="col s12" action="api/user/read.php" method="post">
        <div class="row">
          <div class="input-field col s6">
            <input id="username" name="username" type="text" class="validate">
            <label for="username">Username</label>
          </div>
          <div class="input-field col s6">
            <input id="password" name="password" type="password" class="validate">
            <label for="password">Password</label>
          </div>
        </div>
        <button class="btn waves-effect waves-light" type="submit" name="action">Submit
          <i class="material-icons right">send</i>
        </button>
      </form>

    </div>
  </section>
</div>

<?php require_once("pageparts/footer.php"); ?>
<?php require_once("pageparts/bottom.php"); ?>
