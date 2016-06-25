var options = {
  valueNames: [ 'username' ]
};

var userList = new List('users', options);


/*CREATION*/
var check_in = flatpickr("#start_date", { minDate: new Date() });
var check_out = flatpickr("#end_date", { minDate: new Date() });

check_in.set("onChange", function(d) {
	check_out.set("minDate", d.fp_incr(1)); //increment by one day
});
check_out.set("onChange", function(d) {
	check_in.set("maxDate", d);
});


$(document).on('ready', function(){
  //*EDIT*/
  
  contextEdit = $('form').first().attr('context-edit');
  console.log(contextEdit);
  if (contextEdit == "true"){
    var check_in = flatpickr("#start_date");
    var check_out = flatpickr("#end_date");
    
    check_in.set("onChange", function(d) {
    	check_out.set("minDate", d.fp_incr(1)); //increment by one day
    });
    check_out.set("onChange", function(d) {
    	check_in.set("maxDate", d);
    });
  }
  else{
    var check_in = flatpickr("#start_date", { minDate: new Date() });
    var check_out = flatpickr("#end_date", { minDate: new Date() });
    
    check_in.set("onChange", function(d) {
    	check_out.set("minDate", d.fp_incr(1)); //increment by one day
    });
    check_out.set("onChange", function(d) {
    	check_in.set("maxDate", d);
    });
  }
});



