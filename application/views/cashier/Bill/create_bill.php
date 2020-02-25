<!DOCTYPE html>
<html>
<head>
	<title>Create Bill</title>
</head>
<body>
	<h1>Create Bill</h1>

	<form>
		
		<label>Bill Number : </label>
		<input type="text" name="bill_no">

		<br><br>
		<label>Product Code</label><br>
		<input type="text" name="product_code" placeholder="PRSP0001"><br>

		<label>Name</label><br>
		<input type="text" name="name" placeholder="Speaker set"><br>

		<label>Selling Price</label><br>
		<input type="text" name="selling_price" placeholder="1870.50"><br>

		<label>Last Price</label><br>
		<input type="text" name="last_price" placeholder="1745.50"><br>

		<label>Quentity</label><br>
		<input type="text" name="quentity" placeholder="3"><br>

		<label>Discount</label><br>
		<input type="text" name="discount" placeholder="125.00"><br>

		<input type="submit" name="add" value="ADD">
		<input type="reset" name="reset" value="RESET">
		<br>

	</form>

	<form>
		<br>
		<label>Bill Date : </label>
		<input type="text" name="date">

		<select name="bill_type">
			<option>Cash</option>
			<option>Credit</option>
		</select>

		<br>

		<input type="text" name="customer" placeholder="Customer ID"><br><br>

		<table>
			<tr>
				<th>#</th>
				<th>Code</th>
				<th>Name</th>
				<th>Price</th>
				<th>Quentity</th>
				<th>Discount</th>
				<th>Total</th>
				<th>Option</th>
			</tr>
			<tr>
				<td></td>
			</tr>
		</table>
		<br>
		<label>Total Ammount : </label>
		<input type="text" name="total_ammount"><br>
		<br>
		<input type="submit" name="pay" value="Pay">

	</form>

</body>
</html>