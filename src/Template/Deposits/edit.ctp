<?php
/**
  * @var \App\View\AppView $this
  */
?>

<div class="deposits form large-9 medium-8 columns content">
    <?= $this->Form->create($deposit) ?>
    <fieldset>
        <legend><?= __('Edit Deposit') ?></legend>
        <?php
            echo $this->Form->control('survey_id', ['options' => $surveys]);
            echo $this->Form->control('user_id', ['options' => $users]);
            echo $this->Form->control('deposit_year');
            echo $this->Form->control('period');
            echo $this->Form->control('deposit_type');
            echo $this->Form->control('url');
            echo $this->Form->control('comment');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
