$(document).ready(function() {
	let jumlah = $('.dok').length;

	// aksi men-disable input dok jika tidak ada
	$(document).on('click', '.tidakAda', function(event) {
		jumlah--;
		$(this).parent().find('.file').prop('disabled', true);
		$(this).parent().find('.fileName').prop('disabled', true);
		$(this).css('display', 'none');
		$(this).parent().find('.ada').css('display', '');
		if (jumlah == 0) {
			$('#submit').prop('disabled', true);
		}
		event.preventDefault();
	});

	// aksi me-reset input dok jika ada
	$(document).on('click', '.ada', function(event) {
		jumlah++;
		$(this).parent().find('.file').prop('disabled', false);
		$(this).parent().find('.fileName').prop('disabled', false);
		$(this).css('display', 'none');
		$(this).parent().find('.tidakAda').css('display', '');
		if (jumlah == 1) {
			$('#submit').prop('disabled', false);
		}
		event.preventDefault();
	});

	
});