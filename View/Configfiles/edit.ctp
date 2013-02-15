<h1><?php echo __('Edit: ').$configfile['filename'];?></h1>
<p>
	<?php echo __('File last modified: %s',date('d-m-Y H:i:s',$configfile['modified']));?>
</p>
<p>
	<?php
	$syntaxcheck = '<font color="red"><b>Error in syntax</b></font>';
	if($configfile['syntaxcheck']){
		$syntaxcheck = '<font color="green"><b>Syntax OK</b></font>';
	}
	echo __('File syntax status is: %s',$syntaxcheck);
	?>
</p>
<?php
echo $this->Form->create('Configfileholder');
?>
<p>
	<?php 
		echo $this->Html->link(__('Back'), array('plugin'=>'config_edit','controller'=>'configfiles','action'=>'index') ,array('class'=>'btn btn-small'));
		echo "&nbsp;"; 
		echo $this->Form->button(__('Save'),array('type'=>'submit','class'=>'btn btn-small btn-success'));
	?>

</p>
<?php 

	echo $this->Form->input('contents',array('label'=>'', 'type'=>'textarea','value'=>$configfile['contents'],'rows'=>25,'cols'=>$configfile['cols'],'style'=>'width:auto;font-family:"courier new";'));

	echo $this->Html->link(__('Back'), array('plugin'=>'config_edit','controller'=>'configfiles','action'=>'index') ,array('class'=>'btn btn-small'));
	echo "&nbsp;";
	echo $this->Form->button(__('Save'),array('type'=>'submit','class'=>'btn btn-small btn-success'));

echo $this->Form ->end();
?>