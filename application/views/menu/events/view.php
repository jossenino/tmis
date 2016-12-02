	<?php foreach($events as $event){ ?>
		<h3><?php echo $event->title; ?></h3>
		 <hr>
		 <table class="table table-striped text-left">
		 	<tr>
		 		<th>Url evento:</th>
		 		<td><a href="<?php echo $event->url; ?>"> Enlace </a></td>
		 	</tr>
		 	<tr>
		 		<th>Cuerpo</th>
		 		<td><?php echo $event->body; ?></td>
		 	</tr>
		 </table>
     <?php } ?>