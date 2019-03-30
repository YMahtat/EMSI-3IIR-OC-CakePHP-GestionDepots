<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\DomainsUser[]|\Cake\Collection\CollectionInterface $domainsUsers
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Domains User'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Domains'), ['controller' => 'Domains', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Domain'), ['controller' => 'Domains', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="domainsUsers index large-9 medium-8 columns content">
    <h3><?= __('Domains Users') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('domain_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($domainsUsers as $domainsUser): ?>
            <tr>
                <td><?= $domainsUser->has('user') ? $this->Html->link($domainsUser->user->full, ['controller' => 'Users', 'action' => 'view', $domainsUser->user->ID]) : '' ?></td>
                <td><?= $domainsUser->has('domain') ? $this->Html->link($domainsUser->domain->name, ['controller' => 'Domains', 'action' => 'view', $domainsUser->domain->ID]) : '' ?></td>
                <td><?= h($domainsUser->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $domainsUser->user_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $domainsUser->user_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $domainsUser->user_id], ['confirm' => __('Are you sure you want to delete # {0}?', $domainsUser->user_id)]) ?>
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
