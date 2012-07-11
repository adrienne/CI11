
<div class="view split-view">
	
	<!-- ContentItem List -->
	<div class="view">
	
	<?php if (isset($records) && is_array($records) && count($records)) : ?>
		<div class="scrollable">
			<div class="list-view" id="role-list">
				<?php foreach ($records as $record) : ?>
					<?php $record = (array)$record;?>
					<div class="list-item" data-id="<?php echo $record['id']; ?>">
						<p>
							<b><?php echo (empty($record['contentitem_name']) ? $record['id'] : $record['contentitem_name']); ?></b><br/>
							<span class="small"><?php echo (empty($record['contentitem_description']) ? lang('contentitem_edit_text') : $record['contentitem_description']);  ?></span>
						</p>
					</div>
				<?php endforeach; ?>
			</div>	<!-- /list-view -->
		</div>
	
	<?php else: ?>
	
	<div class="notification attention">
		<p><?php echo lang('contentitem_no_records'); ?> <?php echo anchor(SITE_AREA .'/content/contentitem/create', lang('contentitem_create_new'), array("class" => "ajaxify")) ?></p>
	</div>
	
	<?php endif; ?>
	</div>
	<!-- ContentItem Editor -->
	<div id="content" class="view">
		<div class="scrollable" id="ajax-content">
				
			<div class="box create rounded">
				<a class="button good ajaxify" href="<?php echo site_url(SITE_AREA .'/content/contentitem/create')?>"><?php echo lang('contentitem_create_new_button');?></a>

				<h3><?php echo lang('contentitem_create_new');?></h3>

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
<?php
foreach ($records as $record) : ?>
			<tr>
				<td><?php echo $record->contentitem_teaser?></td>
				<td><?php echo $record->contentitem_body?></td>
				<td><?php echo $record->created_on?></td>
				<td><?php echo $record->modified_on?></td>
				<td><?php echo anchor(SITE_AREA .'/content/contentitem/edit/'. $record->id, lang('contentitem_edit'), 'class="ajaxify"'); ?></td>
			</tr>
<?php endforeach; ?>
		</tbody>
	</table>
				<?php endif; ?>
				
		</div>	<!-- /ajax-content -->
	</div>	<!-- /content -->
</div>
