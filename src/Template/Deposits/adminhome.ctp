<?php  
/**
  * @var \App\View\AppView $this
  */
?>
<div class=" content">


<table cellpadding="0" cellspacing="0" style="background-color: aliceblue;" class="table table-striped">
		<thead class="bordered">
            <tr>
                <th scope="col" width="10%"></th>
                <th scope="col" width="45"><?= __('Enquêtes') ?></th>
                <th scope="col" width="25" style="text-align: center;"><?= __('Nbr total Dépôts') ?></th>
                <th scope="col" width="30" style="font-size: 80%;text-align: center;"><?= __('Nbr Dépôts depuis la dernière connexion') ?></th>
            </tr>
        </thead>
        <tbody>
        	<?php foreach ($domains as $dom): ?>


                <?php if(isset($srvs[$dom->ID])): ?>
                <tr>

                    <td style="background-color: aliceblue;" colspan="4">
                           Domaine - <?= $dom->name ?> : 
                    </td>

					<?php foreach ($srvs[$dom->ID] as $key => $srv): ?>
						<tr>
							<td style="text-align: center;align-items: center;align-content: center;"> 
                                    <i class="glyphicon glyphicon-asterisk"></i>
                            </td>
							<td> <?php echo $srv ?> </td>
							<td style="text-align: center;"> <?php echo $countAll[$key] ?> </td>
							<td style="text-align: center;"> <?php echo $countNew[$key] ?> </td>
						</tr>
					<?php endforeach; ?>
                    </td>
                </tr>
                <?php endif; ?>

        	<?php endforeach; ?>
        </tbody>
</table>
</div>