<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div style="text-align: center;" class="message success bg-success" onclick="this.classList.add('hidden')">
	<table style="text-align: center;width: 100%" class="message success bg-success">
		<td style="text-align: center;width: 95%" ><?= $message ?></td>
		<td style="text-align: center;width: 5%"><i class="glyphicon glyphicon-remove"></i></td>
	</table>
</div>
