<?php
  
?>

<?php ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    

    <!-- BEGIN META -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="your,keywords">
    <meta name="description" content="Short explanation about this website">
    <!-- END META -->




<?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Dépôt des Enquêtes
    </title>
    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css('bootstrap.css?1422792965') ?>
    <?= $this->Html->css('bootstrap') ?>
     <?= $this->Html->css('font-awesome.min') ?>
    <?= $this->Html->css('materialadmin') ?>
    <?= $this->Html->css('material-design-iconic-font.min') ?>
    <?= $this->Html->css('libs/rickshaw/rickshaw') ?>
    <?= $this->Html->css('libs/morris/morris.core') ?>

    <?= $this->Html->css('base') ?>
    <?= $this->fetch("css"); ?>
    <?= $this->fetch('meta') ?>
    <?= $this->Html->script('jquery-3.2.1.min'); ?>


   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />



  </head>
  <body class="menubar-hoverable header-fixed " onload="startTime()">
<!-******************************************************************************************************************************************-->

<script type="text/javascript">
        $(document).ready(RefreshLogs);

        function AjaxLogs()
        { 
            jQuery.get("<?=$this->Url->build(['controller' => 'Users', 'action' => 'testempty'])?>",null,jQuery.noop); 
        }

        function RefreshLogs() 
        {
            setInterval(AjaxLogs, 1000*600);
        }
      </script>

    <!-- BEGIN HEADER-->
    <header id="header" >
      <div class="headerbar">
        <!-- Brand and toggle get grouped for better mobile display -->
        
        <div class="headerbar-left">
          <ul class="header-nav header-nav-options">
            
            
            <li class="header-nav-brand" >
          
               
              <div class="brand-holder" >
                <?php 
                    $home = 
                      ($this->request->session()->read('Auth.User.profil') != "Administrateur")? 
                        $this->Url->build("/") : $this->Url->build(array('controller' => 'Deposits', 'action' => 'adminhome')); 
                  ?>
                <a href="<?= $home ?>">
                  <?= $this->Html->image('logo.jpg', array('class'=>'h80')); ?>
                  <span class="text-lg text-bold text-primary" style="margin-left: 30px;">
                    Dépôt des Enquêtes Statistiques
                  </span>
                </a>
              </div>
            </li>
            <li>
              <a class="btn btn-icon-toggle menubar-toggle" data-toggle="menubar" href="javascript:void(0);">
                <i class="fa fa-bars"></i>
              </a>
            </li>
          </ul>

                                             
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="headerbar-right">
              <?php
                      if(!$this->request->session()->read('Auth.User.ID'))
                      {  
                    ?>
          <nav class="col-md-6">
             <div class="container">  
            
                <ul class="nav navbar-nav  navbar-right">
                      
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                              <a href="<?= $this->Url->build('/'); ?>">
                                  <DIV class="glyphicon glyphicon-home" style="margin: 0px 10px;">&nbsp;Acceuil</DIV> 
                              </a>
                            </li>
                            <li>
                              <a href="<?= $this->Url->build(array('controller' => 'Users', 'action' => 'login')); ?>">
                                <DIV class="glyphicon glyphicon-log-in" style="margin: 0px 10px;">&nbsp;Connexion</DIV>
                              </a>
                            </li>
                            <li><a href="#"></a></li>
                            <li><a href="#"></a></li>
                        </ul>
                    

                     </ul>

                  </div> 
                </nav>
              <?php
                      }  
                  ?>
         

          <?php
                if($this->request->session()->read('Auth.User.profil') == "Administrateur" )
                {  
          ?>
          <ul class="header-nav header-nav-profile">
            <li class="dropdown">
              <a href="javascript:void(0);" class="dropdown-toggle ink-reaction" data-toggle="dropdown">


                <span class="profile-info">
                  <?= $this->request->session()->read('Auth.User.email')?>
                  <small > MENU </small>
                </span>
              </a>
              <ul class="dropdown-menu animation-dock">
                            <li>
                              <a href="<?= $this->Url->build(array('controller' => 'Deposits', 'action' => 'adminhome')); ?>">
                                  <DIV class="glyphicon glyphicon-home"><span> Acceuil</span></DIV>
                              </a>
                            </li>
                            <li>
                              <a href="<?= $this->Url->build(array('controller' => 'Users', 'action' => 'view',$this->request->session()->read('Auth.User.ID'))); ?>">
                                <DIV class="glyphicon glyphicon-user"><span> Consulter Profil</span></DIV> 
                              </a>
                            </li>
                            <li>
                              <a href="<?= $this->Url->build(array('controller' => 'Users', 'action' => 'edit',$this->request->session()->read('Auth.User.ID'))); ?>">
                                <DIV class="glyphicon glyphicon-cog"><span> Modifier Profil</span></DIV>
                              </a>
                            </li>
                            <li  style="width: 20%">
                              <a class="MARGE" href="<?= $this->Url->build(array('controller' => 'Users', 'action' => 'password',$this->request->session()->read('Auth.User.ID'))); ?>">
                                <DIV class="glyphicon glyphicon-pencil"> <span> Mot de Passe</span></DIV> 
                              </a>
                            </li>
                            <li>
                              <a href="<?= $this->Url->build(array('controller' => 'Users', 'action' => 'logout')); ?>">
                                <DIV class="glyphicon glyphicon-log-out"><span> DECONNEXION</span></DIV> 
                              </a>
                            </li>
                            <li><a href="#"></a></li>
                
              </ul><!--end .dropdown-menu -->
            </li><!--end .dropdown -->
          </ul><!--end .header-nav-profile -->
           <?php
                      }  
                    ?>


           <?php
                      if($this->request->session()->read('Auth.User.profil') == "Operateur" )
                      {  
              ?>
               <ul class="header-nav header-nav-profile">
            <li class="dropdown">
              <a href="javascript:void(0);" class="dropdown-toggle ink-reaction" data-toggle="dropdown">


                <span class="profile-info">
                  <?= $this->request->session()->read('Auth.User.email')?>
                  <small>MENU</small>
                </span>
              </a>

                      <ul class="dropdown-menu animation-dock">

                            <li>
                              <a href="<?= $this->Url->build('/'); ?>">
                                  <DIV class="glyphicon glyphicon-home"><span> Acceuil</span></DIV>
                              </a>
                            </li>
                            <li>
                              <a href="<?= $this->Url->build(array('controller' => 'Deposits', 'action' => 'add')); ?>">
                                <DIV class="glyphicon glyphicon-cloud-upload"><span>&nbsp;Nouveau Dépôt</span></DIV> 
                              </a>
                            </li>
                            <li>
                              <a href="<?= $this->Url->build(array('controller' => 'Deposits', 'action' => 'my',$this->request->session()->read('Auth.User.ID'))); ?>">
                                <DIV class="glyphicon glyphicon-inbox"><span> Les Dépôts</span></DIV> 
                              </a>
                            </li>


                            <li>
                              <a href="<?= $this->Url->build(array('controller' => 'Users', 'action' => 'view',$this->request->session()->read('Auth.User.ID'))); ?>">
                                <DIV class="glyphicon glyphicon-briefcase"><span> Profil Operateur</span></DIV> 
                              </a>
                            </li>
                            <li>
                              <a href="<?= $this->Url->build(array('controller' => 'Users', 'action' => 'edit',$this->request->session()->read('Auth.User.ID'))); ?>">
                                <DIV class="glyphicon glyphicon-cog"><span> Modifier Profil</span></DIV>
                              </a>
                            </li>
                            <li  style="width: 20%">
                              <a class="MARGE" href="<?= $this->Url->build(array('controller' => 'Users', 'action' => 'password',$this->request->session()->read('Auth.User.ID'))); ?>">
                                <DIV class="glyphicon glyphicon-pencil"> <span> Mot de Passe</span></DIV> 
                              </a>
                            </li>
                            <li>
                              <a href="<?= $this->Url->build(array('controller' => 'Users', 'action' => 'logout')); ?>">
                                <DIV class="glyphicon glyphicon-log-out"><span> DECONNEXION</span></DIV> 
                              </a>
                            </li>
                            <li><a href="#"></a></li>
                            <li><a href="#"></a></li>
                        </ul>
                    <?php
                      }  
                    ?>            

        </div><!--end #header-navbar-collapse -->
      </div>
    </header>
    <!-- END HEADER-->


