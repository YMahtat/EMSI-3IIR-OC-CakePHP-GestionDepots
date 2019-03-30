
<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div style="text-align: center;" class="message error bg-danger" onclick="this.classList.add('hidden');">
	<table style="width: 100%;text-align: center;" class="message error bg-danger">
		<td style="text-align: center;width: 95%" ><?= $message ?></td>
		<td style="text-align: center;width: 5%"><i class="glyphicon glyphicon-remove"></i></td>
	</table>
		
</div>
