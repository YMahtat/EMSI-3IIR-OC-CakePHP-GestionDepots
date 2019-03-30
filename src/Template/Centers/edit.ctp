<?php
/**
  * @var \App\View\AppView $this
  */
?>

<div class="centers form  content">
    <?= $this->Form->create($center) ?>
    <fieldset>
         <legend>   <?= $this->html->image("center.svg",["width"=>"7%"]) ?> &nbsp;    <?= __('Editer Centre : ') ?></legend>
        <?php
            echo $this->Form->control('CODE',["label"=>'CODE DU CENTRE : ',"onchange"=>"code_value()"]);
        ?>
        <div id="code_error">
            <p  class="bg-danger">Le CODE doit être strictement positif !!!</p>
            <br>
        </div>

        <?php    
            echo $this->Form->control('name',["label"=>'DENOMINATION DU CENTRE : ']);
            echo $this->Form->control('city',["label"=>'Ville : ']);
        ?>
    </fieldset>
    <div style="text-align: center;">
        <?= $this->Form->button(__('MODIFIER')) ?>
    </div>
    <?= $this->Form->end() ?>
</div>
<script type="text/javascript">
    $(document).ready(code_value);
    function code_value()
    {
        var val = $("#code").val();
        if(val > 0)
        {
            $("#code_error").attr("hidden","true");
        }
        else
        {
            $("#code_error").removeAttr("hidden");
        }
    }
</script>