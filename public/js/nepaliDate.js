$(document).ready(function(){
  $('#nepaliDate').nepaliDatePicker({
    onChange: function(){
     $('#englishDate').val(BS2AD($('#nepaliDate').val()));
    }
  });
  $('#nepaliDate1').nepaliDatePicker({
    onChange: function(){
     $('#englishDate1').val(BS2AD($('#nepaliDate1').val()));
    }
  });
  $('#nepaliDate2').nepaliDatePicker();

  $('#nepaliDate4').nepaliDatePicker({
    onChange: function(){
     $('#englishDate4').val(BS2AD($('#nepaliDate4').val()));
    }
  });
  $('#nepaliDate5').nepaliDatePicker({
    onChange: function(){
     $('#englishDate5').val(BS2AD($('#nepaliDate5').val()));
    }
  });
  $('#nepaliDate3').nepaliDatePicker();
  $('#nepaliDate8').nepaliDatePicker();

  // from date and to date
 $('#nepaliDate6').nepaliDatePicker({
    onChange: function(){
     $('#englishDate6').val(BS2AD($('#nepaliDate6').val()));
    }
  });
  $('#nepaliDate7').nepaliDatePicker({
    onChange: function(){
     $('#englishDate7').val(BS2AD($('#nepaliDate7').val()));
    }
  });
});
