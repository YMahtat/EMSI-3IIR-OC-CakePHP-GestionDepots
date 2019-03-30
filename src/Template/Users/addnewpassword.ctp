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

        <legend>  <?= $this->html->image("key.ico",["width"=>"10%"]) ?>  <?= __('Modifier mot de passe Opérateur : ') ?></legend>
        <?php
            echo $this->Form->control('c',["label" => "NOM CORRESPONDANT : ","options"=>[""=> $user->first_name." ".$user->last_name] ]);
            echo $this->Form->control('c',["label" => "Organisme ou Entreprise : ","options"=>[""=> $user->organization] ]);
            echo $this->Form->control('b',["label" => "TELEPHONE CORRESPONDANT : ","options"=>[""=> $user->phone] ]);
            echo $this->Form->control('a',["label" => "@-MAIL CORRESPONDANT : ","options"=>[""=> $user->email] ]);
            echo $this->Form->control('x',["label" => "PAGE D'ACCUEIL (PROCHAINE CONNEXION) : ","options"=>[""=>"NOUVEAU OPERATEUR"] ]);
            echo $this->Form->control('newpassword',["label" => "NOUVEAU MOT DE PASSE : ","required"=>"true"]);
        ?>
        <div id="match" hidden class="bg-success">
            le mot de passe est correctement verfié.
        </div>
        <div id="notmatch" hidden class="bg-danger">
            le mot de passe n'est pas verfié !!!
        </div>
  


    </fieldset>
    <div style="text-align: center;">
        <?= $this->Form->button(__('Modifier'),["id"=>"modifbutton"]) ?> 
    </div>  

    <?= $this->Form->end() ?>
    </div>
    <div class="col-sm-3"></div>
    <div class="row" ></div>
</div>