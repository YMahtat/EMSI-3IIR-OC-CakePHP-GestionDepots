<?php
/**
  * @var \App\View\AppView $this
  */
?>
<div class="script">
    <?= $this->Html->css('chosen'); ?>
    <?= $this->Html->script('chosen.jquery'); ?>
    <?= $this->Html->script('chosen.proto'); ?>
</div>
<div style="width: 100%" class="domains form  content">
    <?= $this->Form->create($domain) ?>
    <fieldset id="ALL">
        <legend>   <?= $this->html->image("domain.svg",["width"=>"7%"]) ?> &nbsp;    <?= __('MODIFIER DOMAINE : ') ?> </legend>
        <?php
           echo $this->Form->control('name',["label" => "DENOMATION DOMAINE : "]);
            echo $this->Form
                ->control('users._ids', 
                          [
                            "label" => "Opérateurs liés : ",'options' => $users,'multiple' => 'multiple',"class"=>"chosen-select",
                          ]
                        ); 
        ?>
        <label> 
                <p style="font-size: 97%" class="bg-info">
                    Appuyez sur le button Ctrl (windows) / Command (Mac) pour avoir des choix multiples et désélectionner de la liste des domaines. 
                </p>
        </label>
    </fieldset>
    <div style="text-align: center;">
        <?= $this->Form->button(__('MODIFIER')) ?>
    </div>
    <?= $this->Form->end() ?>
</div>

<script type="text/javascript"  >
    $(document).ready(
                        function()
                        { 
                            $(".chosen-select").chosen(
                                                            {
                                                                no_results_text: "Oops, pas de resultat !",
                                                                placeholder_text_multiple: "AUCUN",
                                                                width : "100%"
                                                            }
                                                           );
                            $(".content *").css("word-break","keep-all");

                            
                            
                        }
                     );
</script>