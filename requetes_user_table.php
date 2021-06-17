<?php

function displayTable($rows, $headers)
{
?>
	<table class="table table-bordered" id="table-users">
		<thead>
	      <tr>
	        <?php foreach ($headers as $header) : ?>
				<th><?php echo $header; ?></th>
			<?php endforeach; ?>
	      </tr>
	    </thead>

	    <tbody>
	    <?php foreach ($rows as $row) : ?>
			<tr>
				<?php for ($k = 0; $k < count($headers); $k++) : ?>
					<?php switch ($k)  {
						case 0 :
							echo '<td data-label="modifier/supprimer"><a href=form_user.php?id=' . $row[$k] . ' ><i class="fa fa-pencil-square-o"></i></a></td>';
							break;
						case 1 :
							echo '<td data-label="username">'.$row[$k].'</td>';
							break;
						case 2 :
							echo '<td data-label="email">'.$row[$k].'</td>';
							break;
						case 3 :
							echo '<td data-label="admin">'.$row[$k].'</td>';
							break;
						default :
							echo '<td>erreur</td>';
						}
					endfor; ?>
			</tr>
		<?php endforeach; ?>
	    </tbody>

	</table>
<?php

}

function getHeaderTable()
{
	$headers = array();
	$headers[] = "modifier/Supprimer";
	$headers[] = "username";
	$headers[] = "email";
	$headers[] = "admin";


	return $headers;
}


?>
