<?php ?>

<div   class="content">
	<div style=" text-align: center;width: 100%" >
	<h6 style="text-align: left;width: 100%">&nbsp;&nbsp;&nbsp; 
	 <a href="<?= $this->Url->build('/'); ?>">
		<?= $this->Html->image("OC_GD_Y.png",["width"=>"30%"]) ?>
	</a> 
	</h6>
		<br> <br>
		<h2 style="text-align: left;width: 100%">&nbsp;&nbsp;&nbsp;
			<?= $this->Html->image("warning.png",["width"=>"4%"]) ?>
			mot de passe oublié ?
			
		</h2>
		<hr>
		<div class="row"></div>
		
		<div class="col-sm-2"></div>
		<div style="height: 100%;width: 100%;padding-bottom: 0px;margin-bottom: 0px;width: 68%" class="col-sm-8">
			<p style="font-size: 120%">
			<strong>Ce service et une plateforme de dépots d'enquêtes , et il est destiné aux employés de l'Office des Changes et aux collaborateurs (opérateurs) .</strong>
			<br>
			<br>
			<strong>Si vous n'avez plus accèss à votre compte, </strong>
			veuillez contacter l'Administrateur de la plateforme WEB ou l'un des responsables suivants : 
			</p>

			<table cellpadding="0" cellspacing="0" class="table table-striped">
			        <thead>
			            <tr>
			                <th style="width: 20%" scope="col"><?= $this->Paginator->sort('NOM : ') ?></th>
			                <th style="width: 20%" scope="col"><?= $this->Paginator->sort('PRENOME : ') ?></th>
			                <th scope="col">
			                	<i class="glyphicon glyphicon-envelope"></i>
			                	<?= $this->Paginator->sort('@-mail : ') ?>
			                		
			               	</th>
			                <th style="width: 23%" scope="col">
			                	<i class="glyphicon glyphicon-phone-alt"></i>
			                	<?= $this->Paginator->sort('TELEPHONE : ') ?>
			                		
			                </th>
			            </tr>
			        </thead>
			        <tbody>
			            <?php foreach ($users as $user): ?>
			            <tr>
			                <td style="word-break: keep-all; "><?= h($user->last_name) ?></td>
			                <td style="word-break: keep-all; "><?= h($user->first_name) ?></td>
			                <td style="word-break: keep-all; "><?= h($user->email) ?></td>
			                <td style="word-break: keep-all; "><?= h($user->phone) ?></td>

			            </tr>
			            <?php endforeach; ?>
			        </tbody>
			    </table>




			    <div class="paginator">
			        <ul class="pagination">
			            <?= $this->Paginator->first('<< ' . __('first')) ?>
			            <?= $this->Paginator->prev('< ' . __('previous')) ?>
			            <?= $this->Paginator->numbers() ?>
			            <?= $this->Paginator->next(__('next') . ' >') ?>
			            <?= $this->Paginator->last(__('last') . ' >>') ?>
			        </ul>
			    </div>




		</div>
		<div class="col-sm-2"></div>
		<hr>
	</div>
</div>


<style type="text/css">
    div 
    {
        text-align: justify;
        text-justify: inter-word;
    }
</style>  

<!-- <script type="text/javascript">
	 $(document).ready(
                        function()
                        {

                            $("#content").css("background-color","#BBCBE0");
                            $("#content div").css("background-color","#BBCBE0");

                        }
                     );
</script> -->