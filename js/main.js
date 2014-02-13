$(function  () {
	$('.cep-mask').mask('00000-000');
	$('.peso-mask').mask('0,000');

	$('#calcula-frete').on('click', function  () {
		$.post('calcula_frete.php', $('form.form-horizontal').serialize(), function  (data, text, jqXHR) {	
			console.log(data);
			$('#resultados-consulta').html(data);
		});
	});
});

