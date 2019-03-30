<?php
use Cake\I18n\Time;
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Log[]|\Cake\Collection\CollectionInterface $logs
  */
?>

<div class="logs index  content">
    <h3><?= __('JOURNAL : ') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('#') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Utilisateurs') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Connexion') ?></th>
                <th scope="col"><?= $this->Paginator->sort('MàJ') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Déconnexion') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($logs as $log): ?>
            <tr>
                <td><?= $this->Number->format($log->ID) ?></td>
                <td>
                    <?= $this->Html->link(__("ID : ".$log->user->ID."  -    ".$log->user->email ), ['controller' => 'Users', 'action' => 'view',$log->user->ID]) ?>
                </td>
                <td><?= h($log->created->i18nFormat('dd/MM/yyyy - HH:mm:ss')) ?></td>
                <td><?= h($log->updated->i18nFormat('dd/MM/yyyy - HH:mm:ss')) ?></td>
                <td><?php if(isset($log->deconnected)){echo $log->deconnected->i18nFormat('dd/MM/yyyy - HH:mm:ss');} ?></td>
               
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