<h1><?php echo $configfile['filename'];?></h1>
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
<p>
	<?php echo $this->Html->link(__('Back'), array('plugin'=>'config_edit','controller'=>'configfiles','action'=>'index') ,array('class'=>'btn btn-small')); ?>
</p>
<pre>
<?php echo $configfile['contents'];?>
</pre>