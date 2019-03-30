<?php
/**
  * @var \App\View\AppView $this
  */
?>

<div class="surveys form  content">
    <?= $this->Form->create($survey , ['type' => 'file']) ?>
    <fieldset>
        <legend> <?= $this->html->image("non_repondant.svg",["width"=>"7%"]) ?> &nbsp;   <?= __('Editer Enquête : ') ?></legend>
        <?php
            echo $this->Form->control('domain_id', ['options' => $domains,"label"=>"Domaine : "]);
            echo $this->Form->control('name',["label"=>"Denomination de l'enquête : "]);
            echo $this->Form->control('periodicity',["label"=>"Périodicité : "]);
        ?>
        <br>
        <div class="input file">
          <hr>
          <label style="font-size: 120%"> Formulaire : </label>
          <br>
          <div >
            <div class="col-sm-2"></div>
            <div class="col-sm-3"><?= $this->html->image("excel.png",["width"=>"100%"]) ?></div>
            
            <div class="col-sm-7">&nbsp; <input class="col-sm-3" type="file" name="url"></div>
            <hr>
            <div class="row"></div> 
          </div> 
         
          
        </div>
        <br>
    </fieldset>
    <div style="text-align: center;">
        <?= $this->Form->button(__('MODIFIER')) ?>
    </div>
    <?= $this->Form->end() ?>
</div>
