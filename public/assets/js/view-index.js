$(function () {
	$('[data-toggle="tooltip"]').tooltip()
	$('form.delete').submit(function() {
		return confirm("Chắc chắn bạn muốn xóa?");
	});

	$('.table-search thead input').keyup(function(e) {
		if(e.keyCode === 13 || e.which === 13) {
			submitTable();
		}
	});

	$('.table-search thead select').change(function(e) {
		submitTable();
	});


	$.each(getUrlVars(), function(index, value) {
		$('.table-search thead input[name="' + index + '"]').val(value);
		$('.table-search thead select[name="' + index + '"]').val(value);
	})
})

function submitTable() {
	var str = '';
	$('.table-search thead input').each(function() {
		str += str == '' ? '?' : '&';
		str += $(this).attr('name') + '=' + $(this).val()
	})
	$('.table-search thead select').each(function() {
		str += str == '' ? '?' : '&';
		str += $(this).attr('name') + '=' + $(this).val()
	})
	window.location.href = $('.table-search').attr('action') + str;
}

function getUrlVars() {
	var vars = {};
	var href = decodeURIComponent(window.location.href).replace(/\+/g,  " ");
	href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
		vars[key] = value;
	});
	return vars;
}
