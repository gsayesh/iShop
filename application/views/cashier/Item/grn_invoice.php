<!DOCTYPE html>
<html>
<head>
<script type="text/javascript">
  	
  	function printInvoice(data){

  		var generator = window.open(",'name,");
  		var printData = document.getElementById(data);
  		generator.document.write(printData.innerHTML.replace("Print Me"));

  		generator.document.close();
  		generator.print();
  		generator.close();

  	}

</script>

<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-1.12.4.js" ></script>

</head>
<body>

	<div id="dataSet">
		
		<center> <h1>GRN Invoice</h1> </center>

		<div class="row">
			<div class="col-md-8">
				<label>GRN Number : <?php echo ""; ?></label><br>
				<label>Bill Number : <?php echo ""; ?></label>
			</div>	
			<div class="col-md-4">
				<label>GRN Date : <?php echo ""; ?></label><br>
				<label>Cashier Id : <?php echo ""; ?></label>
			</div>		
		</div>

		

		

		<table class="table table-bordered table-striped">
			<tr>
				<th>#</th>
				<th>Product Code</th>
				<th>Product Name</th>
				<th>Discription</th>
				<th>Whole Sale Price</th>
				<th>Retail Price</th>
				<th>Quentity</th>
			</tr>
		</table>

	</div>

	<a href="" onclick="javascript:printInvoice('dataSet')" >Print</a>

</body>
</html>