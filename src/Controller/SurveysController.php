<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Surveys Controller
 *
 * @property \App\Model\Table\SurveysTable $Surveys
 *
 * @method \App\Model\Entity\Survey[] paginate($object = null, array $settings = [])
 */
class SurveysController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel("Domains");
        $this->loadModel("Surveys");

    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Domains']
        ];
        $surveys = $this->paginate($this->Surveys);

        $this->set(compact('surveys'));
        $this->set('_serialize', ['surveys']);
    }

    public function formulaires()
    {

        $surveys = $this->Surveys->find("all");
        $srvs =array();
        foreach ($surveys as $key => $value) 
        {
            $srvs[$value->domain_id][$value->ID] = $value;
        }

        $domains = $this->Domains->find("all");
        $this->set(compact('srvs',"domains"));
    }

    /**
     * View method
     *
     * @param string|null $id Survey id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $survey = $this->Surveys->get($id, [
            'contain' => ['Domains', 'Deposits',"Deposits.Users"]
        ]);

        $this->set('survey', $survey);
        $this->set('_serialize', ['survey']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $survey = $this->Surveys->newEntity();
        if ($this->request->is('post')) {
            
            $survey = $this->Surveys->patchEntity($survey, $this->request->getData());
            if(VerifySurveyFileeMIME($this->request->data['url'],WWW_ROOT . 'files/surveys'))
            {
                $survey->url = AddFile($this->request->data['url'],WWW_ROOT . 'files/surveys' , "add");
                if ($this->Surveys->save($survey)) 
                {
                    $this->Flash->success(__("Formulaire d'Enuête ajouté."));

                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__("ERROR : Formulaire d'Enuête non ajouté."));
            }
            else
            {
                $this->Flash->error(__("ERROR : Le type du fichier formulaire n'est pas accepté."));
            }
            
        }
        $domains = $this->Surveys->Domains->find('list', ['limit' => 200]);
        $this->set(compact('survey', 'domains'));
        $this->set('_serialize', ['survey']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Survey id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $survey = $this->Surveys->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) 
        {

                $survey = $this->Surveys->patchEntity($survey, $this->request->getData());
                if(VerifySurveyFileeMIME($this->request->data['url'],WWW_ROOT . 'files/surveys'))
                {
                    $survey->url = AddFile($this->request->data['url'],WWW_ROOT . 'files/surveys');
                    if ($this->Surveys->save($survey)) {
                        $this->Flash->success(__("Modification sauvegardée."));

                        return $this->redirect(['action' => 'index']);
                    }
                    $this->Flash->error(__("ERROR : Modification nn sauvegardée."));
                }
                else
                {
                    $this->Flash->error(__("ERROR : Le type du fichier formulaire n'est pas accepté."));
                }
        }
        $domains = $this->Surveys->Domains->find('list', ['limit' => 200]);
        $this->set(compact('survey', 'domains'));
        $this->set('_serialize', ['survey']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Survey id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $survey = $this->Surveys->get($id);
        if ($this->Surveys->delete($survey)) {
            $this->Flash->success(__("Formulaire d'Enuête supprimé."));
        } else {
            $this->Flash->error(__("ERROR : Formulaire d'Enuête nn supprimé."));
        }

        return $this->redirect(['action' => 'index']);
    }
}


function AddFile($file,$path,$VERIF = NULL)
{
    $MAX = 100000000;
    $isAdd = false;

    if($VERIF == "add")
        $isAdd = true;


    $newName = pathinfo($file['name'], PATHINFO_FILENAME); 

    //$validextensions = array("jpeg", "jpg", "png");
    //$temporary = explode(".", $file["name"]);
    //$file_extension = end($temporary);
    if ( ($file["size"] < $MAX) ) 
    {
        $ext=strtolower( pathinfo($file['name'],PATHINFO_EXTENSION));
        if ($file["error"] > 0) 
        {
            echo "Return Code: " . $file["error"] . "<br/><br/>";
        }
        else 
        {
                $Newfile = $newName;
                $cpt = 1;
                while(file_exists($path."/" . $Newfile.".".$ext)  && $isAdd)
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
        echo "<span id='invalid'>***Invalid file Size or Type***<span>";
        $file = "";
    }

}



function VerifySurveyFileeMIME($file)
{


    $arrayExtensionResponse = array("",
                            "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
                            "application/vnd.ms-excel"
                        );

    $finfo = finfo_open(FILEINFO_MIME_TYPE); 

    $boolean = array_search(finfo_file($finfo, $file["tmp_name"]), $arrayExtensionResponse);
    return $boolean;
}