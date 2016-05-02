<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<table>
<thead>
<tr>
<th>Name</th>
<th>Label</th>
</tr>
</thead>
<tbody>
<?php 
foreach ($terms as $key=>$val)
{
?>
<tr>
<td><?php echo $val->name;?></td>
<td><input type="text" id="<?php echo $val->name;?>" name="<?php echo $thisRef.'['.$val->name.']' ;?>" value="<?php if(!empty($instanceRef[$val->name])){echo $instanceRef[$val->name];}?>"></td>
</tr>
<?php 
}
?>
</tbody>
</table>
