<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Packages Controller
 *
 * @property \App\Model\Table\PackagesTable $Packages
 * @method \App\Model\Entity\Package[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PackagesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $packages = $this->paginate($this->Packages);

        $this->set(compact('packages'));
    }

    /**
     * View method
     *
     * @param string|null $id Package id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $package = $this->Packages->get($id, [
            'contain' => ['Sheets'],
        ]);

        $this->set(compact('package'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $package = $this->Packages->newEmptyEntity();
        if ($this->request->is('post')) {
            $package = $this->Packages->patchEntity($package, $this->request->getData());
            if ($this->Packages->save($package)) {
                $this->Flash->success(__('The package has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The package could not be saved. Please, try again.'));
        }
        $sheets = $this->Packages->Sheets->find('list', ['limit' => 200])->all();
        $this->set(compact('package', 'sheets'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Package id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $package = $this->Packages->get($id, [
            'contain' => ['Sheets'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $package = $this->Packages->patchEntity($package, $this->request->getData());
            if ($this->Packages->save($package)) {
                $this->Flash->success(__('The package has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The package could not be saved. Please, try again.'));
        }
        $sheets = $this->Packages->Sheets->find('list', ['limit' => 200])->all();
        $this->set(compact('package', 'sheets'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Package id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $package = $this->Packages->get($id);
        if ($this->Packages->delete($package)) {
            $this->Flash->success(__('The package has been deleted.'));
        } else {
            $this->Flash->error(__('The package could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
