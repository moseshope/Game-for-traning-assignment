var options = {
  valueNames: [ 'username' ]
};

var userList = new List('users', options);


var check_in = flatpickr("#start_date", { minDate: new Date() });
var check_out = flatpickr("#end_date", { minDate: new Date() });

check_in.set("onChange", function(d) {
	check_out.set("minDate", d.fp_incr(1)); //increment by one day
});
check_out.set("onChange", function(d) {
	check_in.set("maxDate", d);
});

// flatpickr('.calendar');
