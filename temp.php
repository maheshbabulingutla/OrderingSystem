<?Php

global $con1;

					$ip = getIP();
					$sel_price = "select * from cart where ip_add='$ip'";
					$run_price = mysqli_query($con1,$sel_price);
					while($p_price = mysqli_fetch_array($run_price)){
					global $con;
						$pro_id = $p_price['p_id'];
						$qty = $p_price['qty'];
						$run_pro_price = mysql_query("SELECT * FROM parts where number = '$pro_id'");
										while($pp_price = mysql_fetch_array($run_pro_price)){
											$product_price = array($pp_price['price']);

											$product_desc = $pp_price['description'];

											$single_price = $pp_price['price'];

											$values = array_sum($product_price);
											$total += $values;
										
											
									
									?>

									<tr align="center">
										<td><?php echo $pro_id;?>"/></td>
										<td><?php echo $product_desc; ?><br</td>
										<td><?php echo $qty;?></td>

										
										<?php } 

										$total = $total*$qty;
										?>
										<td><?php echo $total;?></td>


											
	