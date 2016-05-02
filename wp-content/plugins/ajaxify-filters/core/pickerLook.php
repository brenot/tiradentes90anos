<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<table class="ccas_widget_table">
<thead>
<tr>
<th>Name</th>
<th>Color Code</th>
</tr>
</thead>
<tbody>
<?php
foreach ($terms as $key=>$val)
{
?>
<tr>
<td><?php echo $val->name;?></td>
<td width="70%" >
	<input type="text" readOnly id="<?php echo $val->name.'valueInput';?>" name="<?php echo $thisRef.'['.$val->name.'_colorVal]' ;?>" value="<?php if(!empty($instanceRef[$val->name.'_colorVal'])){echo $instanceRef[$val->name.'_colorVal'];}else{ echo "#ff6699";}?>">
</td>
<td>
	<div class="ccas_colorPicker_div" id='<?php echo $val->name.'colorPicker';?>'  style="background-color:<?php if(!empty($instanceRef[$val->name.'_colorVal'])){echo $instanceRef[$val->name.'_colorVal'];}else{ echo "#ff6699";}?>"></div>
</td>
</tr>
<?php 
}
?>
</tbody>
</table>
