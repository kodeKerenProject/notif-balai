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
	if (total == $(inputFile).length) {
    	$(formElem).submit();
	}
}

 
let number = $('.bodyContent').length;
let number11 = $('.bodyContent11').length;
$(document).ready(function() {
	// pengisian manual Spesifikasi pembelian/jaminan mutu bahan
	$('#tambahBahan').on('click', function() {
		let clone = $('.bodyContent').first().clone();
		clone.find('.jenisbahan').val('');
		clone.find('.spek').val('');
		clone.find('.namaPemasok').val('');
		$('#tableBody').append(clone);
		number++
	});

	// pengisian manual Peralatan/Instrumen pengujian, gauge, atau perkakas
	$('#tambahBahan11').on('click', function() {
		let clone = $('.bodyContent11').first().clone();
		clone.find('.namaAlat').val('');
		clone.find('.namaPembuat').val('');
		clone.find('.acuan').val('');
		clone.find('.sistemP').val('');
		clone.find('.sert').val('');
		$('#tableBody11').append(clone);
		number11++
	});

	$('#lampiran').hide();
	$('#toggleLampiran').on('click', function() {
		$('#lampiran').toggle();
		$('#manual').toggle();
		let value = [];
		if ($('#lampiran').is(':visible')) {
			value[0] = false;value[1] = true;
		} else {
			value[0] = true;value[1] = false;
		}
		$('#lampiran').find('input[name=spekMutuBahan]').prop('disabled', value[0]);
		$('#tambahBahan').prop('disabled', value[1]);
		$.each($('.jenisbahan'), function(index, value) {
			$(this).prop('disabled', value[1]);
			$('.spek').prop('disabled', value[1]);
			$('.namaPemasok').prop('disabled', value[1]);
		});
	});

	$('#lampiran11').hide();
	$('#toggleLampiran11').on('click', function() {
		$('#lampiran11').toggle();
		$('#manual11').toggle();
		let value = [];
		if ($('#lampiran11').is(':visible')) {
			value[0] = false;value[1] = true;
		} else {
			value[0] = true;value[1] = false;
		}
		$('#lampiran11').find('input[name=rincianPeralatan]').prop('disabled', value[0]);
		$('#tambahBahan11').prop('disabled', value[1]);
		$.each($('.namaAlat'), function(index, value) {
			$(this).prop('disabled', value[1]);
			$('.namaPembuat').prop('disabled', value[1]);
			$('.acuan').prop('disabled', value[1]);
			$('.sistemP').prop('disabled', value[1]);
			$('.sert').prop('disabled', value[1]);
		});
	});

	$('#lampiran1').hide();
	$('#lampiran2').hide();
	$('#lampiran3').hide();
	$('#lampiran4').hide();
	$('#lampiran5').hide();
	$('#lampiran6').hide();
	$('#lampiran7').hide();
});

function slideOpt(slideContent, opt, slideContent2) {
	let disabled = [null, null];
	if (opt == 'ya') {
		$(slideContent).slideDown();
		disabled[0] = false;
		if (slideContent2 != false) {
			$(slideContent2).slideUp();
			disabled[1] = true;
		}
	} else {
		$(slideContent).slideUp();
		disabled[0] = true;
		if (slideContent2 != false) {
			$(slideContent2).slideDown();
			disabled[1] = false;
		}
	}
	$.each($(slideContent).find('.inpt'), function(index, value) {
		$(this).prop('disabled', disabled[0]);
	});
	$.each($(slideContent2).find('.inpt'), function(index, value) {
		$(this).prop('disabled', disabled[1]);
	});
}

// hapus row Spesifikasi pembelian/jaminan mutu bahan
$(document).on('click', '.hapusContent', function() {
	if (number > 1) {
		$(this).parent().parent().remove();
		number--;
	}
});

// hapus row Peralatan/Instrumen pengujian, gauge, atau perkakas
$(document).on('click', '.hapusContent11', function() {
	if (number11 > 1) {
		$(this).parent().parent().remove();
		number11--;
	}
});

function inputToggle(lampiran, manual, input1, input2) {
	$(lampiran).toggle();
	$(manual).toggle();
	let value = [];
	if ($(lampiran).is(':visible')) {
		value[0] = false;value[1] = true;
	} else {
		value[0] = true;value[1] = false;
	}
	$(lampiran).find('input[name='+input1+']').prop('disabled', value[0]);
	$(manual).find('textarea[name='+input2+']').prop('disabled', value[1]);
}

