<?php

	$s="localhost";
	$u="root";
	$p="";
	$d="dummy_project";
	$conn=mysqli_connect($s,$u,$p,$d);
	$rs=mysqli_query($conn,"SELECT * FROM products");
	
?>
<html>
	<body>
		<table border="1">
			
				<?php
					while($row=mysqli_fetch_assoc($rs))
					{
						echo "<tr>";
						echo "<td>".$row["id"]."</td>";
						echo "<td>".$row["name"]."</td>";
						echo "</tr>";
						
					}
				?>
			
		</table>
	</body>
</html>