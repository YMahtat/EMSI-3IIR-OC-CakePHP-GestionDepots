<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Deposit $deposit
  */
?>

<div class="deposits view  content">
    <h3> <?= $this->html->image("deposit.png",["width"=>"7%"]) ?> &nbsp;   Depôt n° <?= h($deposit->ID) ?></h3>
    <br>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Enquête : ') ?></th>
            <td><?= $deposit->has('survey') ? $this->Html->link($deposit->survey->name, ['controller' => 'Surveys', 'action' => 'view', $deposit->survey->ID]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Operateur : ') ?></th>
            <td><?= $deposit->has('user') ? $this->Html->link("ID : ".$deposit->user->ID."  -    ".$deposit->user->organization , ['controller' => 'Users', 'action' => 'view', $deposit->user->ID]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('TYPE Dépôt : ') ?></th>
            <td><?= h($deposit->deposit_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Formulaire : ') ?></th>
            <td>
<!--                 <?php
                        echo $this->Html->link($deposit->url,''. $url = "/files/deposits/".$deposit->url);  
                ?> -->
                &nbsp;&nbsp;&nbsp;
                
                <a href="<?= $this->Url->build(''. $url = "/files/deposits/".$deposit->url)?>"> <?= $this->html->image("xls.svg",["width"=>"7%"]) ?></a>  
            </td>
        </tr>
        <?php
            if($deposit->comment != "")
            { 
        ?>
        <tr>
            <th scope="row"><?= __('Commentaire : ') ?></th>
            <td><?= h($deposit->comment) ?></td>
        </tr>
        <?php
            }  
        ?>
       
        <tr>
            <th scope="row"><?= __('Année Dépôt : ') ?></th>
            <td><?= "".$deposit->deposit_year ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Période : ') ?></th>
            <td><?= $deposit->period ?></td>
        </tr>
    </table>
    <div class="related">
        <?php if (!empty($deposit->attachemnts)): ?>
        <h4><?= __('Pièces Jointes : ') ?></h4>
        
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('#') ?></th>
                <th scope="col"><?= __('URL') ?></th>
                <th scope="col"><?= __('COMMENTAIRE') ?></th>
            </tr>
            <?php foreach ($deposit->attachemnts as $attachemnts): ?>
            <tr>
                <td><?= h($attachemnts->ID) ?></td>
                <td>
                    <?php
                        echo $this->Html->link($attachemnts->url,"/files/attachemnts/".$attachemnts->url);  
                    ?>            
                </td>

                <td><?php if($attachemnts->comment != ""){echo $attachemnts->comment;}else {echo "Pas de Commentaire";}  ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        
        <h4><?= __('Dépôts connexes (De même année et période) : ') ?></h4>
        
        <table cellpadding="0" cellspacing="0">
            <tr>
               <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('#') ?></th>
                <th scope="col"><?= $this->Paginator->sort('TYPE' ) ?></th>
                <th scope="col"><?= $this->Paginator->sort('DATE & HEURE DEPOT') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
            </tr>
            <?php foreach ($othersDeposits as $deposit): ?>
            <tr>
                <td> <?= $deposit->ID ?> </td>
                
                <td><?= h($deposit->deposit_type) ?></td>
                <td><?= h($deposit->created->i18nFormat('dd-MM-yyyy HH:mm:ss')) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Consulter'), ['action' => 'view', $deposit->ID]) ?>
                    
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        
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