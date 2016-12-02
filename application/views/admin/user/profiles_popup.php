	<?php foreach($profiles as $profile){ ?>
		<h3>Permisos <?php echo $profile->profile; ?></h3>
		 <hr>
		 <table class="table table-striped text-left">
		 	<tr>
		 		<th>Accesos:</th>
		 		<td><b  <?php echo $profile->description; ?></b></td>
		 	</tr>
		 </table>
     <?php } ?>