function createUser(data) {
  $('#response').hide();
  $.ajax({
    type: "POST",
    url: "api/user/create.php",
    data: data,
    dataType: "json",
    encode: true
  })
  .done(function(data){
    if(data.code > 0){
      //alert(data.message);
      $("#response").css({"color":"red"});
      $("#response").text(data.message);
      $("#response").show();
    }
    else{
      $("#form").trigger("reset");
      $("#response").css({"color":"green"});
      $("#response").text("Vartotojas sukurtas. Palaukite vyksta nukreipimas...");
      $("#response").fadeIn();
      setTimeout(function(){ window.location = "login.php";}, 2000);
    }

    //$('#form').trigger("reset");

    //$('#response').css({"color":"green"});
  //  $('#response').text(data.messages);    // json message atvaizduojame i response div kuris yra register.php
    //$('#response').fadeIn(); // atsiranda pranesimas kad ok viskas
    //setTimeout(function(){ window.location = "login.php"; }, 5000);
  })
  .fail(function(response, ajaxOptions, thrownException){
    console.log(response.status);
    console.log(ajaxOptions);
    console.log(thrownException);
  });
}
