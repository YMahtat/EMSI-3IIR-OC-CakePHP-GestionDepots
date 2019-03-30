<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Survey[]|\Cake\Collection\CollectionInterface $surveys
  */
?>

<div class="surveys index  content">
    <h3>    <?= $this->html->image("survey.svg",["width"=>"7%"]) ?> &nbsp;    <?= __("Gestionnaire des Formulaires d'Enquêtes : ") ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('#') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Domaine') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Dénomination') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Périodicité') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($surveys as $survey): ?>
            <tr>
                <td><?= $this->Number->format($survey->ID) ?></td>
                <td><?= $survey->has('domain') ? $this->Html->link($survey->domain->name, ['controller' => 'Domains', 'action' => 'view', $survey->domain->ID]) : '' ?></td>
                <td><?= h($survey->name) ?></td>
                <td style="text-align: center;"><?= $this->Number->format($survey->periodicity) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Consulter'), ['action' => 'view', $survey->ID]) ?>
                    <br>
                    <?= $this->Html->link(__('Modifier'), ['action' => 'edit', $survey->ID]) ?>
                    <br>
                    <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $survey->ID], ['confirm' => __('Are you sure you want to delete # {0}?', $survey->ID)]) ?>
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