<!-******************************************************************************************************************************************-->



    <!-- BEGIN BASE-->
    <div id="base">

      <!-- BEGIN OFFCANVAS LEFT -->
      <div class="offcanvas">
      </div><!--end .offcanvas-->
      <!-- END OFFCANVAS LEFT -->

      <!-- BEGIN CONTENT-->
      <div id="content">
        <section>
          <div class="section-body">
            <div >

                                 <div id="page-wrapper" >
                                  <div id="page-inner" style="padding: 0px;">
                                      <div class="row">
                                          <div class="col-md-12">
                                           <h2></h2>
                                          </div>
                                      </div>
                                      
                                      
                                      <!-- <div style="margin-bottom: 0px;padding-bottom: 0px;" class="row text-center pad-top col-sm-12" > -->
                                          <!--****************************************-->
                                      <div style="text-align: right;display: inline-block" class="col-sm-12">
                                            
                                              <i class="glyphicon glyphicon-time"></i><span> Date-Heure Actuelle : &nbsp;&nbsp;&nbsp;
                                              <a style="display: inline-block;padding-top: 0px;margin-top: 0px;padding-bottom: 0px;margin-bottom: 0px;" href="https://24timezones.com/fr_temps/rabat_temps_local.php" target="_blank" title="Heure exacte du MAROC sur Internet">

                                                <p style="padding-top: 0px;margin-top: 0px;padding-bottom: 0px;margin-bottom: 0px;" id="txt"></p>

                                            </a>
                                      </div>
                                      <div style="padding-top: 0px;margin-top: 0px;padding-bottom: 0px;margin-bottom: 0px;" class="row"></div>
                                      <hr />
                                      
                                      <div style="background-color: white" class="container clearfix col-sm-12">
                                          <?= $this->Flash->render() ?>
                                          <?= $this->fetch('content') ?>
                                      </div>
                                      <div class="row"></div>

                                       
                                      <!-- </div> -->
                                 
                                 </div>
                              </div>
                              <script type="text/javascript">
                                  
                                   $(document).ready(function(){  
                                      $('.content').addClass('width100');
                                      $('.content *').css('word-break',"keep-all");
                                       $('.related').addClass('width100');
                                       $('table').addClass('width100');
                                       $('#main-menu a').css('line-height',"15%");
                                       $('#bs-example-navbar-collapse-1 a').css('font-size',"80%");
                                   }
                                  );
                              </script>

            </div><!--end .row -->
          </div><!--end .section-body -->
        </section>
        <br>
      </div><!--end #content-->
      <!-- END CONTENT -->
