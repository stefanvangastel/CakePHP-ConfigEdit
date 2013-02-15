<h1><?php echo __('Config files');?></h1>

<table class="table table-hover table-condesed">
	<tr>
		<th><?php echo __('Config filename');?></th>
		<th><?php echo __('Status');?></th>
		<th><?php echo __('Last modified');?></th>
		<th><?php echo __('Actions');?></th>
	</tr>
	<?php 
	foreach($configfiles as $configfile){
	?>
	<tr>
		<td>
			<b><?php echo $configfile['filename']; ?></b>
		</td>
		<td>
			<?php 
			if($configfile['syntaxcheck']){
				echo '<font color="green"><b>Syntax OK</b></font>';
			}else{
				echo '<font color="red"><b>Error in syntax</b></font>';
			}
			?>
		</td>
		<td>
			<?php echo date('d-m-Y H:i:s',$configfile['modified']); ?>
		</td>
		<td>
			<div class="btn-group">
				<?php echo $this->Html->link(__('View'), array('plugin'=>'config_edit','controller'=>'configfiles','action'=>'view',base64_encode($configfile['path'])) ,array('class'=>'btn btn-small btn-success')); ?>
				<?php echo $this->Html->link(__('Edit'), array('plugin'=>'config_edit','controller'=>'configfiles','action'=>'edit',base64_encode($configfile['path'])) ,array('class'=>'btn btn-small btn-warning')); ?>
			</div>
		</td>
	</tr>
	<?php 
	}
	?>
</table>