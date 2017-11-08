<!DOCTYPE html>
<html lang="en">
<head>
	<title>JCH App - <?=$title;?></title>
	<meta charset="utf-8" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<link rel="shortcut icon" href="<?=base_url();?>images/favicon.ico" type="image/x-icon"/>

	<link rel="stylesheet" type="text/css" href="<?=base_url();?>tools/semantic/semantic.min.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url();?>tools/HoldOn/HoldOn.min.css">

	<script src="<?=base_url();?>tools/jquery/jquery.min.js"></script>
	<script src="<?=base_url();?>tools/semantic/semantic.min.js"></script>
	<script src="<?=base_url();?>tools/HoldOn/HoldOn.min.js"></script>

	<style type="text/css">
	#top-menu {
		width: calc(100% - 260px);
		transition: all .2s;
		z-index: 5;
	}
	.pusher {width: calc(100% - 260px);}

	.contenido {padding: 50px 10px 10px 10px}

	table.pretty  {width: 100%; clear: both;}
	table.pretty thead th, table.pretty tfoot th { font-size: 12px }
	table.pretty tbody tr td { font-size: 13px }
	table.pretty tbody tr:hover { background-color: #EEE !important;}

	table.pretty td.center {text-align: center}
	table.pretty td.left {text-align: left}
	table.pretty td.right {text-align: right}

	</style>
</head>

<body>
	<div class="ui active left inverted blue visible vertical menu sidebar" id="left-menu">

		<div class="item"><h4>Menu Principal</h4></div>

		<div class="item">
			<div class="header">Archivos</div>
			<div class="menu">
				<a class="item" href="<?=base_url();?>index.php/welcome/archivos_clientes">Consulta de Clientes</a>
			</div>
		</div>

		<div class="item">
			<div class="header">Ventas</div>
			<div class="menu">
				<a class="item">Ranking de Ventas</a>
				<a class="item" href="<?=base_url();?>index.php/welcome/ventas_record">Record de Ventas</a>
				<a class="item">Ventas por Clientes</a>
			</div>
		</div>
		<div class="item">
			<div class="header">Stock</div>
			<div class="menu">
				<a class="item" href="<?=base_url();?>index.php/welcome/stock_neumaticos">Neumaticos</a>
				<a class="item">Motos</a>
			</div>
		</div>

	</div>

	<div class="ui top fixed mini pointing menu" id="top-menu">
		<a class="item mobile-button"><i class="fitted sidebar large icon"></i></a>
		<a class="item active" style="color:rgb(28, 80, 119)">
			<?=$title;?>&nbsp;&nbsp;
			<i class="icon small info circular"></i>
		</a>
		<div class="right menu">
			<div class="item">
				<?=$this->session->userdata('empresa_nom');?>
			</div>
			<div class="ui dropdown item">
				<i class="icon large setting"></i>
				<i class="dropdown icon"></i>
				<div class="menu">
					<a class="item">Administrar</a>
					<a class="item" href="<?=site_url("/login/logout");?>">Cerrar sesion</a>
				</div>
			</div>

		</div>
	</div>

	<div class="pusher">
