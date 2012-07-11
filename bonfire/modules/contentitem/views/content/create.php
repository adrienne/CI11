
<?php if (validation_errors()) : ?>
<div class="notification error">
	<?php echo validation_errors(); ?>
</div>
<?php endif; ?>
<?php // Change the css classes to suit your needs    
if( isset($contentitem) ) {
	$contentitem = (array)$contentitem;
}
$id = isset($contentitem['id']) ? "/".$contentitem['id'] : '';
?>
<?php echo form_open($this->uri->uri_string(), 'class="constrained ajax-form"'); ?>
<?php if(isset($contentitem['id'])): ?><input id="id" type="hidden" name="id" value="<?php echo $contentitem['id'];?>"  /><?php endif;?>
<div>
        <?php echo form_label('Teaser', 'contentitem_teaser'); ?> <span class="required">*</span>
        <input id="contentitem_teaser" type="text" name="contentitem_teaser" maxlength="255" value="<?php echo set_value('contentitem_teaser', isset($contentitem['contentitem_teaser']) ? $contentitem['contentitem_teaser'] : ''); ?>"  />
</div>

<div>
        <?php echo form_label('Body', 'contentitem_body'); ?>
	<?php echo form_textarea( array( 'name' => 'contentitem_body', 'id' => 'contentitem_body', 'rows' => '5', 'cols' => '80', 'value' => set_value('contentitem_body', isset($contentitem['contentitem_body']) ? $contentitem['contentitem_body'] : '') ) )?>
</div>


	<div class="text-right">
		<br/>
		<input type="submit" name="submit" value="Create ContentItem" /> or <?php echo anchor(SITE_AREA .'/content/contentitem', lang('contentitem_cancel')); ?>
	</div>
	<?php echo form_close(); ?>
