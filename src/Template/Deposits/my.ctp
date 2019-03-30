<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Deposit[]|\Cake\Collection\CollectionInterface $deposits
  */
?>

<div class="deposits index  content" id="ALL">

    <h3> <?= $this->html->image("depositsList.svg",["width"=>"7%"]) ?> &nbsp;   <?= __('Liste Depôts : ') ?></h3>
    <table width="100%" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('#') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Enquete') ?></th>
                <th scope="col" style="text-align: center;"><?= $this->Paginator->sort('Année') ?></th>
                <th scope="col" style="text-align: center;"><?= $this->Paginator->sort('période' ) ?></th>
                <th scope="col" style="text-align: center;"><?= $this->Paginator->sort('TYPE' ) ?></th>
                <th scope="col" style="text-align: center;"><?= $this->Paginator->sort('DATE & HEURE DEPOT') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($deposits as $deposit): ?>
            <tr>
                <td><?= $this->Number->format($deposit->ID) ?></td>
                <td>
                    <?= $deposit->survey->name ?> 
                </td>

                <td style="text-align: center;"><?= $deposit->deposit_year ?></td>
                <td style="text-align: center;"><?= $this->Number->format($deposit->period) ?></td>
                <td style="text-align: center;"><?= h($deposit->deposit_type) ?></td>
                <td style="text-align: center;"><?= h($deposit->created->i18nFormat('dd-MM-yyyy HH:mm:ss')) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Consulter'), ['action' => 'view', $deposit->ID]) ?>
                    <br>
                    <?= $this->Html->link(__('RECTIFIER'), ['action' => 'add', "modif"]) ?>
                    
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
    $(document).ready(function(){ $("#ALL *").css("word-break","keep-all"); });
</script>