<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Center $center
  */
?>

<div class="centers view  content">
    <h3>   <?= $this->html->image("center.svg",["width"=>"7%"]) ?> &nbsp;  Centre ID : <?= h($center->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('CODE CENTRE :') ?></th>
            <td><?= $center->CODE ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('DENOMINATION CENTRE : ') ?></th>
            <td><?= h($center->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ville : ') ?></th>
            <td><?= h($center->city) ?></td>
        </tr>
        
        
    </table>
    <div class="related">
    <?php if (!empty($center->users)): ?>
        <h4><?= __('Opérateurs Liés : ') ?></h4>
        
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('#') ?></th>
                <th scope="col"><?= __('@-mail') ?></th>
                <th scope="col"><?= __('Téléphone') ?></th>
                <th scope="col"><?= __('ORG.') ?></th>
                <th scope="col"><?= __('NERC') ?></th>
                <th scope="col"><?= __('CNSS') ?></th>
                <th scope="col"><?= __('ICE') ?></th>
                <th scope="col"><?= __('Ville') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($center->users as $users): ?>
            <tr>
                <td><?= h($users->ID) ?></td>
                <td><?= h($users->email) ?></td>
                <td><?= h($users->phone) ?></td>

                <td><?= h($users->organization) ?></td>
                <td><?= h($users->NERC) ?></td>
                <td><?= h($users->CNSS) ?></td>
                <td><?= h($users->ICE) ?></td>
                <td><?= h($users->city) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Consulter'), ['controller' => 'Users', 'action' => 'view', $users->ID]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>


<script type="text/javascript">
        $(document).ready(
                        function()
                        { 

                            $(".view *").css("word-break","keep-all");
                            $(".view table").css("width","100%");
                            $(".view h4").css("text-align","center");
                        }
                     );
</script>