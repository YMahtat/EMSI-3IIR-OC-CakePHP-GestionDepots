<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Survey $survey
  */
?>

<div class="surveys view  content">
    <h3><?= $this->html->image("formulaire.svg",["width"=>"5%"]) ?> &nbsp;     <?= __("Formulaire d'Enquête : ") ?> </h3>
    <br>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('#') ?></th>
            <td><?= $this->Number->format($survey->ID) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Domaine : ') ?></th>
            <td><?= $survey->has('domain') ? $this->Html->link($survey->domain->name, ['controller' => 'Domains', 'action' => 'view', $survey->domain->ID]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __("Dénomination d'Enquête : ") ?></th>
            <td><?= h($survey->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Périodicité : ') ?></th>
            <td><?= $this->Number->format($survey->periodicity) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Formulaire : ') ?></th>
            <td>
                 <?php

                        if ($survey->url) 
                        {
                ?>

                <a href="<?= $this->Url->build(''. $url = "/files/surveys/".$survey->url)?>"> 
                    <?= $this->html->image("xls.svg",["width"=>"7%"]) ?>
                    <span> <?= $survey->url ?> </span>
                </a>  

                <?php   

                        }
                         
                ?>
                    
            </td>
        </tr>


    </table>
    <div class="related">
    <?php if (!empty($survey->deposits)): ?>
        <h4><?= __('Liste des Dépôts Reliées : ') ?></h4>
        
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('#') ?></th>
                <th scope="col"><?= __('Operateur') ?></th>
                <th scope="col"><?= __('Année Dépôts') ?></th>
                <th scope="col"><?= __('Période') ?></th>
                <th scope="col"><?= __('Type Dépôt') ?></th>
                <th scope="col"><?= __('Date & Heure Dépôt') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($survey->deposits as $deposits): ?>
            <tr >
                <td><?= h($deposits->ID) ?></td>

                <td><?= $this->Html->link(__("ID : ".$deposits->user->ID."  -    ".$deposits->user->organization ), ['controller' => 'Users', 'action' => 'view',$deposits->user_id]) ?></td>
                <td><?= h($deposits->deposit_year) ?></td>
                <td style="text-align: center;"><?= h($deposits->period) ?></td>
                <td><?= h($deposits->deposit_type) ?></td>
                <td><?= h($deposits->created->i18nFormat('dd-MM-yyyy HH:mm:ss')) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Consulter'), ['controller' => 'Deposits', 'action' => 'view', $deposits->ID]) ?>
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