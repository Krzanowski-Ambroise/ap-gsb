<?php
declare(strict_types=1);

namespace App\Controller;


/**
 * Sheets Controller
 *
 * @property \App\Model\Table\SheetsTable $Sheets
 * @method \App\Model\Entity\Sheet[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SheetsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'States'],
        ];
        $sheets = $this->paginate($this->Sheets);

        $this->set(compact('sheets'));
    }

    /**
     * View method
     *
     * @param string|null $id Sheet id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $sheet = $this->Sheets->get($id, [
            'contain' => ['Users', 'States', 'Outpackages', 'Packages'],
        ]);

        $this->set(compact('sheet'));
    }

    public function clientview($id = null)
    {
        $sheet = $this->Sheets->get($id, [
            'contain' => ['Users', 'States', 'Outpackages', 'Packages'],
        ]);
    
        if ($this->request->is('post')) {
            $postData = $this->request->getData();
    
            if (isset($postData['packages'])) {
                foreach ($postData['packages'] as $packageId => $packageData) {
                    // Vérifie que la quantité est définie
                    if (isset($packageData['quantity'])) {
                        $quantity = $packageData['quantity'];
    
                        // Met à jour la table d'association SheetsPackages
                        $this->Sheets->Packages->SheetsPackages->updateAll(
                            ['quantity' => $quantity],
                            ['sheet_id' => $id, 'package_id' => $packageId]
                        );
                        
                    }
                }
                $this->Flash->success(__('La quantité a été mise à jour.'));
                return $this->redirect(['action' => 'clientview', $id]);
            }
        }
    
        $this->set(compact('sheet'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $sheet = $this->Sheets->newEmptyEntity();
        if ($this->request->is('post')) {
            $sheet = $this->Sheets->patchEntity($sheet, $this->request->getData());
            if ($this->Sheets->save($sheet)) {
                $this->Flash->success(__('The sheet has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sheet could not be saved. Please, try again.'));
        }
        $users = $this->Sheets->Users->find('list', ['limit' => 200])->all();
        $states = $this->Sheets->States->find('list', ['limit' => 200])->all();
        $outpackages = $this->Sheets->Outpackages->find('list', ['limit' => 200])->all();
        $packages = $this->Sheets->Packages->find('list', ['limit' => 200])->all();
        $this->set(compact('sheet', 'users', 'states', 'outpackages', 'packages'));
    }
    

    /**
     * Edit method
     *
     * @param string|null $id Sheet id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $sheet = $this->Sheets->get($id, [
            'contain' => ['Outpackages', 'Packages'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $sheet = $this->Sheets->patchEntity($sheet, $this->request->getData());
            if ($this->Sheets->save($sheet)) {
                $this->Flash->success(__('The sheet has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__("La feuille n'a pas pu être enregistrée. Veuillez réessayer."));
        }
        $users = $this->Sheets->Users->find('list', ['limit' => 200])->all();
        $states = $this->Sheets->States->find('list', ['limit' => 200])->all();
        $outpackages = $this->Sheets->Outpackages->find('list', ['limit' => 200])->all();
        $packages = $this->Sheets->Packages->find('list', ['limit' => 200])->all();
        $this->set(compact('sheet', 'users', 'states', 'outpackages', 'packages'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Sheet id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $sheet = $this->Sheets->get($id);
        if ($this->Sheets->delete($sheet)) {
            $this->Flash->success(__('La feuille a été supprimée.'));
        } else {
            $this->Flash->error(__("La feuille n'a pas pu être supprimée. Veuillez réessayer."));
        }

        return $this->redirect(['action' => 'index']);
    }
    public function list()
    {
        $this->paginate = [
            'contain' => ['Users', 'States'],
        ];

        $identity = $this->getRequest()->getAttribute('identity');
        $identity = $identity ?? [];
        $iduser = $identity["id"];
        
        $sheets = $this->paginate($this->Sheets->find('all')->where(['user_id' => $iduser]));

        $sheet = $this->Sheets->newEmptyEntity();

        if ($this->request->is('post')) {
            $sheet = $this->Sheets->patchEntity($sheet, $this->request->getData());
            if ($this->Sheets->save($sheet)) {
                $this->Flash->success(__('The sheet has been saved.'));

                // Initialise la table sheets_packages avec une quantité de 0 pour chaque package
                $packages = $this->Sheets->Packages->find()->toArray();

                foreach ($packages as $package) {
                    $sheetPackage = $this->Sheets->SheetsPackages->newEntity([
                        'sheet_id' => $sheet->id,
                        'package_id' => $package->id,
                        'quantity' => 0,
                    ]);

                    $this->Sheets->SheetsPackages->save($sheetPackage);
                }

                return $this->redirect(['action' => 'list']);
            }

            $this->Flash->error(__("La feuille n'a pas pu être enregistrée. Veuillez réessayer."));
        }

        $users = $this->Sheets->Users->find('list', ['limit' => 200])->all();
        $states = $this->Sheets->States->find('list', ['limit' => 200])->all();
        $this->set(compact('sheets','sheet', 'users', 'states'));
    }

    public function complist()
    {
        $this->paginate = [
            'contain' => ['Users', 'States'],
        ];
    
        $identity = $this->getRequest()->getAttribute('identity');
        $identity = $identity ?? [];
        $iduser = $identity["id"];
    
        $sheets = $this->paginate(
            $this->Sheets->find('all')->where(['state_id >=' => 2,'state_id <=' => 4])
        );

        $users = $this->Sheets->Users->find('list', ['limit' => 200])->all();
        $states = $this->Sheets->States->find('list', ['limit' => 200])->all();
    
        $this->set(compact('sheets', 'users', 'states'));
    }

    public function compview($id = null)
    {
        $sheet = $this->Sheets->get($id, [
            'contain' => ['Users', 'States', 'Outpackages', 'Packages'],
        ]);
    
        if ($this->request->is('post')) {
            $postData = $this->request->getData();
    
            if (isset($postData['packages'])) {
                foreach ($postData['packages'] as $packageId => $packageData) {
                    // Vérifie que la quantité est définie
                    if (isset($packageData['quantity'])) {
                        $quantity = $packageData['quantity'];
    
                        // Met à jour la table d'association SheetsPackages
                        $this->Sheets->Packages->SheetsPackages->updateAll(
                            ['quantity' => $quantity],
                            ['sheet_id' => $id, 'package_id' => $packageId]
                        );
                    }
                }
    
                return $this->redirect(['action' => 'clientview', $id]);
            }
        }
    
        $this->set(compact('sheet'));
    }
    public function validate($id = null)
    {
        $sheet = $this->Sheets->get($id);
        $sheet->sheetvalidated = true; // Mettez à jour la valeur en fonction de vos besoins
        if ($this->Sheets->save($sheet)) {
            $this->Flash->success(__('Fiche validée avec succès.'));
        } else {
            $this->Flash->error(__('Impossible de valider la fiche. Veuillez réessayer.'));
        }
        return $this->redirect(['action' => 'compview', $id]);
    }
    
    public function unvalidate($id = null)
    {
        $sheet = $this->Sheets->get($id);
        $sheet->sheetvalidated = false;
        $this->Sheets->save($sheet);

        // Redirigez ou effectuez d'autres actions après la dévalidation.
        $this->Flash->success(__('Feuille non validée avec succès.'));
        return $this->redirect(['action' => 'compview', $id]);
    }
}
