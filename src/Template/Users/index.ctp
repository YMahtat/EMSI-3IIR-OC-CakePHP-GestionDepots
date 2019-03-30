<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
  */
?>

<div class="users index content">

    <h3>  <?= $this->html->image("operators.svg",["width"=>"7%"]) ?> &nbsp;  <?= __('Gestionnaire Operateurs : ') ?></h3>
    <div>
        <?= $this->Form->create() ?>
        <fieldset>
            <legend>Filtrer : </legend>
            <div class="col-sm-8">
                <?php
                    echo $this->Form->control('organization', [ "label"=>"Nom d'organisme :",'type' => "text"]);  
                ?>
                <br>
            </div>
            <div class="col-sm-4">
                <label>&nbsp;</label>
                 <button type="submit" style="word-break: keep-all;line-height: 30%">Rechercher</button>            
            </div>
        </fieldset>
        <?= $this->Form->end() ?>
    </div>


    
    <table cellpadding="0" cellspacing="0" class="table table-striped">
        <thead>
            <tr style="width: 200%">
                <th style="width: 4%" scope="col"><?= $this->Paginator->sort('#') ?></th>
                <th style="width: 7%" scope="col"><?= $this->Paginator->sort('Nom') ?></th>
                <th style="width: 7%" scope="col"><?= $this->Paginator->sort('Prenom') ?></th>
                <th style="width: 16%" scope="col"><?= $this->Paginator->sort('@-mail') ?></th>
                <th style="width: 8%" scope="col"><?= $this->Paginator->sort('TEL') ?> .</th>
                <th style="width: 9%" scope="col"><?= $this->Paginator->sort('Centre') ?></th>
                <th style="width: 11%" scope="col"><?= $this->Paginator->sort('ORG') ?>.</th>
                <th style="width: 8%" scope="col"><?= $this->Paginator->sort('NERC') ?></th>
                <th style="width: 7%" scope="col"><?= $this->Paginator->sort('CNSS') ?></th>
                <th style="width: 7%" scope="col"><?= $this->Paginator->sort('ICE') ?></th>
                <th style="width: 7%" scope="col"><?= $this->Paginator->sort('VILLE') ?></th>
                <th  id="Actions" scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr >
                <td style="font-size: 60%;word-break: keep-all; "><?= h($user->ID) ?></td>
                <td style="font-size: 65%;word-break: keep-all; "><?= h($user->last_name) ?></td>
                <td style="font-size: 65%;word-break: keep-all; "><?= h($user->first_name) ?></td>
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
                <td style="font-size: 65%;word-break: keep-all; "><?= h($user->NERC) ?></td>
                <td style="font-size: 65%;word-break: keep-all; "><?= h($user->CNSS) ?></td>
                <td style="font-size: 65%;word-break: keep-all; "><?= h($user->ICE) ?></td>
                <td style="font-size: 60%;word-break: keep-all; "><?= h($user->city) ?></td>
                <td style="font-size: 65%;word-break: keep-all; " class="actions">
                    <?= $this->Html->link(__('Consulter'), ['action' => 'view', $user->ID]) ?>
                    <br>
                    <?= $this->Html->link(__('Modifier'), ['action' => 'edit', $user->ID]) ?>
                    <br>
                    <?= $this->Html->link(__('Modifier Password'), ['action' => 'addnewpassword', $user->ID]) ?>
                    <br>
                    <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $user->ID], ['confirm' => __('Are you sure you want to delete # {0}?', $user->ID)]) ?>    
                </td>
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
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>


<style type="text/css">
    div 
    {
        text-align: justify;
        text-justify: inter-word;
    }
    button
    {
        size: 80%;

    }

</style>

