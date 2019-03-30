
<?php error_reporting(E_ERROR | E_PARSE | E_USER_NOTICE | E_ALL | E_WARNING); ?>
<?php
use Cake\I18n\Time;
/**
  * @var \App\View\AppView $this
  */
?>

<div class="deposits form  content">
    <?= $this->Form->create($deposit, ['type' => 'file']) ?>
    <fieldset>

        <legend><?= $this->html->image("adddeposit.svg",["width"=>"7%"]) ?> &nbsp;<?= __("Ajouter une Déposition d'Enquêtes : ") ?></legend>
        <br>
        <?php
            echo $this->Form->control('domain_id', [ "label"=>"Domaines d'Enquêtes :",'options' => $domains]);
        ?>
        <div id="Surveys">
          <label id="L1" hidden> Enquêtes : </label>
          <?php
              foreach ($srvs as $key => $value) 
              {
                echo $this->Form->control('survey_id', ["label"=>"",'options' => $srvs[$key],"hidden"=>"true","disabled"=>"true","id"=>$key]);
              }
          ?>
        </div>
        <?php    
            echo $this->Form->control('user_id', 
              [
              "label"=>"OPERATEUR :",
              'options' => [ $this->request->session()->read('Auth.User.ID') => "ID:".$this->request->session()->read('Auth.User.ID')." - ".$this->request->session()->read('Auth.User.first_name')." ".$this->request->session()->read('Auth.User.last_name')]
              ]
                                    );
        ?>
        <label id="L2" hidden> Année d'Enquêtes :</label>
        <div id="YEAR">
        <?php  
            $now = Time::now();
            foreach ($minY as $key => $value) 
            {
              $a = range($value, $now->year);
              
              echo $this->Form->control('deposit_year',["label"=>"","options"=>array_combine($a,$a),"hidden"=>"true","disabled"=>"true","id"=>"x".$key,"required"=>"false"]);
            }
        ?>
        </div>

        <label id="L3" hidden> Période : </label>
        <div id="period">
        <?php  
            foreach ($period as $key => $value) 
            {
              $periodList = array();
              if($value != 0)
              {
                $a = range(1, 12/$value) ;
                $periodList = array_combine($a,$a);
              }
              else
              {
                $periodList = ["VIDE"=>"VIDE"];
              }
              
              echo $this->Form->control('period',["label"=>"","options"=>$periodList,"hidden"=>"true","disabled"=>"true","id"=>"y".$key,"required"=>"false"]);
            }
        ?>
        </div>

        <?php
            echo $this->Form->control('deposit_type',["label"=>"TYPE de Dépôt :","readonly" => "true"]);
            //echo $this->Form->control('url');
        ?>
        <br>
        <br>
        <div class="input file">
          <hr>
          <label style="font-size: 120%"> Formulaire : </label>
          <br>
          <div >
            <div class="col-sm-2"></div>
            <div class="col-sm-3"><?= $this->html->image("excel.png",["width"=>"100%"]) ?></div>
            
            <div class="col-sm-7">&nbsp; <input class="col-sm-3" type="file" name="url" required></div>
            <hr>
            <div class="row"></div> 
          </div> 
         
          
        </div>
        <br>
        
        <?php    
            
            echo $this->Form->control('comment',["label"=>"Commentaire sur le Formulaire de Dépôt : ","type"=>"textarea"]);
        ?>
         <table class="table table-bordered" id="dynamic_field">  
                                    <tr>  

                                         <td colspan="2">
                                         <label> 
                                            <?= $this->html->image("add_attach.svg",["width"=>"7%"]) ?> 
                                            
                                            &nbsp;Ajouter Pièces Jointes : 
                                          </label>
                                         </td>  
                                         <td > <button type="button" name="add" id="add" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i></button></td>  
                                    </tr>  
         </table>  
    </fieldset>
    <div style="text-align: center;">
        <?= $this->Form->button(__('AJOUTER')) ?>
    </div>
    <?= $this->Form->end() ?>
</div>

 <script>
 var oldVal = 1;
 var oldVal = 2;
 $(document).ready(function(){  
      var i=1;  
      $("#YEAR *").removeAttr("required");
      $("#YEAR *").removeAttr("class");
      $("#period *").removeAttr("class");
      $('#add').click(function(){  
           i++;  
           $('#dynamic_field').append('<tr id="row'+i+'"><td> <?= $this->html->image("attach.svg",["width"=>"7%",'style'=>'display: inline-block;']) ?> <label style="display: inline-block;"> Pièce Jointe : </label> <br><br> <?= $this->Form->control('',['type'=>'file' , 'name'=>'files[]','style'=>'display: inline-block;']);?> </td>  <td> <?= $this->Form->control('Commentaire :',['type'=>'textarea' , 'name'=>'comments[]']);?> </td> <td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove"><i class="glyphicon glyphicon-remove"></i></button></td></tr>');
      });  
      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      });  
       $("#domain-id").attr("onchange","newSurveyList(this.value)");
       var id = $("#domain-id").val();
       
       if(id != null)
       {
          $('#L1').removeAttr("hidden");
          $('#L2').removeAttr("hidden"); 
          $('#L3').removeAttr("hidden"); 
       }
       $('#'+id+'').removeAttr("hidden"); 
       $('#'+id+'').removeAttr("disabled"); 
       $('#x'+id+'').removeAttr("hidden"); 
       $('#x'+id+'').removeAttr("disabled");
       oldVal = id;

       var id2 = $("#"+id).val();
       if(id2 == null)
       {
          id2 = "";
       }
       $('#y'+id2+'').removeAttr("hidden"); 
       $('#y'+id2+'').removeAttr("disabled"); 
       $("#x"+id2+" :input,select").attr("required","true"); 
       $("#"+id).attr("onchange","newPeriodList(this.value)");
       oldVal2 = id2;
 });  

 </script>


 <script type="text/javascript">

 
function newSurveyList(val)
{
  var id = $("#domain-id").val();
  $("#"+oldVal+"").attr("hidden","true"); 
  $("#"+oldVal+"").attr("disabled","true");
  $('#'+id+'').removeAttr("hidden"); 
  $('#'+id+'').removeAttr("disabled");
  $("#x"+oldVal+"").attr("hidden","true"); 
  $("#x"+oldVal+"").attr("disabled","true");
  $("#x"+oldVal+"").removeAttr("required");
  $('#x'+id+'').removeAttr("hidden"); 
  $('#x'+id+'').removeAttr("disabled");  
  $("#x"+id+" :input,select").attr("required","true");
  $("#"+oldVal).removeAttr("onchange");
  $("#"+id).attr("onchange","newPeriodList(this.value)");
  oldVal = id;
  newPeriodList(id);

}

function newPeriodList(val)
{
  
  var id = $("#"+val).val();
  if(id == null)
  {
    id = "";
  }
  $("#y"+oldVal2).attr("hidden","true"); 
  $("#y"+oldVal2).attr("disabled","true");
  $("#y"+oldVal2+" :input,select").removeAttr("required");
  $('#y'+id).removeAttr("hidden"); 
  $('#y'+id).removeAttr("disabled");  
  $("#y"+id+" :input,select").attr("required","true");
  oldVal2 = id;
}
 </script>

 