<!-******************************************************************************************************************************************-->
      <!-- BEGIN MENUBAR-->
      <div style="overflow: hidden;padding-bottom: 0px;margin-bottom: 0px"  id="menubar" class="menubar-inverse ">
        <div class="menubar-fixed-panel">
          <div>
            <a class="btn btn-icon-toggle btn-default menubar-toggle" data-toggle="menubar" href="javascript:void(0);">
              <i class="fa fa-bars"></i>
            </a>
          </div>
          
        </div>
        <div style="overflow: hidden;padding-bottom: 0px;margin-bottom: 0px;"  class="menubar-scroll-panel">

          <!-- BEGIN MAIN MENU -->
          <ul style="overflow: hidden;padding-bottom: 0px;margin-bottom: 0px;padding-top: 0px;margin-top: 0px" id="main-menu" class="gui-controls">

           
          <?php
                    if(
                          $this->request->session()->read('Auth.User.ID') 
                          && 
                          $this->request->session()->read('Auth.User.profil') == "Administrateur"
                      )
                      {  
                  ?>

                   <!-- BEGIN DASHBOARD -->
                  
                      <li style="overflow: hidden;padding-bottom: 0px;margin-bottom: 0px" >
                       
                          <div class="glyphicon glyphicon-th-list" style="font-size: 2em;"></div>
                         
                       
                      </li>
                      <!--end /menu-li -->
                    <!-- END DASHBOARD -->



                 
                        <li  style="overflow: hidden;padding-bottom: 0px;margin-bottom: 0px" >
                          <a>
                            <div class="glyphicon glyphicon-inbox menuleft"><span class="Menu-left-span"> &nbsp; Dépôts</span></div>
                            
                          </a>
                          <!--start submenu -->
                          <ul>
                             <li >
                                    <a href="<?= $this->Url->build(array('controller' => 'Deposits', 'action' => 'index')); ?>" >
                                      <i class="glyphicon glyphicon-folder-open"></i> &nbsp; Gestionnaire des Dépôts
                                    </a>
                                </li>
                                <li >
                                    <a href="<?= $this->Url->build(array('controller' => 'Deposits', 'action' => 'nonrepondant')); ?>" >
                                      <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; Gestionnaire des non répondant
                                    </a>
                                </li>
                          </ul><!--end /submenu -->
                        </li><!--end /menu-li -->
                      





                        <li style="overflow: hidden;padding-bottom: 0px;margin-bottom: 0px" >
                          <a>
                            <div class="glyphicon glyphicon-user menuleft"><span class="Menu-left-span"> &nbsp; Utilisateurs</span></div>
                            
                          </a>
                          <!--start submenu -->
                          <ul>
                                  <li >
                                      <a href="<?= $this->Url->build(array('controller' => 'Users', 'action' => 'index')); ?>" >
                                        <i class="glyphicon glyphicon-briefcase"></i> &nbsp; Gestionnaire d'Opérateurs
                                      </a>
                                  </li>
                                  <li >
                                      <a href="<?= $this->Url->build(array('controller' => 'Users', 'action' => 'admins')); ?>" >
                                        <i class="glyphicon glyphicon-tower"></i> &nbsp; Gestionnaire d'Administrateurs
                                      </a>
                                  </li>
                                  <li >
                                      <a href="<?= $this->Url->build(array('controller' => 'Users', 'action' => 'add')); ?>" >
                                        <i class="glyphicon glyphicon-user"></i> &nbsp; Ajouter Utilisateur
                                      </a>
                                  </li>
                                  <li >
                                      <a href="<?= $this->Url->build(array('controller' => 'Logs', 'action' => 'index')); ?>" >
                                        <i class="glyphicon glyphicon-record"></i> &nbsp; Journal Connexion
                                      </a>
                                  </li>
                 
                          </ul><!--end /submenu -->
                        </li><!--end /menu-li -->






                        <li style="overflow: hidden;padding-bottom: 0px;margin-bottom: 0px" >
                          <a>
                            <div class="glyphicon glyphicon-tags menuleft"><span class="Menu-left-span""> &nbsp; Centres</span></div>
                           
                          </a>
                          <!--start submenu -->
                          <ul>
                                  <li >
                                      <a href="<?= $this->Url->build(array('controller' => 'Centers', 'action' => 'index')); ?>" >
                                        <i class="glyphicon glyphicon-tag"></i> &nbsp; Gestionnaire des Centres
                                      </a>
                                  </li>
                                  <li >
                                      <a href="<?= $this->Url->build(array('controller' => 'Centers', 'action' => 'add')); ?>" >
                                        <i class="glyphicon glyphicon-tag"></i> &nbsp; Ajouter Centre
                                      </a>
                                  </li>
                          </ul><!--end /submenu -->
                        </li><!--end /menu-li -->

                        


                        <li style="overflow: hidden;padding-bottom: 0px;margin-bottom: 0px"  >
                                      <a>
                                        <div class="glyphicon glyphicon-th-list menuleft"><span  class="Menu-left-span">  Domaines d'Enquêtes</span></div>
                                      
                                      </a>
                                      <!--start submenu -->
                                      <ul>
                                          <li >
                                              <a href="<?= $this->Url->build(array('controller' => 'Domains', 'action' => 'index')); ?>" >
                                                <i class="glyphicon glyphicon-screenshot"></i> &nbsp; Gestionnaire des Domaines
                                              </a>
                                          </li>
                                          <li >
                                              <a href="<?= $this->Url->build(array('controller' => 'Domains', 'action' => 'add')); ?>" >
                                                <i class="glyphicon glyphicon-screenshot"></i> &nbsp; Ajouter Domaine
                                              </a>
                                          </li>
                                      </ul><!--end /submenu -->
                     </li><!--end /menu-li -->




                        <li style="overflow: hidden;padding-bottom: 0px;margin-bottom: 0px" >
                                      <a>
                                        <div class="glyphicon glyphicon-list-alt menuleft">
                                        <span class="Menu-left-span"> Formulaires d'Enquêtes</span>
                                        </div>
                                     
                                      </a>
                                      <!--start submenu -->
                                      <ul>
                                         <li >
                                              <a href="<?= $this->Url->build(array('controller' => 'Surveys', 'action' => 'index')); ?>" >
                                                <i class="glyphicon glyphicon-folder-close"></i> &nbsp; Gestionnaire des Fomulaires
                                              </a>
                                          </li>
                                          <li >
                                              <a href="<?= $this->Url->build(array('controller' => 'Surveys', 'action' => 'formulaires')); ?>" >
                                                <i class="fa fa-download"></i> &nbsp; Liste des Fomulaires
                                              </a>
                                          </li>
                                          <li >
                                              <a href="<?= $this->Url->build(array('controller' => 'Surveys', 'action' => 'add')); ?>" >
                                                <i class="fa fa-upload"></i> &nbsp; Ajouter Fomulaires Enquête
                                              </a>
                                          </li>
                                      </ul><!--end /submenu -->
                     </li><!--end /menu-li -->

                    <br>
                    <?php
                      }
                      else
                      {
     
            ?> 
                      <li style="overflow: hidden;padding-bottom: 0px;margin-bottom: 0px" >
                       
                          <div class="glyphicon glyphicon-triangle-right" style="font-size: 1em;"></div>
                          <div class="glyphicon glyphicon-triangle-right" style="font-size: 1em;"></div>
                         
                       
                      </li> 
            <?php
                    }  
            ?>



            <!--end /menu-li -->
            <!-- END EMAIL -->
          </ul>
         
          <!-- END MAIN MENU -->
