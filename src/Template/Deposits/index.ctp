<?php
use Cake\I18n\Time;
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Deposit[]|\Cake\Collection\CollectionInterface $deposits
  */
?>
<div class="script">
    <?= $this->Html->css('chosen'); ?>
    <?= $this->Html->script('chosen.jquery'); ?>
    <?= $this->Html->script('chosen.proto'); ?>
</div>
<div style="width: 100%" class="deposits index  content" id="ALL">

    <h3> <?= $this->html->image("depositsList.svg",["width"=>"7%"]) ?> &nbsp;   <?= __('Liste Depôts : ') ?></h3>
    <fieldset style="width: 100%">
    <button onclick="filterbutton(this.value)" id="btn-filter" style="width: 100%">FILTRER</button> 
    <div hidden="true" id="Filtrer">        
        <?= $this->Form->create() ?>
        <div >
        <div class="col-sm-8" >
        <fieldset style="text-align: left;" class="form-horizontal ">
            <legend> Filtrer : </legend>
            <div id="DIV_SELECT">
            <?php 
            echo $this->Form->control('Operateurs : ',
                                                    [
                                                        "options"=>$users,
                                                        "multiple"=>true,
                                                        "class"=>"chosen-select",
                                                        "name" => "operators"
                                                    ]
                                    );
            $now = Time::now();
            $a = range(2000, $now->year);
            echo $this->Form->control('Années : ',
                                                    [
                                                        "options"=>array_combine($a,$a),
                                                        "multiple"=>true,
                                                        "class"=>"chosen-select",
                                                        "name" => "year"
                                                    ]
                                    );
            echo $this->Form->control('Enquêtes : ',
                                                    [
                                                        "options"=>$surveys,
                                                        "multiple"=>true,
                                                        "class"=>"chosen-select",
                                                        "name" => "surveys"
                                                    ]
                                    );
            ?>
            </div>
        </fieldset>
        </div>
        <div style="height: 100%" class="col-sm-4">
        <fieldset style="height: 100%">
            <legend>&nbsp;</legend>
            <br>
            <br>
            <?= $this->Form->button(__('Rechercher')) ?>
            <br>
            <br>
        </fieldset>
        </div>
        </div> 
        <?= $this->Form->end() ?>
    </div>
        
    </fieldset>

    <table style="width: 100%" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th width="1%" scope="col"><?= $this->Paginator->sort('#') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Enquete') ?></th>
                <th width="20%" scope="col"><?= $this->Paginator->sort('Organisme') ?></th>
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
                <td><?= $deposit->has('survey') ? $this->Html->link($deposit->survey->name, ['controller' => 'Surveys', 'action' => 'view', $deposit->survey->ID]) : '' ?></td>
                <td>
                    <?= $deposit->has('user') ? $this->Html->link($deposit->user->operator, ['controller' => 'Users', 'action' => 'view', $deposit->user->ID]) : '' ?>
                        
                </td>
                <td style="text-align: center;"><?= $deposit->deposit_year ?></td>
                <td style="text-align: center;"><?= $this->Number->format($deposit->period) ?></td>
                <td style="text-align: center;"><?= h($deposit->deposit_type) ?></td>
                <td style="text-align: center;"><?= h($deposit->created->i18nFormat('dd-MM-yyyy HH:mm:ss')) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Consulter'), ['action' => 'view', $deposit->ID]) ?>
                    
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


<script type="text/javascript"  >
    $(document).ready(
                        function()
                        { 
                            $(".chosen-select").chosen(
                                                            {
                                                                no_results_text: "Oops, pas de resultat !",
                                                                placeholder_text_multiple: "Tous"
                                                            }
                                                           );
                            $("#ALL *").css("word-break","keep-all");
                            $("button").css("line-height","90%");
                            $("#DIV_SELECT *").css("width","100%");
                            
                        }
                     );
    function filterbutton()
    {
        if($("#btn-filter").text() == "FILTRER")
        {
            $("#btn-filter").html('NE PAS FILTRER');
            $("#Filtrer").removeAttr("hidden");
            
        }
        else
        {
            $("#btn-filter").html('FILTRER');
            $("#Filtrer").attr("hidden","true");
        }
        
    }


</script>



