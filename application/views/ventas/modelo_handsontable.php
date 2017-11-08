<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>LISTA DE PRECIOS</title>
	

	<script src="../js_bower/handsontable/dist/pikaday/pikaday.js"></script>
	<script src="../js_bower/handsontable/dist/moment/moment.js"></script>
	<script src="../js_bower/handsontable/dist/numbro/numbro.js"></script>
	<script src="../js_bower/handsontable/dist/zeroclipboard/ZeroClipboard.js"></script>
	<!-- Handsontable bare files -->
	<script src="../js_bower/handsontable/dist/handsontable.full.js"></script>
	<link rel="stylesheet" media="screen" href="../js_bower/handsontable/dist/handsontable.min.css">

	<script src="../js_bower/jquery/dist/jquery.js"></script>
	
	
	<style type="text/css">
		body {   
		  margin: 20px 30px;
		  font-size: 13px;
		  font-family: 'Open Sans', Helvetica, Arial;
		}

		a {
		  color: #34A9DC;
		  text-decoration: none;
		}

		p {
		  margin: 5px 0 20px;
		}

		h2 {
		  margin: 20px 0 0;
		  font-size: 18px;
		  font-weight: normal;
		}
	</style>

	<script type="text/javascript">




	$(document).ready(function(){
		var searchResultCount = 0;

		function searchResultCounter(instance, row, col, value, result) {
			Handsontable.Search.DEFAULT_CALLBACK.apply(this, arguments);
			if (result) searchResultCount++;
		}


		function hexRenderer(instance, td, row, col, prop, value, cellProperties) {
		    Handsontable.TextCell.renderer.apply(this, arguments);
		    var style = td.style;
		    // Apply new styles
		    style.background = "#F00";
		    //style.color = getContrastYIQ(value);

		}



		var container = document.getElementById('example');
		var hot = new Handsontable(container, {
			startRows: 0,
			startCols: 0,
			fillHandle: false, 
			//multiSelectBoolean: false, 
			search: { searchResultClass: 'customClass', callback: searchResultCounter }, 
			rowHeaders: true,
			fixedColumnsLeft: 2, 
			manualColumnFreeze: true, 
			currentRowClassName: 'currentRow',
			colHeaders: [
			'CODIGO', 'PRODUCTO', 'MODELO', 'PRECIO BASE', 
			'FLETE', 'LIM OFERTA', 'LIM DISTRIB', 'EVO I', 'EVO II'
			],
			columns: [
				{data: 'CODIGO', editor: false, readOnly: true, className: 'htCenter'},
				{data: 'DESCRIP', editor: false, readOnly: true, className: 'htLeft'},
				{data: 'MODELO', editor: false, readOnly: true, className: 'htCenter'}, 
				{data: 'PRECIO', editor: 'numeric', type: 'numeric', format: '0,0.00'},
				{data: 'FLETE', editor: false, readOnly: true}, 
				{data: 'LIMA-OFERTA', type: 'numeric', format: '0,0.00', readOnly: true },
				{data: 'LIMA-DISTRIB', editor: false, readOnly: true}, 
				{data: 'EVO-I', editor: false, readOnly: true}, 
				{data: 'EVO-II', editor: false, readOnly: true}


			],
			afterChange: function(change, source){
				if (source === 'loadData') return; 

				var row = change[0][0];
				var $CODIGO = this.getDataAtCell(row, "CODIGO");   // Ok 
				var $PRECIO = this.getDataAtCell(row, "PRECIO");   // Ok 

				if ($PRECIO!='undefined' && $PRECIO!="") {
					//this.setDataAtCell(row, 5, $PRECIO, "loadData");
					this.setDataAtCell(row, 5, $PRECIO, "loadData");
				};
				
				// $("#consola").html($CODIGO); 

			}
		});

		
		$("#carga").on('click', function(event) {
			event.preventDefault();
		  	$.post('../data/precios/data.php',{}, function(res) {
		      var data = JSON.parse(res);
		      hot.loadData(data.data);
		    });
		}); 

		$("#buscar").on('keyup', function(event) {
			var $busca = $(this).val();
		   $busca = $busca.toLowerCase();
			var queryResult;
		    searchResultCount = 0;
		    queryResult = hot.search.query($busca);
		    $("#contador").html(searchResultCount.toString());
		    hot.render();
		 });

	})
	</script>
</head>
<body>
	<style type="text/css">
	.ht_master tr td {
	  font-family: 'Calibri' !important;
	  font-size:  13px !important; 
	}

	.handsontable td {
	  font-family: 'Calibri' !important;
	  font-size:  13px !important; 
	}

	.handsontable th {
		font-family: 'Calibri' !important;
		font-size:  12px; 
	}

	.currentRow {
		background-color: #E4E4E4 !important;
	}

	.customClass { background-color: #06c !important; color: #FFF !important}
	
	/*
	.handsontable .htDimmed {
	  color: #333 !important;
	}
	*/

	span#contador { padding: 4px 8px; font-size: 12px; color: #999}

	div#consola { background-color: #EDEDED; padding: 5px; font-size: 12px; font-style: italic; margin: 5px; display: none }

	</style>

	<h1>Precio Base</h1>
	<input id="buscar"><span id="contador">0 resultados</span>
	<div id="consola">Consola...</div>
	<label><input type="checkbox" checked="checked">Codigo</label>
	<p>
	<button id="carga">Carga</button>
	</p>


	<style type="text/css">
		p.informacion { font-style: italic; color: #999; font-size: 12px }
	</style>
	<p class="informacion">
		Se actualizaran los codigos nuevos desde JCHS2017 vs XLUIS (agregarán nuevos codigos) al seleccionar la Marca
	</p>

	<div id="example"></div>	

</body>
</html>


