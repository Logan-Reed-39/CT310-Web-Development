<html>
	<body>
		<table>
				<thead>
					<tr>
						<th>Content</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($rows as $row) {?>
					<tr>
						<td><?php echo $row; ?></td>
					</tr>
					<?php } ?>
				</tbody>
		</table>
	</body>
</html>
