<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * SheetsPackages Controller
 *
 * @property \App\Model\Table\SheetsPackagesTable $SheetsPackages
 * @method \App\Model\Entity\SheetsPackage[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SheetsPackagesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Sheets', 'Packages'],
        ];
        $sheetsPackages = $this->paginate($this->SheetsPackages);

        $this->set(compact('sheetsPackages'));
    }

    /**
     * View method
     *
     * @param string|null $id Sheets Package id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $sheetsPackage = $this->SheetsPackages->get($id, [
            'contain' => ['Sheets', 'Packages'],
        ]);

        $this->set(compact('sheetsPackage'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $sheetsPackage = $this->SheetsPackages->newEmptyEntity();
        if ($this->request->is('post')) {
            $sheetsPackage = $this->SheetsPackages->patchEntity($sheetsPackage, $this->request->getData());
            if ($this->SheetsPackages->save($sheetsPackage)) {
                $this->Flash->success(__('The sheets package has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sheets package could not be saved. Please, try again.'));
        }
        $sheets = $this->SheetsPackages->Sheets->find('list', ['limit' => 200])->all();
        $packages = $this->SheetsPackages->Packages->find('list', ['limit' => 200])->all();
        $this->set(compact('sheetsPackage', 'sheets', 'packages'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Sheets Package id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $sheetsPackage = $this->SheetsPackages->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $sheetsPackage = $this->SheetsPackages->patchEntity($sheetsPackage, $this->request->getData());
            if ($this->SheetsPackages->save($sheetsPackage)) {
                $this->Flash->success(__('The sheets package has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sheets package could not be saved. Please, try again.'));
        }
        $sheets = $this->SheetsPackages->Sheets->find('list', ['limit' => 200])->all();
        $packages = $this->SheetsPackages->Packages->find('list', ['limit' => 200])->all();
        $this->set(compact('sheetsPackage', 'sheets', 'packages'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Sheets Package id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $sheetsPackage = $this->SheetsPackages->get($id);
        if ($this->SheetsPackages->delete($sheetsPackage)) {
            $this->Flash->success(__('The sheets package has been deleted.'));
        } else {
            $this->Flash->error(__('The sheets package could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
