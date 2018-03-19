// sukurimui skirta funkcija, kuri siuncia ajax uzklausa i apsirasyta backend /api/Expense/Create.php kuris sukuria irasus  expenses lentoje pagal prisijungusi vartotoja
function createExpense(data) {
  $('#response').hide(); // paslepiame pranesimu lauka, kad ji veliau parodytume priklausomai nuo sekmes ar nesekmes
  $.ajax({
    type: "POST", // metodas/siuntimo budas
    url: "api/expense/create.php", // adreseas kur siunciami duomenys
    data: data, // siunciami duomenys auksciau nurodytu adresu
    dataType: "json", // formatas
    encode: true
  })
  .done(function(data){ // data yra gauti duomenys is serverio
    if(data.code > 0){ // jei kodas daugiau negu0, esame susitare kad tai bus klaida vienokia ar kitokia
      //alert(data.message);
      $("#response").css({"color":"red"}); // nustatome pranesimo splava
      $("#response").text(data.message); // sugeneruojame teksta
      $("#response").show(); // parodom atsakyma is karto, galima ir fadeIn naudoti kaip zemiau po else
    }
    else{
      $("#form").trigger("reset"); // isvalome forma
      $("#response").css({"color":"green"}); // pranesimo spalva
      $("#response").text("Įrašas sukurtas. "); // sugeneruojame pranesimo teksta
      $("#response").fadeIn(); // parodom pranesima

      setTimeout(function(){ $("#response").fadeOut();}, 2000); // pradanginam pranesima
      $(".expenses").empty(); // pasalinam viska is div.expenses ir is naujo issiunciame uzklausa de duomenu
      readExpenses(null); // siunciame uzklausa duomenims gauti
    }
  })
  .fail(function(response, ajaxOptions, thrownException){// klaidos atveju loginame i console
    console.log(response.status);
    console.log(ajaxOptions);
    console.log(thrownException);
  });
}

// nuskaitymui skirta funkcija, kuri siuncia ajax uzklausa i apsirasyta backend /api/Expense/Read.php kuris grazina irasus is expenses lentos pagal prisijungusi vartotoja
function readExpenses(data){
  $.ajax({
    type: "POST", // siuntimo budas/metodas
    url: "api/expense/read.php", // kam siunciame uzklausa
    data: data,
    dataType: "json", // formatas
    encode: true
  })
  .done(function(data){
    console.log(data);
    var table = $("<table>"); // sukuriamas lenteles elementas ir priskiriamas kintamajam
    table.addClass("bordered"); // lenteles kintamajam pridedama klase

    $.each(data.data, function(index, item){ // iteracija per kiekviena gauto masyvo elementa
      var tr = $("<tr>"); // kuriame eilute. atkreiptinas demesys, kad viena iteracija vienai eilutei

      var td1 = $("<td>"); // kuriame langeli
      td1.text(item.amount); // langelio teksta
      tr.append(td1); // pridedame langeli i eilute

      var td2 = $("<td>"); // kuriame langeli
      td2.text(item.description); // langelio teksta
      tr.append(td2); // pridedame langeli i eilute

      var td3 = $("<td>");// kuriame langeli
      td3.text(item.expenseDate); // langelio teksta
      tr.append(td3); // pridedame langeli i eilute

      table.prepend(tr); // pridedame eilute i lentele
    });

    $(".expenses").append(table); // idedame lentele i div elementa, kurio klase expenses
  })
  .fail(function(response, ajaxOptions, thrownException){ // klaidos atveju loginame i console
    console.log(response.status);
    console.log(ajaxOptions);
    console.log(thrownException);
  });
}
