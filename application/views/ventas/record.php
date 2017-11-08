<?php
$data['title'] = 'Record de ventas';
$this->load->view('header', $data);
?>

<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
<link rel="stylesheet" href="<?=base_url('/tools/handsontable/dist/handsontable.full.css');?>" />
<script src="<?=base_url('tools/handsontable/dist/handsontable.full.js');?>"></script>

<style type="text/css">
#tabla {
  width:100%;
  z-index: 1
}
#tabla table{
  width:100%;
  font-size: 12px;
  font-family: 'Open Sans', sans-serif;
}
.ht_master tr:nth-of-type(odd) > td {
  background-color: #fff;
}

.ht_master tr:nth-of-type(even) > td {
  background-color: #F0F0F0;
}
.ht_clone_left th {
  font-size: 9px; color: #A4A4A4
}
</style>

<div class="contenido">
  <div class="ui secondary segment center aligned">

    <div class="ui mini action stackable input">
      <label class="ui label">Mes de Record&nbsp;
        <select class="ui mini selection dropdown">
          <?php
          $meses = [
            1 => "enero", 2 => "febrero", 3 => "marzo", 4 => "abril",
            5 => "mayo", 6 => "junio", 7 => "julio", 8 => "agosto",
            9 => "setiembre", 10 => "octubre", 11 => "noviembre", 12 => "diciembre"
          ];
          for ($m=1; $m<=12; $m++):
            echo "<option value=" . $m . " ". (date("n")==$m ? "selected" : "") . ">" . ucwords($meses[$m]) . "</option>";
          endfor;
          ?>
        </select>
      </label>
      <div id="btnGenerar" class="ui mini submit teal button"><i class="icon search"></i>Generar reporte</div>

    </div>
  </div>

  <div id="tabla"></div>

</div>

<script type="text/javascript">
$(function() {

  var container = document.getElementById('tabla');

  var hot = new Handsontable(container, {
    startRows: 0,
    startCols: 0,
    height: 400,
    stretchH: "all",
    rowHeaders: true,
    colHeaders: [
      "AGENCIA",
      "FECHA",
      "REP. #",
      "T/C",
      "TARJETA MN",
      "TARJETA US",
    ],
    contextMenu: true,
    columns: [
      {
        data: 'agencia',
        readOnly: true,
        className: 'htCenter'
      },
      {
        data: 'fecha',
        dateFormat: 'DD/MM/YYYY',
        readOnly: true,
        className: 'htCenter'
      },
      {
        data: 'reporte_num',
        readOnly: true,
        className: 'htCenter'
      },
      {
        data: 'tc',
        readOnly: true,
        type: 'numeric',
        format: '0.000',
        className: 'htCenter'
      },

      {
        data: 'tarjeta_mn',
        readOnly: true,
        type: 'numeric',
        format: '0,0.00',
        allowEmpty: false
        //className: 'htCenter'
      },

      {
        data: 'tarjeta_a_us',
        readOnly: true,
        type: 'numeric',
        format: '0,0.00',
        allowEmpty: false
        //className: 'htCenter'
      },

    ],
    columnSorting: true,
    fillHandle: false
  });

  $("#btnGenerar").on("click",function(){
    HoldOn.open({ theme:"sk-bounce" });

    $.post('<?=site_url("ventas/record_ventas");?>',{}, function(res) {
      var data = JSON.parse(res);
      hot.loadData(data);
      hot.render();
      HoldOn.close();
    });

  })


});
</script>

<?php
$this->load->view('footer');
?>
