<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\DomainsUser $domainsUser
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Domains User'), ['action' => 'edit', $domainsUser->user_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Domains User'), ['action' => 'delete', $domainsUser->user_id], ['confirm' => __('Are you sure you want to delete # {0}?', $domainsUser->user_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Domains Users'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Domains User'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Domains'), ['controller' => 'Domains', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Domain'), ['controller' => 'Domains', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="domainsUsers view large-9 medium-8 columns content">
    <h3><?= h($domainsUser->user_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $domainsUser->has('user') ? $this->Html->link($domainsUser->user->full, ['controller' => 'Users', 'action' => 'view', $domainsUser->user->ID]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Domain') ?></th>
            <td><?= $domainsUser->has('domain') ? $this->Html->link($domainsUser->domain->name, ['controller' => 'Domains', 'action' => 'view', $domainsUser->domain->ID]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($domainsUser->created) ?></td>
        </tr>
    </table>
</div>
