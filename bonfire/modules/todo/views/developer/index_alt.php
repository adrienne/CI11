
<div class="view split-view">
	
	<!-- ToDo List -->
	<div class="view">
	
	<?php if (isset($records) && is_array($records) && count($records)) : ?>
		<div class="scrollable">
			<div class="list-view" id="role-list">
				<?php foreach ($records as $record) : ?>
					<?php $record = (array)$record;?>
					<div class="list-item" data-id="<?php echo $record['id']; ?>">
						<p>
							<b><?php echo (empty($record['todo_name']) ? $record['id'] : $record['todo_name']); ?></b><br/>
							<span class="small"><?php echo (empty($record['todo_description']) ? lang('todo_edit_text') : $record['todo_description']);  ?></span>
						</p>
					</div>
				<?php endforeach; ?>
			</div>	<!-- /list-view -->
		</div>
	
	<?php else: ?>
	
	<div class="notification attention">
		<p><?php echo lang('todo_no_records'); ?> <?php echo anchor(SITE_AREA .'/developer/todo/create', lang('todo_create_new'), array("class" => "ajaxify")) ?></p>
	</div>
	
	<?php endif; ?>
	</div>
	<!-- ToDo Editor -->
	<div id="content" class="view">
		<div class="scrollable" id="ajax-content">
				
			<div class="box create rounded">
				<a class="button good ajaxify" href="<?php echo site_url(SITE_AREA .'/developer/todo/create')?>"><?php echo lang('todo_create_new_button');?></a>

				<h3><?php echo lang('todo_create_new');?></h3>

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
<?php
foreach ($records as $record) : ?>
			<tr>
				<td><?php echo $record->todo_description?></td>
				<td><?php echo $record->todo_person?></td>
				<td><?php echo $record->created_on?></td>
				<td><?php echo $record->modified_on?></td>
				<td><?php echo anchor(SITE_AREA .'/developer/todo/edit/'. $record->id, lang('todo_edit'), 'class="ajaxify"'); ?></td>
			</tr>
<?php endforeach; ?>
		</tbody>
	</table>
				<?php endif; ?>
				
		</div>	<!-- /ajax-content -->
	</div>	<!-- /content -->
</div>
