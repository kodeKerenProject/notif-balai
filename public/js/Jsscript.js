function ValidateSize(inputFile, inputText, formElem, target) {
	if (typeof inputText != 'undefined') {
		let totalText = $(inputText).length;
		$.each($(inputText), function(index, value) {
			if (value.value == '') {
				$(target).html('<p class="alert alert-danger">Input tidak boleh kosong</p>');
		        totalText--;
		        return false;
			}
		});
		if (totalText != $(inputText).length) {
			return false;
		}
	}
	let total = $(inputFile).length;
	$.each($(inputFile), function(index, value) {
		if ( window.FileReader && window.File && window.FileList && window.Blob ) {
		    // File API Supported
			if (value.files[0]) {
			    let fileSize = value.files[0].size / 1024 / 1024; // file size dalam MB;
			    if (fileSize > 2) {
			        $(target).html('<p class="alert alert-danger">Ukuran file tidak boleh lebih dari 2 megabytes</p>');
			        total--;
			        return false;
			    }
			} else {
				$(target).html('<p class="alert alert-danger">File tidak boleh kosong</p>');
		        total--;
		        return false;
			}
		} else {
			// Not Supported File API
			alert( "File API not supported on this browser" );
	    	// $(formElem).submit();
		} 
	});
	if (total != 0 && total == $(inputFile).length) {
    	$(formElem).submit();
	}
}


$(document).ready(function() {
	// let jumlah = $('.dok').length;

	// // aksi men-disable input dok jika tidak ada
	// $(document).on('click', '.tidakAda', function(event) {
	// 	jumlah--;
	// 	$(this).parent().find('.file').prop('disabled', true);
	// 	$(this).parent().find('.fileName').prop('disabled', true);
	// 	$(this).css('display', 'none');
	// 	$(this).parent().find('.ada').css('display', '');
	// 	if (jumlah == 0) {
	// 		$('#submit').prop('disabled', true);
	// 	}
	// 	event.preventDefault();
	// });

	// // aksi me-reset input dok jika ada
	// $(document).on('click', '.ada', function(event) {
	// 	jumlah++;
	// 	$(this).parent().find('.file').prop('disabled', false);
	// 	$(this).parent().find('.fileName').prop('disabled', false);
	// 	$(this).css('display', 'none');
	// 	$(this).parent().find('.tidakAda').css('display', '');
	// 	if (jumlah == 1) {
	// 		$('#submit').prop('disabled', false);
	// 	}
	// 	event.preventDefault();
	// });
});
