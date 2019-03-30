<?php
/**
  * @var \App\View\AppView $this
  */
?>

<div class="users form login content">
    <div class="col-sm-3"></div>
    <div class="col-sm-6">
        <?= $this->Form->create() ?>
        <fieldset>
            <legend> <?= $this->html->image("login.png",["width"=>"7%"]) ?> &nbsp;<?= __('LOG IN :') ?></legend>
            <?php

                echo $this->Form->control('email',["label" => "@-MAIL"]);
                echo $this->Form->control('password',["label" => "MOT DE PASSE : "]);
               
            ?>

      


        </fieldset>
        <div style="text-align: center;">
            <?= $this->Form->button(__('Connexion')) ?>   
            <?= $this->Form->button(__('Annuler'),["type"=>"reset"]) ?>  
        </div>
        <div style="text-align: right;">
            <?= $this->html->link("mot de passe oublié ?",["controller"=> "Users",'action' => 'forgetpassword']) ?>
        </div> 

        <?= $this->Form->end() ?>
    </div>
    <div class="col-sm-3"></div>
    <div class="row"></div>
</div>



<script type="text/javascript">
    function isOperateur(val)
    {
        if(val == 'Operateur')
        {
            document.getElementById("DIV_OPERATEUR").hidden = false;
            $("#DIV_OPERATEUR :input,select").attr("required","true"); // JQUERY
        }
        else
        {
            $("#DIV_OPERATEUR :input,select").removeAttr("required"); // JQUERY
            document.getElementById("DIV_OPERATEUR").hidden = true;
        }
    }
</script>
