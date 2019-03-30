<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
  */
?>

<div class="users index content">
<h3> &nbsp; <?= $this->html->image("non_repondant2.png",["width"=>"7%"]) ?> &nbsp;    <?= __('Gestionnaire Operateurs non répondants : ') ?></h3>
    <?= $this->Form->create() ?>
    <fieldset>
        <h5>Filtrer (par enquête) : </h5>
        <?= $this->Form->control('survey_id',["label"=>"Enquêtes : ","options"=>$surveys,"empty"=>true,"required"=>true]); ?>
        <?= $this->Form->button(__('Rechercher')) ?>
    </fieldset>
    <?= $this->Form->end() ?>
    
<?php if(isset($users)){ ?>
    <h3> Liste des Opérateurs (non répondant) :</h3>
    <div style="font-size: 85%">
        <?= "( Enquête : ".$survey->name." | Périodicité : ".$survey->periodicity." | ".(12/$survey->periodicity)." Enquête(s) par an )" ?>
    </div>
    <table cellpadding="0" cellspacing="0" class="table table-striped">
        <thead>
            <tr>
                <th style="width: 4%" scope="col"><?= $this->Paginator->sort('#') ?></th>
                <th style="width: 17%" scope="col"><?= $this->Paginator->sort('@-mail') ?></th>
                <th style="width: 9%" scope="col"><?= $this->Paginator->sort('TEL') ?> .</th>
                <th style="width: 10%" scope="col"><?= $this->Paginator->sort('Centre') ?></th>
                <th style="width: 10%" scope="col"><?= $this->Paginator->sort('ORG') ?>.</th>
                <th style="width: 7%" scope="col"><?= $this->Paginator->sort('ICE') ?></th>
                <th style="width: 8%" scope="col"><?= $this->Paginator->sort('VILLE') ?></th>
                <th style="width: 20%"> liste non réponse : </th>
                <th style="width: 7%" scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>

            <?php 
                    foreach ($users as $user):
                    if (isset($data[$user->ID])) 
                    {
            ?>
            <tr >
                <td style="font-size: 60%;word-break: keep-all; "><?= h($user->ID) ?></td>

                <td style="font-size: 70%;word-break: keep-all; "><?= h($user->email) ?></td>
                <td style="font-size: 65%;word-break: keep-all; "><?= h($user->phone) ?></td>
                <td style="font-size: 65%;word-break: keep-all;">
                    <?= $user->has('center') ? $this->Html->link($user->center->CODE, ['controller' => 'Centers', 'action' => 'view', $user->center->id]) : '' ?>
                    <p style="font-size: 80%"> 
                        <?= $user->center->name?>
                        <br>
                        <?= $user->center->city?>
                    </p>
                </td>
                <td >
                    <p style="font-size: 65%;  word-break: keep-all; ">
                        <?= h($user->organization) ?>
                    </p>
                    
                </td>
                <td style="font-size: 65%;word-break: keep-all; "><?= h($user->ICE) ?></td>
                <td style="font-size: 60%;word-break: keep-all; "><?= h($user->city) ?></td>
                <td style="font-size: 80%;word-break: keep-all;">
                <?php
                    foreach ($data[$user->ID] as $key => $value) 
                    {
                       echo "Année ".$key." : ".$value;
                       echo "<br>";   
                    }  
                ?>
                </td>
                <td style="font-size: 70%;word-break: keep-all; " class="actions">
                    <?= $this->Html->link(__('Consulter'), ["controller"=>"Users",'action' => 'view', $user->ID]) ?>
                </td>
            </tr>
            <?php
                    } 
                    endforeach; 
            ?>

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
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
<?php } ?>

<style type="text/css">
    div 
    {
        text-align: justify;
        text-justify: inter-word;
    }
</style>