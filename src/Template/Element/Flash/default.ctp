<?php
$class = 'message';
if (!empty($params['class'])) {
    $class .= ' ' . $params['class'];
}
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div class="<?= h($class) ?>" onclick="this.classList.add('hidden');">
	<table style="width: 100%;text-align: center;" class=" message success bg-info">
		<td style="text-align: center;width: 95%" ><?= $message ?></td>
		<td style="text-align: center;width: 5%"><i class="glyphicon glyphicon-remove"></i></td>
	</table>
	
</div>
