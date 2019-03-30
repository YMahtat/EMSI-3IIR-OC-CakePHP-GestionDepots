<?php
use Cake\I18n\Time;
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\User $user
  */
?>

<div class="users view  content">
    <h3><?= $this->html->image("profil.svg",["width"=>"7%"]) ?> &nbsp;<?= h($user->profil) ?> ID : <?= h($user->ID) ?></h3>
    <br>
    <table class="vertical-table">
        <?php
        if($user->profil == "Operateur")
        {  
        ?>
        <tr><th style="background-color: aliceblue;" colspan="4" >Infomation Correspondant :</th></tr>
        <?php
        }  
        ?>
        <tr>
            <th scope="row"><?= __('Nom : ') ?></th>
            <td><?= h($user->last_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Prenom : ') ?></th>
            <td><?= h($user->first_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('@-mail : ') ?></th>
            <td><?= h($user->email) ?></td>
        </tr>

        <tr>
            <th scope="row"><?= __('Telephone : ') ?></th>
            <td><?= h($user->phone) ?></td>
        </tr>
        
        <?php
        if($user->profil == "Operateur")
        {  
        ?>
        <tr><th style="background-color: aliceblue;" colspan="4" >Infomation Organisme :</th></tr>
        <tr>
            <th scope="row"><?= __('Centere : ') ?></th>
            <td><?= $user->has('center') ? $this->Html->link($user->center->full, ['controller' => 'Centers', 'action' => 'view', $user->center->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Organisme : ') ?></th>
            <td><?= h($user->organization) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('NERC : ') ?></th>
            <td><?= h($user->NERC) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('CNSS : ') ?></th>
            <td><?= h($user->CNSS) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ICE : ') ?></th>
            <td><?= h($user->ICE) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Adresse : ') ?></th>
            <td><?= h($user->address) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ville : ') ?></th>
            <td><?= h($user->city) ?></td>
        </tr>
        <?php
        }  
        ?>
    </table>
    
    <?php if (!empty($lastLogs)): ?>
    <div class="related">
        <h4><?= __('Dérnières connexion : ') ?></h4>
        
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('#') ?></th>
                <th scope="col"><?= __('Connecté à') ?></th>
                <th scope="col"><?= __('Deconnecté à') ?></th>
            </tr>
            <?php foreach ($lastLogs as $logs): ?>
            <tr>
                <td><?= h($logs->ID) ?></td>
                <td><?= h($logs->created->i18nFormat('dd-MM-yyyy HH:mm:ss')) ?></td>
                <td><?php if($logs->deconnected){echo $logs->deconnected->i18nFormat('dd-MM-yyyy HH:mm:ss');} ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        
    </div>
    <?php endif; ?>



    <?php if (!empty($user->deposits)): ?>
    <div class="related">
        <h4><?= __('Dépôts : ') ?></h4>
        
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('#') ?></th>
                <th scope="col"><?= __('Enquête ID') ?></th>
                <th scope="col"><?= __('Année de Dépôt') ?></th>
                <th scope="col"><?= __('Période') ?></th>
                <th scope="col"><?= __('TYPE') ?></th>
                <th scope="col"><?= __('Date & Heure Dépôt') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->deposits as $deposits): ?>
            <tr>
                <td><?= h($deposits->ID) ?></td>
                <td><?= h($deposits->survey_id) ?></td>
                <td><?= h($deposits->deposit_year) ?></td>
                <td><?= h($deposits->period) ?></td>
                <td><?= h($deposits->deposit_type) ?></td>
                <td><?= $deposits->created->i18nFormat('dd-MM-yyyy HH:mm:ss') ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Consulter'), ['controller' => 'Deposits', 'action' => 'view', $deposits->ID]) ?>
                    
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        
    </div>
    <?php endif; ?>
    <?php if (!empty($user->domains)): ?>
    <div class="related">
        <h4><?= __('Domaines Liés : ') ?></h4>
        
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('#') ?></th>
                <th scope="col"><?= __('Domaine : ') ?></th>
                <th scope="col"><?= __('Lié à ce domaine le : ') ?></th>
            </tr>
            <?php foreach ($user->domains as $domains): ?>
            <tr>
                <td><?= h($domains->ID) ?></td>
                <td><?= h($domains->name) ?></td>
                <td><?= $domains->_joinData->created->i18nFormat('dd-MM-yyyy'); ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        
    </div>
    <?php endif; ?>
</div>

<script type="text/javascript">
        $(document).ready(
                        function()
                        { 

                            $(".view *").css("word-break","keep-all");
                            $(".view table").css("width","100%");
                            $(".view h4").css("text-align","center");
                            $(".view h3").css("text-align","center");
                        }
                     );
</script>