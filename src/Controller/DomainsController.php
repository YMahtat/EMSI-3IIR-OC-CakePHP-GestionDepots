<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Domains Controller
 *
 * @property \App\Model\Table\DomainsTable $Domains
 *
 * @method \App\Model\Entity\Domain[] paginate($object = null, array $settings = [])
 */
class DomainsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $domains = $this->paginate($this->Domains);

        $this->set(compact('domains'));
        $this->set('_serialize', ['domains']);
    }

    /**
     * View method
     *
     * @param string|null $id Domain id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $domain = $this->Domains->get($id, [
            'contain' => ['Users', 'Surveys']
        ]);

        $this->set('domain', $domain);
        $this->set('_serialize', ['domain']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $domain = $this->Domains->newEntity();
        if ($this->request->is('post')) {
            $domain = $this->Domains->patchEntity($domain, $this->request->getData());
            if ($this->Domains->save($domain)) {
                $this->Flash->success(__('Le domaine est ajouté.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('ERROR : Le domaine ne peut pas être ajouté !!!'));
        }
        $users = $this->Domains->Users->find('list', ['limit' => 200])->where(["profil = "=>"Operateur"]);
        $this->set(compact('domain', 'users'));
        $this->set('_serialize', ['domain']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Domain id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $domain = $this->Domains->get($id, [
            'contain' => ['Users']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $domain = $this->Domains->patchEntity($domain, $this->request->getData());
            if ($this->Domains->save($domain)) {
                $this->Flash->success(__('modifications sont sauvegardées.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__(' ERROR : modifications non sauvegardées.'));
        }
       	$users = $this->Domains->Users->find('list', ['limit' => 200])->where(["profil = "=>"Operateur"]);
        $this->set(compact('domain', 'users'));
        $this->set('_serialize', ['domain']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Domain id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $domain = $this->Domains->get($id);
        if ($this->Domains->delete($domain)) {
            $this->Flash->success(__('Domaine supprimé.'));
        } else {
            $this->Flash->error(__('ERROR : Domaine non supprimé.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