<!-******************************************************************************************************************************************-->
          <div style="overflow: hidden;padding-top: 0px;margin-top: 0px" class="menubar-foot-panel">
               
            <small class="no-linebreak hidden-folded">

              <hr style="color: white">
              <div style=" width: 340px ; height: 100%;">
                  <div style="font-size: 160%">
                    <a >
                      <strong><DIV class="glyphicon glyphicon-info-sign"><span style="font-size: 90%">&nbsp;Important : </span></DIV></strong>
                    </a>
                  </div>
                   <p style="color: white; font-size: 10px;padding: 4px;margin: 4px"  >
                      Conformément à la loi 09-08, 
                      <br>vous disposez d'un droit d'accès, 
                      <br>de rectification et d'opposition 
                      <br>au traitement de vos données personnelles.
                      <br> Ce traitement a été déclaré auprès de la CNDP 
                      <br>sous le numéro D-PO-199/2016. 
                   </p>
              </div>
              <hr style="color: white">
                <span class="opacity-75">
                  <a href="http://www.oc.gov.ma/" target="_blank">Office des Changes</a> &nbsp; &copy; &nbsp;  2017.
                  <br>
                  DEPOSITS MANAGEMENT <b>Version: </b> 1.2.2
                  <br>
                  <a href="<?= $this->Url->build("/Pages/aboutus"); ?>"> <i class=" glyphicon glyphicon-asterisk"></i> EMSI HimoCrypto Developpers</a>
                </span>

            </small>
          </div>
