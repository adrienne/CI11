
<?php if (validation_errors()) : ?>
<div class="notification error">
	<?php echo validation_errors(); ?>
</div>
<?php endif; ?>
<?php // Change the css classes to suit your needs    
if( isset($todo) ) {
	$todo = (array)$todo;
}
$id = isset($todo['id']) ? "/".$todo['id'] : '';
?>
<?php echo form_open($this->uri->uri_string(), 'class="constrained ajax-form"'); ?>
<?php if(isset($todo['id'])): ?><input id="id" type="hidden" name="id" value="<?php echo $todo['id'];?>"  /><?php endif;?>
<div>
        <?php echo form_label('Description', 'todo_description'); ?>
        <input id="todo_description" type="text" name="todo_description" maxlength="255" value="<?php echo set_value('todo_description', isset($todo['todo_description']) ? $todo['todo_description'] : ''); ?>"  />
</div>

<div>
        <?php echo form_label('Person', 'todo_person'); ?>
        <input id="todo_person" type="text" name="todo_person" maxlength="255" value="<?php echo set_value('todo_person', isset($todo['todo_person']) ? $todo['todo_person'] : ''); ?>"  />
</div>



	<div class="text-right">
		<br/>
		<input type="submit" name="submit" value="Create ToDo" /> or <?php echo anchor(SITE_AREA .'/developer/todo', lang('todo_cancel')); ?>
	</div>
	<?php echo form_close(); ?>
