<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>JCH App - Ingreso</title>
  <link rel="shortcut icon" href="<?=base_url('/images/favicon.ico');?>">

  <link rel="stylesheet" type="text/css" href="<?=base_url('/tools/semantic/semantic.min.css');?>">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans|Roboto+Condensed" />

  <script src="<?=base_url('/tools/jquery/jquery.min.js');?>"></script>
  <script src="<?=base_url('/tools/semantic/semantic.min.js');?>"></script>

  <style type="text/css">
  *, .dropdown {font-family: 'Roboto Condensed', sans-serif}

  html, body {
    background-color: #eee;
    background-image: url("<?=base_url('/images/login.jpg');?>");
    height: 100%;
    margin:0;
    padding: 0;
  }

  #login-box {
    background-color: rgba(255,255,255,.7);
    border:1px solid #eee;
    margin: 0 auto;
    padding: 20px 30px;
    position: relative;
    top: 7%;
    width: 350px;
  }
  input { text-transform: uppercase;}
  </style>

</head>
<body>

  <div id="login-box" class="ui segment">

    <h2 class="ui icon header aligned center">
      <i class="users icon"></i>
      <div class="content">
        Acceso de Usuarios
        <div class="sub header">Ingreso de usuarios registrados</div>
      </div>
    </h2>

    <div class="ui negative small message hidden">
      <i class="close icon"></i>
      <div class="header">No se pudo acceder al sistema</div>
      <p>Revise si su código y clave son correctos</p>
    </div>

    <form id="formLogin" class="ui form" autocomplete="off" method="post" action="<?=base_url('index.php/login/ingresar');?>">

      <div class="field">
        <label>Empresa</label>
        <select class="ui dropdown" name="empresa">
          <option value="">Seleccione su empresa</option>
          <option value="JCHS2017">JCH COMERCIAL SA</option>
          <option value="CARS2017">EVOLUTION CAR SERVICE</option>
          <option value="SOFTCOMTOP">TOP GARAGE SAC</option>
        </select>
      </div>

      <div class="field">
        <div class="two fields">
          <div class="field"><label>Codigo de usuario</label><input type="text" name="usuario"></div>
          <div class="field"><label>Clave de acceso</label><input type="password" name="clave"></div>
        </div>
      </div>

      <input type="hidden" name="empresa_nom" value="">
      <div class="fluid tiny primary ui button">Ingresar</div>
    </form>

  </div>


  <script type="text/javascript">
  $(function () {
    sessionStorage.clear();

    var $formLogin = $("#formLogin").form({
      on: 'blur',
      inline: true,
      fields: {
        usuario: { identifier: 'usuario', rules: [{ type: 'empty', prompt: 'Please enter a value'}]},
        clave: { identifier: 'clave', rules: [{ type: 'empty', prompt: 'Please enter a value'}]},
        empresa: { identifier: 'empresa', rules: [{ type: 'empty', prompt: 'Please enter a value'}]}
      },
      onSuccess: function(form){

        $.ajax({
          type: 'post',
          url: '<?=base_url('index.php/login/ingresar');?>',
          data: $formLogin.serialize(),
          beforeSend: function () {
            $formLogin.parent().addClass("loading");
            $(".message.negative").slideUp("fast");

          },
          success: function (data) {
            if (data==="error"){
              $(".message.negative").slideDown("fast");
              $formLogin.parent().removeClass("loading");
              return false;
            }else{
              window.location = "<?=site_url("/welcome/inicio");?>";
            }
          }
        });

      }
    });

    $("div.button").on("click",function(e){
      $formLogin.submit();
    });

    $formLogin.on("submit",function(){
      return false;
    });

    $(".close.icon").click(function () {
      $(this).parent().slideUp("fast");
    });

    $('[name="empresa"]').on("change", function () {
      $('[name="empresa_nom"]').val($("option:selected",this).text());
    });

  });

  </script>

</body>
</html>
