$(".box p img").click(function(){
  var mazoPaveiksliukoSrc = $(this).prop("src");
  var naujasPaveiksliukas = $("<img>");
  naujasPaveiksliukas.prop("src", mazoPaveiksliukoSrc);
  $(".mymodalbox").append(naujasPaveiksliukas);
  $(".mymodal").css({"display":"flex"});
})

$(".mymodal").click(function(){
  $(".mymodal").css({"display":"none"});
  $(".mymodalbox").empty();
})
