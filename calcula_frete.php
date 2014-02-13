<?php
	
$data['nCdEmpresa'] = '';
$data['sDsSenha'] = '';
$data['sCepOrigem'] = str_replace('-', '', $_REQUEST['cep_origem']);
$data['sCepDestino'] = str_replace('-', '', $_REQUEST['cep_dest']);
$data['nVlPeso'] = $_REQUEST['peso'];
$data['nCdFormato'] = $_REQUEST['formato_encomenda'];
$data['nVlComprimento'] = $_REQUEST['comprimento'];
$data['nVlAltura'] = $_REQUEST['altura'];
$data['nVlLargura'] = $_REQUEST['largura'];
$data['nVlDiametro'] = $_REQUEST['diametro'];
$data['sCdMaoPropria'] = 'N';
$data['nVlValorDeclarado'] = '0';
$data['sCdAvisoRecebimento'] = 'n';
$data['StrRetorno'] = 'xml';
$data['nCdServico'] = $_REQUEST['tipo_servico'];

// Constroi string com parametros a partir dos dados do formulário
$data = http_build_query($data);
$url = 'http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx';
$curl = curl_init($url . '?' . $data);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($curl);
$result = simplexml_load_string($result);

 // var_dump($result);

foreach($result -> cServico as $row): ?>
 	<div class="well">
    <?php if($row -> Erro !== '0'): ?>
    	<h4>Valor: <small>R$ <?php echo $row -> Valor ?></small></h4>
    	<h4>Prazo de entrega: <small><?php echo $row -> PrazoEntrega; echo ($row->PrazoEntrega > 1) ? 'dias' : 'dia' ; ?> </small></h4>
    <?php else: ?>
        <?php echo $row -> MsgErro; ?>
    <?php endif; ?>
	</div>
<?php
	endforeach;
?>