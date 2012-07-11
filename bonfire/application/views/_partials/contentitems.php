
<?php if (isset($records) && is_array($records) && count($records)) : ?>

<h2>Content Items</h2>
<table>
	<thead>
		<tr>
			<th>Teaser</th>
			<th>Body</th>
			<th>&nbsp;</th>
			<th>Created</th>
			<th>&nbsp;</th>
			<th>Modified</th>
		</tr>
	</thead>
	<tbody>

		<?php foreach ($records as $record) : ?>
		<tr>
			<td><?php echo $record->contentitem_teaser ?></td>
			<td><?php echo $record->contentitem_body ?></td>
			<td>&nbsp;</td>
			<td><?php echo $record->created_on ?></td>
			<td>&nbsp;</td>
			<td><?php echo $record->modified_on ?></td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<?php endif; ?>