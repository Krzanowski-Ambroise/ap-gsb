<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Outpackages Controller
 *
 * @property \App\Model\Table\OutpackagesTable $Outpackages
 * @method \App\Model\Entity\Outpackage[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class OutpackagesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $outpackages = $this->paginate($this->Outpackages);

        $this->set(compact('outpackages'));
    }

    /**
     * View method
     *
     * @param string|null $id Outpackage id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $outpackage = $this->Outpackages->get($id, [
            'contain' => ['Sheets'],
        ]);

        $this->set(compact('outpackage'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $outpackage = $this->Outpackages->newEmptyEntity();
        if ($this->request->is('post')) {
            $outpackage = $this->Outpackages->patchEntity($outpackage, $this->request->getData());
            if ($this->Outpackages->save($outpackage)) {
                $this->Flash->success(__('The outpackage has been saved.'));

                //return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The outpackage could not be saved. Please, try again.'));
        }
        $sheets = $this->Outpackages->Sheets->find('list', ['limit' => 200])->all();
        $this->set(compact('outpackage', 'sheets'));
    }

    public function addoutpackage()
    {
        $outpackage = $this->Outpackages->newEmptyEntity();
        if ($this->request->is('post')) {
            $outpackage = $this->Outpackages->patchEntity($outpackage, $this->request->getData());
            if ($this->Outpackages->save($outpackage)) {
                $this->Flash->success(__('The outpackage has been saved.'));
                $data = $this->request->getData('sheets._ids');
                $firstValue = reset($data); // Obtient le premier élément du tableau
                $intValue = (int)$firstValue;
                return $this->redirect(['controller' => 'sheets','action' => 'clientview', $intValue]);
            }
            $this->Flash->error(__('The outpackage could not be saved. Please, try again.'));
        }
        $sheets = $this->Outpackages->Sheets->find('list', ['limit' => 200])->all();
        $this->set(compact('outpackage', 'sheets'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Outpackage id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $outpackage = $this->Outpackages->get($id, [
            'contain' => ['Sheets'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $outpackage = $this->Outpackages->patchEntity($outpackage, $this->request->getData());
            if ($this->Outpackages->save($outpackage)) {
                $this->Flash->success(__('The outpackage has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The outpackage could not be saved. Please, try again.'));
        }
        $sheets = $this->Outpackages->Sheets->find('list', ['limit' => 200])->all();
        $this->set(compact('outpackage', 'sheets'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Outpackage id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null,$iduser = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $outpackage = $this->Outpackages->get($id);
        if ($this->Outpackages->delete($outpackage)) {
            $this->Flash->success(__('The outpackage has been deleted.'));
        } else {
            $this->Flash->error(__('The outpackage could not be deleted. Please, try again.'));
        }

        return $this->redirect(['controller' => 'sheets','action' => 'clientview', $iduser]);
    }
}
