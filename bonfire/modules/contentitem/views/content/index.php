<div class="box create rounded">

	<a class="button good" href="<?php echo site_url(SITE_AREA .'/content/contentitem/create'); ?>">
		<?php echo lang('contentitem_create_new_button'); ?>
	</a>

	<h3><?php echo lang('contentitem_create_new'); ?></h3>

	<p><?php echo lang('contentitem_edit_text'); ?></p>

</div>

<br />

<?php if (isset($records) && is_array($records) && count($records)) : ?>
				
	<h2>ContentItem</h2>
	<table>
		<thead>
			<tr>
			
		<th>Teaser</th>
		<th>Body</th>
		<th>Created</th>
		<th>Modified</th>
		
			<th><?php echo lang('contentitem_actions'); ?></th>
			</tr>
		</thead>
		<tbody>
		
		<?php foreach ($records as $record) : ?>
			<tr>
				
				<td><?php echo $record->contentitem_teaser?></td>
				<td><?php echo $record->contentitem_body?></td>
				<td><?php echo $record->created_on?></td>
				<td><?php echo $record->modified_on?></td>
				<td><?php echo anchor(SITE_AREA .'/content/contentitem/edit/'. $record->id, lang('contentitem_edit'), '') ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php endif; ?>