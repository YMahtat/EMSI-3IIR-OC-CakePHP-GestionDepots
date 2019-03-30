<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
  */
?>

<div class="users index  content">


<h3><?= $this->html->image("admin.png",["width"=>"7%"]) ?> &nbsp;    <?= __('Gestionnaire Administrateurs : ') ?></h3>
<br>
    <table cellpadding="0" cellspacing="0" class="table table-striped">
        <thead>
            <tr>
                <th style="width: 6%" scope="col"><?= $this->Paginator->sort('#') ?></th>
                <th style="width: 12%" scope="col"><?= $this->Paginator->sort('NOM : ') ?></th>
                <th style="width: 12%" scope="col"><?= $this->Paginator->sort('PRENOME : ') ?></th>
                <th scope="col"><?= $this->Paginator->sort('@-mail : ') ?></th>
                <th style="width: 15%" scope="col"><?= $this->Paginator->sort('TELEPHONE : ') ?></th>

                <th style="width: 9%" scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td style="word-break: keep-all; "><?= h($user->ID) ?></td>
                <td style="word-break: keep-all; "><?= h($user->last_name) ?></td>
                <td style="word-break: keep-all; "><?= h($user->first_name) ?></td>
                <td style="word-break: keep-all; "><?= h($user->email) ?></td>
                <td style="word-break: keep-all; "><?= h($user->phone) ?></td>

                <td class="actions">
                     <?= $this->Html->link(__('Consulter'), ['action' => 'view', $user->ID]) ?>
                    <br>
                    <?= $this->Html->link(__('Modifier'), ['action' => 'edit', $user->ID]) ?>
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
</style>