<?php require_once("pageparts/top.php"); ?>
<?php require_once("pageparts/nav.php"); ?>
<script src="js/expense.js">

</script>
<script type="text/javascript">
  // vykdoma tik tuomet kai visas dokumentas užkrautas
  $(function(){
    readExpenses(null);
    $("#submit").on("click", function(){
      event.preventDefault();
      createExpense($("#form").serialize());
    })


    $('.datepicker').pickadate({
      selectMonths: true, // Creates a dropdown to control month
      selectYears: 15, // Creates a dropdown of 15 years to control year,
      today: 'dgd',
      clear: 'Išvalyti',
      close: 'Gerai',
      monthsFull: [ 'Sausis', 'Vasaris', 'Kovas', 'Balandis', 'Gegužė', 'Birželis', 'Liepa', 'Rugpjūtis', 'Rugsėjis', 'Spalis', 'Lapkritis', 'Gruodis' ],
      monthsShort: [ 'Sau', 'Vas', 'Kov', 'Bal', 'Geg', 'Bir', 'Lie', 'Rgp', 'Rgs', 'Spa', 'Lap', 'Gru' ],
      weekdaysFull: [ 'Sekmadienis', 'Antradienis', 'Trečiadienis', 'Ketvirtadienis', 'Penktadienis', 'Šeštadienis', 'Pirmadienis' ],
      weekdaysShort: [ 'Sek', 'Ant', 'Tre', 'Ket', 'Pen', 'Šeš', 'Pir' ],
      weekdaysLetter: ['S', 'P', 'A', 'T', 'K', 'P', 'Š', 'S'],
      closeOnSelect: false, // Close upon selecting a date,
      format: 'yyyy-mm-dd',
      firstDay: 1
    });
  })

</script>
<div class="container">
  <h1>Išlaidos</h1>
  <section>
    <div class="row">
      <form id="form" class="col s12" action="api/expense/create.php" method="post">
        <div class="row">
          <div class="input-field col s4">
            <input id="amount" name="amount" type="text" class="validate">
            <label for="amount">Suma</label>
          </div>
          <div class="input-field col s4">
            <input id="description" name="description" type="text" class="validate">
            <label for="description">Paskirtis</label>
          </div>
          <div class="input-field col s4">
            <input id="date" name="date" type="text" class="datepicker">
            <label for="date">Data</label>
          </div>
        </div>
        <div class="row">
          <div class="col s6">
            <button class="btn waves-effect waves-light" type="submit" name="action" id="submit">Submit
            </button>
          </div>
          <div class="col s6">
            <div id="response"></div>
          </div>
        </div>
      </form>
    </div>
    <div class="row">
      <div class="expenses">

      </div>
    </div>
  </section>
</div>

<?php require_once("pageparts/footer.php"); ?>
<?php require_once("pageparts/bottom.php"); ?>
