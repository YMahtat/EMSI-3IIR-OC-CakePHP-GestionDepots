<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * DomainsUsers Controller
 *
 * @property \App\Model\Table\DomainsUsersTable $DomainsUsers
 *
 * @method \App\Model\Entity\DomainsUser[] paginate($object = null, array $settings = [])
 */
class DomainsUsersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Domains']
        ];
        $domainsUsers = $this->paginate($this->DomainsUsers);

        $this->set(compact('domainsUsers'));
        $this->set('_serialize', ['domainsUsers']);
    }

    /**
     * View method
     *
     * @param string|null $id Domains User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $domainsUser = $this->DomainsUsers->get($id, [
            'contain' => ['Users', 'Domains']
        ]);

        $this->set('domainsUser', $domainsUser);
        $this->set('_serialize', ['domainsUser']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $domainsUser = $this->DomainsUsers->newEntity();
        if ($this->request->is('post')) {
            $domainsUser = $this->DomainsUsers->patchEntity($domainsUser, $this->request->getData());
            if ($this->DomainsUsers->save($domainsUser)) {
                $this->Flash->success(__('The domains user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The domains user could not be saved. Please, try again.'));
        }
        $users = $this->DomainsUsers->Users->find('list', ['limit' => 200]);
        $domains = $this->DomainsUsers->Domains->find('list', ['limit' => 200]);
        $this->set(compact('domainsUser', 'users', 'domains'));
        $this->set('_serialize', ['domainsUser']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Domains User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $domainsUser = $this->DomainsUsers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $domainsUser = $this->DomainsUsers->patchEntity($domainsUser, $this->request->getData());
            if ($this->DomainsUsers->save($domainsUser)) {
                $this->Flash->success(__('The domains user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The domains user could not be saved. Please, try again.'));
        }
        $users = $this->DomainsUsers->Users->find('list', ['limit' => 200]);
        $domains = $this->DomainsUsers->Domains->find('list', ['limit' => 200]);
        $this->set(compact('domainsUser', 'users', 'domains'));
        $this->set('_serialize', ['domainsUser']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Domains User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $domainsUser = $this->DomainsUsers->get($id);
        if ($this->DomainsUsers->delete($domainsUser)) {
            $this->Flash->success(__('The domains user has been deleted.'));
        } else {
            $this->Flash->error(__('The domains user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
