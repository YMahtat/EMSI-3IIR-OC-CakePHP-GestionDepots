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
    <fieldset>
        <legend><?= $this->html->image("editProfil.svg",["width"=>"7%"]) ?> &nbsp;<?= __('Modifier UTILISATEUR : ') ?></legend>
        <?php
            echo $this->Form->control('last_name',["label" => "Nom : "]);
            echo $this->Form->control('first_name',["label" => "Prenom : "]);
            echo $this->Form->control('email',["label" => "@-MAIL"]);
            if(
                $this->request->session()->read('Auth.User.profil') == "Administrateur" 
                && 
                $user->profil == "Administrateur"
                &&
                $this->request->session()->read('Auth.User.ID') != $user->ID
              )
            {
                echo $this->Form->control('password',["label" => "MOT DE PASSE : "]);
            }
            echo $this->Form->control('phone',["label" => "TELEPHONE : "]);
            $isDisabled = ($this->request->session()->read('Auth.User.profil') != "Administrateur") ? true : false;
            echo $this->Form
            ->control(
                        'profil',
                        [
                            "label" => "TYPE UTILISATEUR : ",
                            "onchange"=>"isOperateur(this.value)",
                            "options" => ["" => "","Operateur"=>"Operateur","Administrateur"=>"Administrateur"],
                            'onload' =>"isOperateur(this.value)",
                            "disabled"=> $isDisabled
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
            echo $this->Form->control('address',["label" => "ADRESSE : ", "required" => "true",'type'=>'textarea']);
            echo $this->Form->control('city',["label" => "VILLE : ", "required" => "true"]);

        ?>
        </div>
         <div id="DIV_DOM" hidden>
            <?php 
                echo $this->Form
                ->control('domains._ids', 
                          [
                            "label" => "Domaines liés : ",
                            'options' => $domains,
                            'multiple' => 'multiple',
                            "class"=>"chosen-select",
                            "disabled"=> $isDisabled
                          ]
                        ); 
            ?>

            <label>
            <?php
             if ($isDisabled == false) 
             {
            ?>   

                <p style="font-size: 97%" class="bg-info">
                    Appuyez sur le button Ctrl (windows) / Command (Mac) pour avoir des choix multiples et désélectionner de la liste des domaines. 
                </p>
            <?php
              }  
            ?>   
 
            </label>

        
        </div>
    </fieldset>
    <div style="text-align: center;">
        <?= $this->Form->button(__('MODIFIER')) ?>
    </div>
    <?= $this->Form->end() ?>
</div>

<script type="text/javascript">

    window.onload = function() 
    {
      isOperateur(document.getElementById("profil").value);
      $("#DIV_DOM *").removeAttr("required"); // JQUERY
    };
    

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
                                                                no_results_text: "Oops ! Pas de resultat pour : ",
                                                                placeholder_text_multiple: "AUCUN",
                                                                width : "100%"
                                                            }
                                                           );
                            $(".content *").css("word-break","keep-all");

                            
                            
                        }
                     );
</script>