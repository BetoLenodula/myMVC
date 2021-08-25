<table>
	<thead>
		<tr>
			<td>Dom</td>
			<td>Lun</td>
			<td>Mar</td>
			<td>Mié</td>
			<td>Jue</td>
			<td>Vie</td>
			<td>Sab</td>
		</tr>
	</thead>
	<tbody>
	<?= Classes\Calendar::create($arg[0], $arg[1])  ?>
	</tbody>
</table>