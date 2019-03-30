<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Domain[]|\Cake\Collection\CollectionInterface $domains
  */
?>

<div class="domains index  content">
    <h3>   <?= $this->html->image("domain.svg",["width"=>"7%"]) ?> &nbsp;    <?= __('Gestionnaire Domaines : ') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('#') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Dénomination Domaine') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($domains as $domain): ?>
            <tr>
                <td><?= $this->Number->format($domain->ID) ?></td>
                <td><?= h($domain->name) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Consulter'), ['action' => 'view', $domain->ID]) ?>
                    <br>
                    <?= $this->Html->link(__('Modifier'), ['action' => 'edit', $domain->ID]) ?>
                    <br>
                    <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $domain->ID], ['confirm' => __('Are you sure you want to delete # {0}?', $domain->ID)]) ?>
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