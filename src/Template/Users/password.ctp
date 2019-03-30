<?php
/**
  * @var \App\View\AppView $this
  */
?>

<div class="users form  content">
    <div class="col-sm-3"></div>
    <div class="col-sm-6">
    <?= $this->Form->create() ?>
    <fieldset>

        <legend>  <?= $this->html->image("key.ico",["width"=>"10%"]) ?>  <?= __('Modifier le mot de passe : ') ?></legend>
        <?php

            echo $this->Form->control('old_password',["label" => "ANCIEN MOT DE PASSE : ","required"=>"true"]);
            echo $this->Form->control('newpassword',["label" => "NOUVEAU MOT DE PASSE : ","required"=>"true","onchange"=>"verify_password()"]);
            echo $this->Form->control('newpasswordcheck',["label" => "CONFIRMER NOUVEAU MOT DE PASSE : ","required"=>"true","onchange"=>"verify_password()"]);
        ?>
        <div id="match" hidden class="bg-success">
            le mot de passe est correctement verfié.
        </div>
        <div id="notmatch" hidden class="bg-danger">
            le mot de passe n'est pas verfié !!!
        </div>
  


    </fieldset>
    <div style="text-align: center;">
        <?= $this->Form->button(__('Modifier'),["disabled"=>"true","id"=>"modifbutton"]) ?> 
    </div>  

    <?= $this->Form->end() ?>
    </div>
    <div class="col-sm-3"></div>
    <div class="row" ></div>
</div>




<script type="text/javascript">
    function verify_password()
    {
        var p1 = $("#newpassword").val();
        var p2 = $("#newpasswordcheck").val();

        if(p1 == "" || p2 == "")
        {
            $("#modifbutton").attr("disabled","true"); 
            $("#match").attr("hidden","true");
            $("#notmatch").attr("hidden","true");

        }
        else if (p1 == p2) 
        {
            $("#modifbutton").removeAttr("disabled");
            $("#match").removeAttr("hidden");
            $("#notmatch").attr("hidden","true");
            
        }
        else
        {
            $("#modifbutton").attr("disabled","true");
            $("#notmatch").removeAttr("hidden");
            $("#match").attr("hidden","true");
            
        }
    }
</script>

