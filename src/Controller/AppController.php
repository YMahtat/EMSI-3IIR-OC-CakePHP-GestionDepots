<?php


   

/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();



        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Auth', [
                                'loginAction' => [
                                    'controller' => 'Users', //Controller Users, ou la classe qui correspond aux utilisateurs du site
                                    'action' => 'login', // nom de la methode d'indentification
                                    
                                ],
                                'authError' => 'Vous croyez vraiment que vous pouvez faire cela?', // Message à afficher s'il y a accès sans authentification
                                'authenticate' => [
                                    'Form' => [
                                        'fields' => ['username' => 'email','password' => 'password'] 
                                        // il faut indiquer les attributs d'identification  (login,password) ou (email,MDP) .....
                                    ]
                                ],
                                'storage' => 'Session'
                            ]);
        /*
         * Enable the following components for recommended CakePHP security settings.
         * see http://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
        //$this->loadComponent('Csrf');
    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return \Cake\Network\Response|null|void
     */
    public function beforeRender(Event $event)
    {
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
    }



    public function beforeFilter(Event $event)
	{

	    parent::beforeFilter($event);



        $action = $this->request->params['action'];
        $controller = $this->request->params['controller'];
        if
          ( 
                empty( $this->request->session()->read('Auth.User.ID') ) 
                && 
                (
                  $controller != "Pages" && $action != "login" && $action != "forgetpassword" && $action != "aboutus"
                  && $action != "formulaires" && !($action == "add" && $controller == "Deposits")
                )
          )
        {
            return $this->redirect(['controller' => 'pages',"action"=>"index"]);
        }

        if($action == "forgetpassword" || $controller == "Pages")
        {
            $this->Auth->allow(['controller' => $controller, 'action' => $action]);
        }
        


	    $id = null;
	    if( !empty( $this->request->session()->read('Auth.User.log_id') ) )
	    {
	    	$id = $this->request->session()->read('Auth.User.log_id');
	    }



	    if(updateLog($id))
	    	$this->redirect($this->Auth->logout());
           
        // Gestion des Autorisations :   
        $autorized = array(
                            ["Users","login"],["Users","logout"],["Users","view"],["Users","edit"],["Users","password"],
                            ["Users","newpassword"],
                            ["Surveys","formulaires"],
                            ["Deposits","add"],["Deposits","edit"],["Deposits","view"],["Deposits","my"],
                            ["Pages","index"],["Pages","aboutus"]
                          );
        if($this->request->session()->read('Auth.User.profil') == "Operateur" )
        {

          if(!($action == "newpassword" && $controller == "Users") && array_search([$controller,$action],$autorized) == false)
                 return $this->redirect(['controller' => 'pages',"action"=>"index"]);
        }
        else
        {
            $action = $this->request->params['action'];
            if($action == "my")
                return $this->redirect(['controller' => 'Deposits',"action"=>"adminhome"]);
        }
	}


    

}



function updateLog($id = null)
{
	
	$Logs = TableRegistry::get('Logs');
	$logs = $Logs->find("all");
	$isLogOUT = false;
	foreach ($logs as $key => $log) 
	{
		$now = Time::now();
		$du = new Time($log->updated);
		$dec = $log->deconnected;
		$interval = $now->diff($du);
		$interval = calculateMinutes($interval);
		if(($dec == null))
		{
			if(($interval <= 10))
			{
				$log->updated = Time::now();
				$Logs->save($log);
				
			}
			else
			{
				$log->deconnected = $now;
				$Logs->save($log);
			}
			
		}

		if ($dec != null && $id == $log->ID) 
		{
			$isLogOUT = true;
		}

	}

	return $isLogOUT;
}



function calculateMinutes($int)
{
    $days = $int->format('%a');
    return ($days * 24 * 60) + ($int->h * 60) + $int->i;
}


