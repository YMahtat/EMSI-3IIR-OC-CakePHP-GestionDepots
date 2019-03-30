<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Domain $domain
  */
?>

<div class="domains view  content">
    <h3>    <?= $this->html->image("domain.svg",["width"=>"7%"]) ?> &nbsp;    Domaine : </h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Dénomination : ') ?></th>
            <td><?= h($domain->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('#') ?></th>
            <td><?= $this->Number->format($domain->ID) ?></td>
        </tr>
    </table>
    <div class="related">
    <?php if (!empty($domain->surveys)): ?>
        <h4><?= __('Enquêtes Reliées : ') ?></h4>
        
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('#') ?></th>
                <th scope="col" width="40%"><?= __('Enquête') ?></th>
                <th scope="col" style="text-align: center;"><?= __('Périodicité') ?></th>
                <th scope="col" style="text-align: center;"><?= __('Formulaire') ?></th>
            </tr>
            <?php foreach ($domain->surveys as $surveys): ?>
            <tr>
                <td><?= h($surveys->ID) ?></td>
                <td><?= h($surveys->name) ?></td>
                <td style="text-align: center;"><?= h($surveys->periodicity) ?></td>
                <td style="text-align: center;">
                    <?php
                        if ($surveys->url) 
                        {
                            
                             echo $this->Html->link($surveys->url,"/files/surveys/".$surveys->url);
                        }  
                    ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
    <?php if (!empty($domain->users)): ?>
        <h4><?= __('Utilisateurs Liés : ') ?></h4>
        
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('#') ?></th>
                <th scope="col"><?= __('@-mail') ?></th>
                <th scope="col"><?= __('Téléphone') ?></th>
                <th scope="col"><?= __('ORG') ?>.</th>
                <th scope="col"><?= __('NERC') ?></th>
                <th scope="col"><?= __('CNSS') ?></th>
                <th scope="col"><?= __('ICE') ?></th>
                <th scope="col"><?= __('Ville') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($domain->users as $users): ?>
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