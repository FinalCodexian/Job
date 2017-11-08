</div>
</body>
</html>


<script type="text/javascript">
$(function(){

	$(".dropdown").dropdown();

	var $tabla = $('#example');

	$('#left-menu').first()
	.sidebar('setting', {transition: 'overlay'})
	.sidebar('setting', {mobileTransition: 'overlay'})
	.sidebar('attach events', '.mobile-button')
	.sidebar('setting', {
		onHide: function(){
			$("#top-menu, .pusher").css({'width':'100%'})
			if($tabla.length > 0) $tabla.DataTable().columns.adjust().draw();
		},
		onShow: function(){	sessionStorage.setItem('sidebar', "true"); },
		onHidden: function(){	sessionStorage.setItem('sidebar', "false"); }
	});

	if(	sessionStorage.getItem('sidebar')=="true" || sessionStorage.getItem('sidebar')==undefined ){
		$('#left-menu').sidebar("show");
	}else {
		$('#left-menu').sidebar("hide");
	}

})

</script>
