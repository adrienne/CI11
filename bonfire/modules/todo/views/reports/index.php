<div class="box create rounded">

	<a class="button good" href="<?php echo site_url(SITE_AREA .'/reports/todo/create'); ?>">
		<?php echo lang('todo_create_new_button'); ?>
	</a>

	<h3><?php echo lang('todo_create_new'); ?></h3>

	<p><?php echo lang('todo_edit_text'); ?></p>

</div>

<br />

<?php if (isset($records) && is_array($records) && count($records)) : ?>
				
	<h2>ToDo</h2>
	<table>
		<thead>
			<tr>
			
		<th>Description</th>
		<th>Person</th>
		<th>Created</th>
		<th>Modified</th>
		
			<th><?php echo lang('todo_actions'); ?></th>
			</tr>
		</thead>
		<tbody>
		
		<?php foreach ($records as $record) : ?>
			<tr>
				
				<td><?php echo $record->todo_description?></td>
				<td><?php echo $record->todo_person?></td>
				<td><?php echo $record->created_on?></td>
				<td><?php echo $record->modified_on?></td>
				<td><?php echo anchor(SITE_AREA .'/reports/todo/edit/'. $record->id, lang('todo_edit'), '') ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php endif; ?>