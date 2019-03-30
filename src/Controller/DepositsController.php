<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;

/**
 * Deposits Controller
 *
 * @property \App\Model\Table\DepositsTable $Deposits
 *
 * @method \App\Model\Entity\Deposit[] paginate($object = null, array $settings = [])
 */
class DepositsController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadModel("Attachemnts");
        $this->loadModel("Domains");
        $this->loadModel("Surveys");
        $this->loadModel("Users");
        $this->loadModel("DomainsUsers");
    }

    public function adminhome()
    {
        $deposits = $this->Deposits->find("all");
        $domains = $this->Domains->find("all");
        $surveys = $this->Surveys->find("all");
        $srvs = array();
        // echo "<br>";
        // echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";
        $Logs = TableRegistry::get('Logs');
        $lastLog = $Logs->find()->where(["user_id = " => $this->request->session()->read('Auth.User.ID')])
                                ->order(['deconnected' => 'DESC'])
                                ->first();
        $lastDate = $lastLog->deconnected;
        $countNew = array();
        $countAll = array();
        $Deposits = TableRegistry::get('Deposits');
        foreach ($surveys as $key => $value) 
        {

            $srvs[$value->domain_id][$value->ID] = $value->name;
            $nbr = $Deposits->find()->where(["survey_id = " => $value->ID])->AndWhere(["created >=" =>$lastDate ]);
            $countNew[$value->ID] = $nbr->count();
            $nbr = $Deposits->find()->where(["survey_id = " => $value->ID]);
            $countAll[$value->ID] = $nbr->count();

        }

        $this->set(compact('domains','srvs',"countNew","countAll"));
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Surveys', 'Users']
        ];
        $userslist = array();
        $deposits = $this->Deposits->find()->where([" period > "=>0]);
        if ($this->request->is('post')) 
        {

            $userslist = $this->request->data["operators"];
            $years = $this->request->data["year"];
            $enquetes = $this->request->data["surveys"];
            if(!empty($userslist))
            {
                $deposits = $deposits->AndWhere(["user_id in " => $userslist]);
            }
            if(!empty($years))
            {
                $deposits = $deposits->AndWhere(["deposit_year in " => $years]);
            }
            if(!empty($enquetes))
            {
                $deposits = $deposits->AndWhere(["survey_id in " => $enquetes]);
            }

            
        }
        $deposits = $this->paginate($deposits);

        $users = $this->Deposits->Users->find('list', ['limit' => 200])->where(["profil = "=>"Operateur"]);
        $surveys = $this->Deposits->Surveys->find('list', ['limit' => 200]);
        
        
        $this->set(compact('deposits',"users","surveys","cpt"));
        $this->set('_serialize', ['deposits']);
    }

     public function my($id = null)
    {
      if(
                $this->request->session()->read('Auth.User.profil') != "Administrateur"
                &&
                $this->request->session()->read('Auth.User.ID') != $id
          )
        {
          return $this->redirect("/");
        }
        $this->paginate = [
            'contain' => ['Surveys', 'Users']
        ];

        $deposits = $this->paginate($this->Deposits->find()->where(["user_id ="=>$id]));
        $users = $this->Deposits->Users->find('list', ['limit' => 200])->where(["profil = "=>"Operateur"]);
        $this->set(compact('deposits',"users"));
        $this->set('_serialize', ['deposits']);
    }

    public function nonrepondant()
    {
        $this->paginate = [
            'contain' => ['Centers']
        ];

        if ($this->request->is('post'))
        {
            $users = $this->paginate($this->Users->find()->where(["profil ="=> "Operateur"]));
            $data = array();

            $survey = $this->Surveys->get( $this->request->data["survey_id"] , ['contain' => ['Domains', 'Deposits']]);
            $now = Time::now();
            foreach ($users  as $key => $value) 
            {
                
                $du = $this->DomainsUsers->find()->where(["user_id ="=>$value->ID])->AndWhere(["domain_id"=>$survey->domain->ID])->first();
                if($du)
                {
                    $minY = $du->created->year;
                    for ($i=$minY; $i <= $now->year ; $i++) 
                    {
                        $str = "";
                        for ($j=1 ; $j <= 12/$survey->periodicity ; $j++) 
                        { 
                            $deposit = $this->Deposits->find()
                                                        ->where(["user_id = " => $value->ID])
                                                        ->AndWhere(["survey_id = " => $survey->ID ])
                                                        ->AndWhere(["deposit_year = " => $i])
                                                        ->AndWhere(["period = " => $j])
                                                        ->first();
                            if(!isset($deposit->ID))
                            {
                                if($str == "")
                                {
                                    $str = $str.$j;
                                }
                                else
                                {
                                    $str = $str.", ".$j;

                                }
                                
                            }
                        }
                        $data[$value->ID][$i] =  $str;
                    }
                }

            }
        } 

        
        
        $surveys = $this->Surveys->find("list");
        $this->set(compact("users","surveys","data","survey"));
        $this->set('_serialize', ['deposits']);
    }

    /**
     * View method
     *
     * @param string|null $id Deposit id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {

       $deposit = $this->Deposits->get($id, [
            'contain' => ['Surveys', 'Users', 'Attachemnts']
        ]);
      if(
            $this->request->session()->read('Auth.User.profil') != "Administrateur"
            &&
            $this->request->session()->read('Auth.User.ID') != $deposit->user->ID
        )
        {
          return $this->redirect("/");
        }

        
        $othersDeposits = $this->Deposits->find()
                                            ->where(["ID !=" => $id])
                                            ->AndWhere(["user_id = " => $deposit->user->ID])
                                            ->AndWhere(["deposit_year = "=> $deposit->deposit_year])
                                            ->AndWhere(["period = "=> $deposit->period]);
        $this->set(compact('deposit',"othersDeposits"));
        $this->set('_serialize', ['deposit']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        if($this->request->session()->read('Auth.User.profil') == "Administrateur")
        {
          return $this->redirect(['action' => 'index']);
        }
        $type = "";
        if(isset($this->request->getParam('pass')[0]) && $this->request->getParam('pass')[0] == "modif") 
            $type = "MODIFICATION";
        else 
            $type = "NOUVEAU DEPOT";   

        $dataX =    [
                        'deposit_type' =>  $type
                    ];

        $deposit = $this->Deposits->newEntity($dataX);

        if ($this->request->is('post')) 
        {

            $deposit = $this->Deposits->patchEntity($deposit, $this->request->getData());
            $AlreadyExist = $this->Deposits->find()
                                    ->where(["period ="=>$deposit->period])
                                    ->AndWhere(["deposit_year = "=>$deposit->deposit_year])
                                    ->first();
            if (isset($AlreadyExist->ID)) 
            {
                $deposit->deposit_type = "MODIFICATION";
            }

            $boolean = true;
            if(isset($this->request->data["files"]))
            {
                foreach ($this->request->data["files"] as $key => $value) 
                {
                    $boolean = $boolean && VerifyFileMIME($value);
                }
            }
            if(VerifyFileResponseMIME($this->request->data['url']) == false)
            {
                $this->Flash->error(__("ERROR : Le type du fichier de reponse n'est pas accepté."));
            }
            elseif ($boolean == false) 
            {
                $this->Flash->error(__("ERROR : le type d'un ou plusieurs pièces jointes ne sont pas acceptées."));
            }   
            else if ($result=$this->Deposits->save($deposit)) 
            {
                //debug($result);
                //debug($deposit);
                $this->Flash->success(__('Le dépôt est enregistré.'));
                $result->url = AddFile($this->request->data['url'],WWW_ROOT . 'files/deposits',$result->ID);
                $this->Deposits->save($result);
                if(isset($this->request->data["files"]))
                {
                    foreach ($this->request->data["files"] as $key => $value) 
                    {
                        $attach = $this->Attachemnts->newEntity();
                        $attach->deposit_id  = $result->ID;
                        $attach->url = AddFile($value,WWW_ROOT . 'files/attachemnts');
                        $attach->comment = $this->request->data["comments"][$key];
                        $this->Attachemnts->save($attach);
                    }
                }
                return $this->redirect(['action' => 'my',$deposit->user_id]);
            }
            else
            {   

                 $this->Flash->error(__("ERROR : Le dépôt n'a pas été enregistrer !"));
            }
           
        }


        $domains = $this->Domains->find('all');
        $surveys = $this->Surveys->find("all");
        
        $srvs = array();
        
        $period = array();
        foreach ($surveys as $key => $value)
        {
            if(!isset($srvs[$value->domain_id]))
            {
                $srvs[$value->domain_id] = array($value->ID => $value->name);
            }
            else
            {
                $srvs[$value->domain_id] [$value->ID] = $value->name;
            }
            $period[$value->ID] = $value->periodicity;
        }

        foreach ($domains as $key => $value) 
        {
            if(!isset($srvs[$value->ID]))
            {
                $srvs[$value->ID] = array(""=>"");
                $ID = $value->ID;
                foreach ($srvs[$value->ID] as $key => $val) 
                {
                    $period[""] = 0;
                }
                
            }
        }


        $du =  $this->DomainsUsers->find('all');
        $dom = array();
        foreach ($domains as $key => $value)
        {
            $dom[$value->ID] = $value->name;
        }
        $domains = array();
        $minY = array();
        
        foreach ($du as $key => $value) 
        {
            if($value->user_id == $this->request->session()->read('Auth.User.ID'))
            {
                
                if(!isset($minY[$value->domain_id]))
                    $minY[$value->domain_id] = $value->created->year;
                else
                    $srvs[$value->domain_id] = $value->created;
                $domains[$value->domain_id] = $dom[$value->domain_id];
            }
        }
        $users = $this->Deposits->Users->find('list', ['limit' => 200]);
        $this->set(compact('deposit', 'srvs', 'users',"domains","minY","period"));
        $this->set('_serialize', ['deposit']);
    }

    
    

    /**
     * Delete method
     *
     * @param string|null $id Deposit id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $deposit = $this->Deposits->get($id);
        if ($this->Deposits->delete($deposit)) {
            $this->Flash->success(__('Dépôt Supprimé .'));
        } else {
            $this->Flash->error(__('ERROR : Dépôt nn Supprimé .'));
        }

        return $this->redirect(['action' => 'index']);
    }
}



function AddFile($file,$path,$newName = null)
{
    $MAX = 100000000;
    if($newName == null)
        $newName = pathinfo($file['name'], PATHINFO_FILENAME); 
    //$validextensions = array("jpeg", "jpg", "png");
    //$temporary = explode(".", $file["name"]);
    //$file_extension = end($temporary);
    if ( ($file["size"] < $MAX) ) 
    {
        $ext=strtolower(pathinfo($file['name'],PATHINFO_EXTENSION));
        if ($file["error"] > 0) 
        {
            echo "Return Code: " . $file["error"] . "<br/><br/>";
        }
        else 
        {
                $Newfile = $newName;
                $cpt = 1;
                while(file_exists($path."/" . $Newfile.".".$ext))
                {
                    $Newfile = $newName."_".$cpt;
                    $cpt += 1;
                }
                
                $sourcePath = $file['tmp_name']; // Storing source path of the file in a variable
                $targetPath = $path."/" . $Newfile.".".$ext; // Target path where file is to be stored
                move_uploaded_file($sourcePath, $targetPath); // Moving Uploaded file
                return $Newfile.".".$ext;
        }
    } 
    else 
    {
        return "";
    }

}


function VerifyFileMIME($file)
{
    $arrayExtension = array("",
                            "application/pdfo",
                            "application/pdf",
                            "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
                            "application/msword",
                        );

    

    $finfo = finfo_open(FILEINFO_MIME_TYPE); 

    $boolean = array_search(finfo_file($finfo, $file["tmp_name"]), $arrayExtension);
    return $boolean;
}


function VerifyFileResponseMIME($file)
{


    $arrayExtensionResponse = array("",
                            "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
                            "application/vnd.ms-excel"
                        );

    $finfo = finfo_open(FILEINFO_MIME_TYPE); 

    $boolean = array_search(finfo_file($finfo, $file["tmp_name"]), $arrayExtensionResponse);
    return $boolean;
}