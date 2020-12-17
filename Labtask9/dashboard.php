<html>
	<head>
		<script>
			function addProduct()
			{
				var xhttp=new XMLHttpRequest();
				xhttp.onreadystatechange=function()
				{
					if(xhttp.readyState ==4 && xhttp.status==200)
					{
						document.getElementById("output").innerHTML=xhttp.responseText;
					}
				}
				xhttp.open("GET","addproduct.php",true);
				xhttp.send();
				
			}
			function allProducts()
			{
				var xhttp=new XMLHttpRequest();
				xhttp.onreadystatechange=function()
				{
					if(xhttp.readyState ==4 && xhttp.status==200)
					{
						document.getElementById("output").innerHTML=xhttp.responseText;
					}
				}
				xhttp.open("GET","allproducts.php",true);
				xhttp.send();
				
			}
		</script>
	</head>
	<body>
		<button  onclick="allProducts()">All Products</button>
		<button onclick="addProduct()">Add Product</button>
		<br>
		<div id="output">
		</div>
	</body>
</html>