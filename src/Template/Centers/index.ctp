<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Center[]|\Cake\Collection\CollectionInterface $centers
  */
?>

<div class="centers index  content">
    <h3>   <?= $this->html->image("center.svg",["width"=>"7%"]) ?> &nbsp;    <?= __('Gestionnaire Centres : ') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('#') ?></th>
                <th scope="col"><?= $this->Paginator->sort('CODE') ?></th>
                <th scope="col"><?= $this->Paginator->sort('DENOMINATION DU CENTRE') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Ville') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($centers as $center): ?>
            <tr>
                <td><?= $center->id ?></td>
                <td><?= $center->CODE ?></td>
                <td><?= h($center->name) ?></td>
                <td><?= h($center->city) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Consulter'), ['action' => 'view', $center->id]) ?>
                    <br>
                    <?= $this->Html->link(__('Modifier'), ['action' => 'edit', $center->id]) ?>
                    <br>
                    <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $center->id], ['confirm' => __('Are you sure you want to delete # {0}?', $center->id)]) ?>
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


<script type="text/javascript">
        $(document).ready(
                        function()
                        { 

                            $(".index *").css("word-break","keep-all");
                            $(".index table").css("width","100%");
                            $(".index h4").css("text-align","center");
                        }
                     );
</script>