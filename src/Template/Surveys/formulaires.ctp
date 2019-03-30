<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Survey[]|\Cake\Collection\CollectionInterface $srvs
  */
?>

<div style=" text-align: left;" class="surveys index  content">
    

    <fieldset>
    <legend>  &nbsp;   <?= $this->html->image("deposit_index.svg",["width"=>"7%"]) ?> &nbsp;     <?= __('Formulaires et modèles à télécharger : ') ?> </legend>
    <?php foreach ($domains as $dom): ?>
        <div class="col-sm-5">
        
        <?php if (!empty($srvs[$dom->ID])): ?>
        <h4><?= $dom->name ?> : </h4>
        <ul>
            <?php foreach ($srvs[$dom->ID] as $srv): ?>
                <li style="font-size: 90%">

                    <?php
                        $url = "#";
                        if ($srv->url) 
                        {
                            $url = "/files/surveys/".$srv->url;
                        }
                        echo $this->Html->link($srv->name.".",''.$url);  
                    ?>
                </li>
            <?php endforeach; ?>
        </ul>
        <?php endif; ?>
        
        </div>
    <?php endforeach; ?>

    </fieldset>
</div>