<!-******************************************************************************************************************************************-->
        </div><!--end .menubar-scroll-panel-->
      </div><!--end #menubar-->
      <!-- END MENUBAR -->

      
    </div><!--end #base-->
    <!-- END BASE -->

    <!-- BEGIN JAVASCRIPT -->
    <?php
        $action = $this->request->params['action'];
        $controller = $this->request->params['controller'];
        if(

              !($controller == "Deposits" && $action == "index") 
                && 
              !($controller == "Domains" && $action == "edit") 
                && 
              !($controller == "Domains" && $action == "add")
                 && 
              !($controller == "Users" && $action == "add")
                && 
              !($controller == "Users" && $action == "edit")  
          )
        {  
    ?>
    <?= $this->Html->script('libs/jquery/jquery-1.11.2.min.js'); ?>
    <?= $this->Html->script('libs/jquery/jquery-migrate-1.2.1.min.js'); ?>
    <?php
        }  
    ?>
    <?= $this->Html->script('libs/bootstrap/bootstrap.min.js'); ?>
    <?= $this->Html->script('libs/spin.js/spin.min.js'); ?>
    <?= $this->Html->script('libs/autosize/jquery.autosize.min.js'); ?>
    <?= $this->Html->script('libs/moment/moment.min.js'); ?>
    <?= $this->Html->script('libs/flot/jquery.flot.min.js'); ?>
    <?= $this->Html->script('libs/flot/jquery.flot.time.min.js'); ?>
    <?= $this->Html->script('libs/flot/jquery.flot.resize.min.js'); ?>
    <?= $this->Html->script('libs/flot/jquery.flot.orderBars.js'); ?>
    <?= $this->Html->script('libs/flot/jquery.flot.pie.js'); ?>
    <?= $this->Html->script('libs/flot/curvedLines.js'); ?>
    <?= $this->Html->script('libs/jquery-knob/jquery.knob.min.js'); ?>
    <?= $this->Html->script('libs/sparkline/jquery.sparkline.min.js'); ?>
    <?= $this->Html->script('libs/nanoscroller/jquery.nanoscroller.min.js'); ?>
    <?= $this->Html->script('libs/d3/d3.min.js'); ?>
    <?= $this->Html->script('libs/d3/d3.v3.js'); ?>
    <?= $this->Html->script('libs/rickshaw/rickshaw.min'); ?>
    <?= $this->Html->script('core/source/App.js'); ?>
    <?= $this->Html->script('core/source/AppNavigation.js'); ?>
    <?= $this->Html->script('core/source/AppOffcanvas.js'); ?>
    <?= $this->Html->script('core/source/AppCard.js'); ?>
    <?= $this->Html->script('core/source/AppForm.js'); ?>
    <?= $this->Html->script('core/source/AppNavSearch.js'); ?>
    <?= $this->Html->script('core/source/AppVendor.js'); ?>
    <?= $this->Html->script('core/demo/Demo.js'); ?>
    <?= $this->Html->script('core/demo/DemoDashboard.js'); ?>
    <!-- END JAVASCRIPT -->



    <?= $this->Html->script('bootstrap.min'); ?>
    <?= $this->Html->script('bootstrap'); ?>

    <?= $this->Html->script('custom'); ?>
    <?= $this->fetch("script"); ?>
 
    


  </body>
  <style type="text/css">
    
  .menuleft{
    white-space:nowrap; font-size: 16px;margin-right: 6%;color: rgba(255, 255, 255, 0.65);
  }
  .Menu-left-span{
   margin-left: 2em;
  font-size: 16px;
  transition: all 0.5s cubic-bezier(0.15, 0.99, 0.18, 1.01);
  }
  .menubar-pin #menubar {
    width: 340px;
  
  }
  .menubar-pin #base {
    padding-left: 340px;
}
.menubar-visible #menubar {
    width: 340px;
}
  </style>
</html>


<script>
function startTime() 
{
    var today = new Date();
    var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' ,timeZone : 'Africa/Casablanca'};
    var jour = new Intl.DateTimeFormat('fr-FR',options).format(today);
    jour = jour.toString();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    h = checkTime(h);
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('txt').innerHTML = '' + 
    jour + " &nbsp;&nbsp;  " + h +":"+ m +":"+s +"</span>";
    var t = setTimeout(startTime, 500);
}
function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
}
</script>


<?php
    $action = $this->request->params['action'];
    $controller = $this->request->params['controller'];
    if(
              !($controller == "Deposits" && $action == "index") 
                && 
              !($controller == "Domains" && $action == "edit") 
                && 
              !($controller == "Domains" && $action == "add")
                 && 
              !($controller == "Users" && $action == "add")
                && 
              !($controller == "Users" && $action == "edit")  
      )
    {  
?>

<script type="text/javascript">
    $(document).ready(
                        function()
                        {

                            $(".content *").css("font-size","100%");
                            $(".content *").css("height","100%");
                            $(".content *").css("width","50%");

                            
                            

                        }
                     );
    
</script>


<?php
    }  
?>