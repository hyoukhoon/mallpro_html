$(document).ready(function() {
	// variables 
	var status = $('.status');
	var percent = $('.percent');
	var bar = $('.bar');

/*
	$('#form').submit(function(e){
		//disable the actual submit of the form.
		e.preventDefault(); 
		
		//grab all form data 
		var form = $('form')[0];
		var formData = new FormData(form);

		var upfiles_cnt = $("input:file", this)[0].files.length;
		if(upfiles_cnt == 0){
			alert('선택한 파일이 없습니다');
			return false; // form을 전송시키지 않고 반환
		} 

        $.ajax({
            url: "fileupload.php",
            data: formData,
            type: 'POST',
			dataType: "json",

			// reset before submitting 
			beforeSend: function() {
				status.fadeOut();
				bar.width('0%');
				percent.html('0%');
			},

			// progress bar call back
			uploadProgress: function(e, position, total, percentComplete) {
				var pVel = percentComplete + '%';
				bar.width(pVel);
				percent.html(pVel);
			},

            success: function (data) {
                //alert("File Uploaded: "+data);
				$('.status').html(data + ' Files uploaded!').fadeIn();
				$('#fileList').html(data + ' Files uploaded!');
            },
            error: function(){
                alert("error in ajax form submission");
            },
            cache: false,
            contentType: false,
            processData: false
        });

		return false;
	});

	// submit form with ajax request 
	$('form').ajaxForm({
		// set data type json 
		dataType:  'json',

		// reset before submitting 
		beforeSend: function() {
			status.fadeOut();
			bar.width('0%');
			percent.html('0%');
		},

		// progress bar call back
		uploadProgress: function(event, position, total, percentComplete) {
			var pVel = percentComplete + '%';
			bar.width(pVel);
			percent.html(pVel);
		},

		// complete call back 
		complete: function(data) {
			status.html(data.responseJSON.count + ' Files uploaded!').fadeIn();
		}
	});
*/

	$('#form').submit(function(e){
		//disable the actual submit of the form.
		e.preventDefault(); 
		
		//grab all form data 
		var form = $('form')[0];
		var formData = new FormData(form);

		var upfiles_cnt = $("input:file", this)[0].files.length;
		if(upfiles_cnt == 0){
			alert('선택한 파일이 없습니다');
			return false; // form을 전송시키지 않고 반환
		} 

		$(this).ajaxSubmit({
			// set data type json 
			dataType:  'json',

			// reset before submitting 
			beforeSend: function() {
				status.fadeOut();
				bar.width('0%');
				percent.html('0%');
			},

			// progress bar call back
			uploadProgress: function(event, position, total, percentComplete) {
				var pVel = percentComplete + '%';
				bar.width(pVel);
				percent.html(pVel);
			},

			complete: function(data) {
				status.html(data.responseJSON.count + ' Files uploaded!').fadeIn();
			},
            resetForm: true 
		});
		return false;
	});

});