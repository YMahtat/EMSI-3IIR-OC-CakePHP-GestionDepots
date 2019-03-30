<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;
use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;
/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[] paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    //
    public function initialize()
    {
        parent::initialize();
        $this->loadModel("DomainsUsers");
        $this->loadModel("Logs");
    }


    public function forgetpassword()
    {
        $users = $this->paginate($this->Users->find()->where(["profil ="=> "Administrateur"])->AndWhere(["id != "=>1]));

        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Centers']
        ];
        $users = $this->paginate($this->Users->find()->where(["profil ="=> "Operateur"]));
        if ($this->request->is('post') && isset($this->request->data["organization"]))
        {
            $org = $this->request->data["organization"];
            if ($org) 
            {
                
                $users = $this->paginate($this->Users->find()
                                                        ->where(["profil ="=> "Operateur"])
                                                        ->AndWhere(["organization LIKE"=> "%".$org."%"])
                                        );

            }
        }

        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function admins()
    {
        $users = $this->paginate($this->Users->find()->where(["profil ="=> "Administrateur"]));

        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        if(
                $this->request->session()->read('Auth.User.profil') != "Administrateur"
                &&
                $this->request->session()->read('Auth.User.ID') != $id
          )
        {
          return $this->redirect("/");
        }
        $user = $this->Users->get($id, [
            'contain' => ['Centers', 'Domains', 'Deposits']
        ]);

        $lastLogs = $this->Logs->find()->where(["user_id = "=> $id])->order(["created"=>"DESC"])->limit(2);

        $this->set(compact("user","lastLogs"));
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {

        $user = $this->Users->newEntity();
        if ($this->request->is('post')) 
        {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            $now = Time::now();
            $now = $now->i18nFormat('yyyy-MM-dd HH:mm:ss');
            if(!$user->NERC)
                $user->NERC = $now;
            if(!$user->CNSS)
                $user->CNSS = $now;
            if(!$user->ICE)
                $user->ICE = $now;
            $user->is_new = 1;
            if (isPhone($user->phone) && $userS = $this->Users->save($user)) 
            {
                $this->Flash->success(__("l'".$userS->profil.' est ajouté.'));
                if($userS->profil == "Operateur")
                    return $this->redirect(['action' => 'index']);
                else
                    return $this->redirect(['action' => 'admins']);
            }
            $this->Flash->error(__("ERROR : l'".$user->profil." n'est pas ajouté ! "));
        }
        $centers = $this->Users->Centers->find('list', ['limit' => 200]);
        $domains = $this->Users->Domains->find('list', ['limit' => 200]);
        $this->set(compact('user', 'centers',"domains"));
        $this->set('_serialize', ['user']);
    }


    public function testempty()
    {
    	//$this->request->session()->write('Auth.User.MAJ',Time::now());
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
      if(
            $this->request->session()->read('Auth.User.profil') != "Administrateur"
            &&
            $this->request->session()->read('Auth.User.ID') != $id
        )
        {
          return $this->redirect("/");
        }
        $user = $this->Users->get($id, [
            'contain' => ['Domains']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if (isPhone($user->phone) && $user = $this->Users->save($user)) 
            {
                $this->Flash->success(__("les modifications sont sauvegardées !"));
                return $this->redirect(['action' => 'view',$user->ID]);
                
            }
            $this->Flash->error(__("ERROR : les modifications ne sont pas sauvegardé !"));
        }
        $centers = $this->Users->Centers->find('list', ['limit' => 200]);
        $domains = $this->Users->Domains->find('list', ['limit' => 200]);
        
        $this->set(compact('user', 'centers', 'domains'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        $profil = $user->profil;
        if ($this->Users->delete($user)) 
        {
            $this->Flash->success(__("l'".$user->profil.' est supprimé.'));
        } 
        else 
        {
            $this->Flash->error(__(" ERROR : l'".$user->profil." n'est pas supprimé !"));
        }
         if($profil == "Operateur")
            return $this->redirect(['action' => 'index']);
        else
            return $this->redirect(['action' => 'admins']);

    }

    public function login()
    {
        if($this->request->session()->read('Auth.User.ID'))
        {
            if ($this->request->session()->read('Auth.User.profil') == "Administrateur") 
            {
               return $this->redirect(['controller' => 'Deposits',"action"=>"adminhome"]);
            }
            else
            {
                return $this->redirect(['controller' => 'Pages',"action"=>"index"]);
            }
        }

        if ($this->request->is('post')) 
        {
            $user = $this->Auth->identify();
            if ($user) 
            {
                $this->Auth->setUser($user);
                $log = $this->Logs->newEntity();
                
                $log->user_id = $this->request->session()->read('Auth.User.ID');
                $log->updated = Time::now();
                $log = $this->Logs->save($log);
                $this->request->session()->write('Auth.User.log_id',$log->ID);
                if($this->request->session()->read('Auth.User.profil') == "Administrateur")
                {
                    if($this->request->session()->read('Auth.User.is_new') == "1")
                    {
                            $this->Flash->default(__("Vous étes un nouveau utilisateur ou votre mot de passe a été modifié ! Veuillez redéfinir votre mot de passe."));
                             return $this->redirect("/users/newpassword/".$this->request->session()->read('Auth.User.ID'));

                    }
                    else
                    {
                        return $this->redirect(['controller' => 'Deposits',"action"=>"adminhome"]);
                    }
                    
                }
                else
                {
                    
                    if($this->request->session()->read('Auth.User.is_new') == "1")
                    {
                            $this->Flash->default(__("Vous étes un nouveau utilisateur ou votre mot de passe a été modifié ! Veuillez redéfinir votre mot de passe."));
                            return $this->redirect("/users/newpassword/".$this->request->session()->read('Auth.User.ID'));

                    }
                    else
                    {
                        $this->Flash->default(__("Conformément à la loi 09-08, vous disposez d'un droit d'accès, de rectification et d'opposition au traitement de vos données personnelles. Ce traitement a été déclaré auprès de la CNDP sous le numéro D-PO-199/2016."));
                        return $this->redirect(['controller' => 'pages',"action"=>"index"]);
                    }
                    
                }
                
            } 
            else 
            {
                $this->Flash->error(__("ERROR : Nom d'utilisateur ou mot de passe incorrect"));
            }
        }
    }

    public function logout()
    {
    	$log = $this->Logs->get($this->request->session()->read('Auth.User.log_id'));
    	if($log->deconnected == null)
    	{
    		$log->deconnected = Time::now();
    		$log = $this->Logs->save($log);
    	}
        $this->redirect($this->Auth->logout());
    }

    public function password($id = null)
    {
    	$user = $this->Users->get($id, [
            'contain' => ['Domains']
        ]);
    	if ($this->request->is('post')) 
        {
        	$od = (new DefaultPasswordHasher)->check($this->request->data['old_password'],$user->password);
		    if($od)
		    {
		    	$user->password = $this->request->data['newpassword'];
		    	if ($this->Users->save($user))
		    	{
		    		$this->Flash->success(__('Le mot de passe est modifié.'));
		    		return $this->redirect(['action' => 'view',$id]);
		    	}
		    }
		    else
		    {
		    	$this->Flash->error(__("l'ancien mot de passe n'est pas corretement saisi !!"));	
		    }
		    
        }
    }

    public function newpassword($id = null)
    {

        //

        if(
            $this->request->session()->read('Auth.User.ID') != $id
          )
        {
          return $this->redirect("/");
        }
        $user = $this->Users->get($id, [
            'contain' => ['Domains']
        ]);
        if ($this->request->is('post')) 
        {

            $user->password = $this->request->data['newpassword'];
            $user->is_new = 0;
            if ($this->Users->save($user))
            {
                $this->Flash->success(__('Le mot de passe est modifié.'));
                $this->Flash->default(__("Conformément à la loi 09-08, vous disposez d'un droit d'accès, de rectification et d'opposition au traitement de vos données personnelles. Ce traitement a été déclaré auprès de la CNDP sous le numéro D-PO-199/2016."));
                return $this->redirect(['controller' => 'pages',"action"=>"index"]);
            }

            
        }
    }


    public function addnewpassword($id = null)
    {


        $user = $this->Users->get($id, [
            'contain' => ['Domains']
        ]);
        if ($this->request->is('post')) 
        {

            $user->password = $this->request->data['newpassword'];
            $user->is_new = 1;
            if ($this->Users->save($user))
            {
                $this->Flash->success(__('Le mot de passe est modifié.'));
                return $this->redirect(['action' => 'index']);
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

}


function isPhone($phone_num)
{
    if(preg_match("/^(\+212|0)[0-9]{9}$/", $phone_num))
    {
        return true;
    }
    else
    {
        return false;
    }

}