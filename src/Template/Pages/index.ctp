<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Survey[]|\Cake\Collection\CollectionInterface $srvs
  */
?>

<div style=" text-align: center;" class="surveys index  content">
<div  style=" text-align: center;margin: 0px;padding: 0px;">    
    <?php echo $this->html->image("home_entetre.png",["width"=>"100%"]) ?>
                
    <hr>
</div>
<div style=" text-align: center; background-color: #EEEEEE" class="surveys index ">
<h1 class="text-center row">Plateforme de Dépôt des Enquêtes Statistiques</h1>
<div class="row subheading"></div>
        <section id="home" class="home row">


                <br>
                <br>
                                        
                <div class="col-sm-6">
                    <div class="single_home_right text-center">

                        <button onclick='window.location.href="<?= $this->Url->build(array('controller' => 'Surveys', 'action' => 'formulaires')); ?>"' class="btn btn-info">
                            <i class="fa fa-download"></i> Telechargement des formulaires
                        </button>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="single_home_right text-center">

                        <button onclick='window.location.href="<?= $this->Url->build(array('controller' => 'Deposits', 'action' => 'add')); ?>"' class="btn btn-danger"> 
                            <i class="glyphicon glyphicon-inbox"></i> <i class="fa fa-upload"></i> Depot de dossier d'enquête
                        </button>
                    </div>
                </div>
                <br>
                <br>
                <br>

        </section>
</div>
<hr>
</div>
