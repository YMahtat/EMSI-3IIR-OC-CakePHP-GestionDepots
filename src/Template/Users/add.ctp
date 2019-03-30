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

<div style="width: 100%" id="ALL" class="users form  content">
    <?= $this->Form->create($user) ?>
    
    <fieldset id="form">
        <legend>  <?= $this->html->image("adduser.svg",["width"=>"7%"]) ?> &nbsp;   <?= __('AJOUTER UTILISATEUR : ') ?></legend>
        <div  class="form-horizontal">
        <?php
            echo $this->Form->control('last_name',["label" => "Nom : "]);
            echo $this->Form->control('first_name',["label" => "Prenom : "]);
            echo $this->Form->control('email',["label" => "@-MAIL"]);
            echo $this->Form->control('password',["label" => "MOT DE PASSE : "]);
            echo $this->Form->control('phone',["label" => "TELEPHONE : "]);
            echo $this->Form
            ->control(
                        'profil',
                        [
                            "label" => "TYPE UTILISATEUR : ",
                            "onchange"=>"isOperateur(this.value)",
                            "options" => ["" => "","Operateur"=>"Operateur","Administrateur"=>"Administrateur"]
                        ]
                     );
        ?>
        <div id="DIV_OPERATEUR" hidden>
        <?php 
            echo $this->Form->control('center_id', ['options' => $centers, 'empty' => true,"label" => "CENTRE : "]);
            echo $this->Form->control('organization',["label" => "NOM DE L'ORGANISME : "]);
            echo $this->Form->control('NERC',["label" => "Numéro d'Enregistrement du Registre de Commerce (NERC) : " ]);
            echo $this->Form->control('CNSS',["label" => "Numéro CNSS : "]);
            echo $this->Form->control('ICE',["label" => "Indentificateur Commun d'entreprise (ICE) : "]);
            echo $this->Form->control('address',["label" => "ADRESSE : ",'type'=>'textarea']);
            echo $this->Form->control('city',["label" => "VILLE : "]);
        ?>
        </div>
        <div id="DIV_DOM" hidden>
            <?php 
                echo $this->Form
                ->control('domains._ids', 
                          [
                            "label" => "Domaines liés : ",'options' => $domains,'multiple' => 'multiple',"class"=>"chosen-select"
                          ]
                        ); 
            ?>
            <label> 
                <p style="font-size: 97%" class="bg-info">
                    Appuyez sur le button Ctrl (windows) / Command (Mac) pour avoir des choix multiples et désélectionner de la liste des domaines. 
                </p>
            </label>
        
        </div>
        </div>    
    </fieldset>

    <div style="text-align: center;">
        <?= $this->Form->button(__('AJOUTER')) ?>
    </div>
    
    <?= $this->Form->end() ?>

</div>



<script type="text/javascript">
$(document).ready(function(){  
          $("#DIV_DOM :input,select").removeAttr("required"); // JQUERY
          // $("#form :input,select").attr("class","form-control"); // JQUERY btn btn-success
          // $("#ALL :button").attr("class","btn btn-lg btn-primary"); // JQUERY 
          

          isOperateur(document.getElementById("profil").value);
        }
    );

    function isOperateur(val)
    {
        if(val == 'Operateur')
        {
            document.getElementById("DIV_OPERATEUR").hidden = false;
            document.getElementById("DIV_DOM").hidden = false;
            $("#DIV_OPERATEUR :input,select").attr("required","true"); // JQUERY
            $("#DIV_DOM :input,select").removeAttr("required"); // JQUERY
        }
        else
        {
            $("#DIV_OPERATEUR :input,select").removeAttr("required"); // JQUERY
            document.getElementById("DIV_OPERATEUR").hidden = true;
            document.getElementById("DIV_DOM").hidden = true;
            $("#DIV_DOM :input,select").removeAttr("required"); // JQUERY
        }
    }
</script>

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