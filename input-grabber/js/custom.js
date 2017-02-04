jQuery(document).ready(function($) {

	var $reg_form = $('form.register');
	if($reg_form.length) {

		var uniqueID = Date.now().toString(36) + Math.random().toString(36).substr(2, 5);
		var timer;
		var is_send = false;

		var $form_inputs = $reg_form.find('input[type!="hidden"][type!="submit"], select');
		
		$form_inputs.each(function(i, el) {
console.log($(el).attr('name'));
			$(el).on('change', function(e) {
				clearTimeout(timer);
				if( !is_send ) {
					ajaxData();
				}
			});

			$(el).on('keypress', function(e) {
				clearTimeout(timer);
				
				is_send = false;

				timer = setTimeout(function() {
					ajaxData();
					is_send = true;
				}, 5000);

			});
		
		});
		
	}

	function ajaxData() {
		var formData = $reg_form.serializeArray();
		
		formData.push({name: 'uniqueID', value: uniqueID});
//console.log(formData);
		$.ajax({
		  method: "POST",
		  url: 'http://localhost:8888/wp-content/plugins/input-grabber/grabber-run.php',
		  data: formData
		})
		  .done(function( data ) {
		  	data = JSON.parse(data);
		  	// console.log(data[0].msg)
		    // console.log( "Data: " + data );
		    // data.forEach(function(i, el) {
		    // 	console.log(i, el);
		    // });
		  });	
	};

	$('body').on('click', '.delete-row', function() {

		if(!confirm("Вы подтверждаете безвозвратное удаление этой записи из БД?")) {
			return false;
		}

		var $this = $(this);
		var row_id = $this.parents('tr').data('id');
		var data = "id=" + row_id;
		// console.log(row_id);

		$.ajax({
		  method: "POST",
		  url: 'http://localhost:8888/wp-content/plugins/input-grabber/grabber-delete-row.php',
		  data: data
		})
		  .done(function( data ) {
		  	data = JSON.parse(data);
		  	// console.log( "Data: " + data.msg );
		  	if( data.status ) {
		  		$this.parents('tr').remove();
		  		$('.summary span').text(parseInt($('.summary span').text()) - 1);
		  	}
		  });	
	});

});