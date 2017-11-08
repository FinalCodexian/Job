<?php
$data['title'] = 'Clientes';
$this->load->view('header', $data);
?>
<link rel="stylesheet" type="text/css" href="<?=base_url();?>tools/datatables/jquery.dataTables.min.css">
<script src="<?=base_url();?>tools/datatables/jquery.dataTables.min.js"></script>

<div class="contenido">

	<table id="example" class="ui table pretty" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th>Name</th>
				<th>Position</th>
				<th>Office</th>
				<th>Age</th>
				<th>Start date</th>
				<th>Salary</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th>Name</th>
				<th>Position</th>
				<th>Office</th>
				<th>Age</th>
				<th>Start date</th>
				<th>Salary</th>
			</tr>
		</tfoot>
		<tbody>
			<tr>
				<td>Tiger Nixon</td>
				<td>System Architect</td>
				<td>Edinburgh</td>
				<td>61</td>
				<td>2011/04/25</td>
				<td>$320,800</td>
			</tr>
			<tr>
				<td>Garrett Winters</td>
				<td>Accountant</td>
				<td>Tokyo</td>
				<td>63</td>
				<td>2011/07/25</td>
				<td>$170,750</td>
			</tr>
			<tr>
				<td>Ashton Cox</td>
				<td>Junior Technical Author</td>
				<td>San Francisco</td>
				<td>66</td>
				<td>2009/01/12</td>
				<td>$86,000</td>
			</tr>
			<tr>
				<td>Cedric Kelly</td>
				<td>Senior Javascript Developer</td>
				<td>Edinburgh</td>
				<td>22</td>
				<td>2012/03/29</td>
				<td>$433,060</td>
			</tr>
			<tr>
				<td>Airi Satou</td>
				<td>Accountant</td>
				<td>Tokyo</td>
				<td>33</td>
				<td>2008/11/28</td>
				<td>$162,700</td>
			</tr>
			<tr>
				<td>Brielle Williamson</td>
				<td>Integration Specialist</td>
				<td>New York</td>
				<td>61</td>
				<td>2012/12/02</td>
				<td>$372,000</td>
			</tr>
			<tr>
				<td>Herrod Chandler</td>
				<td>Sales Assistant</td>
				<td>San Francisco</td>
				<td>59</td>
				<td>2012/08/06</td>
				<td>$137,500</td>
			</tr>
		</tbody>
	</table>

</div>
</div>

<script type="text/javascript">
	$(function() {
		
		var $tabla = $('#example');

		$tabla.DataTable({
			scrollY: "50vh",
			scrollCollapse: true,
			paging: false,
			info: false,
			filter: false,
		});

	}); 
</script>



<?php
$this->load->view('footer');
?>
