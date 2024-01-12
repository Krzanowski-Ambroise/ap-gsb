<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Http\Exception\UnauthorizedException;
use App\Model\Table\UsersTable;
use Cake\Datasource\EntityInterface;



class ApiController extends AppController 
{

    public function initialize(): void
    {
        parent::initialize();
        $this->loadModel('Users');
        $this->loadModel('Sheets');
    }


    public function generateApiToken() {
        $this->loadComponent('Authentication.Authentication');
    
        $passwordFromRequest = '123';
    
        // Récupérer l'utilisateur actuellement authentifié
        $user = $this->Authentication->getIdentity();
    
        // Assurer que $user est une instance de Cake\Datasource\EntityInterface
        if (!$user instanceof EntityInterface) {
            // Convertir l'objet Authorization\Identity en Cake\Datasource\EntityInterface
            $user = $this->Authentication->getIdentity()->getOriginalData();
        }
    
        // Vérifier l'authentification et le mot de passe
        if ($user && $passwordFromRequest == $user->api_password) {
            // Générer la clé API
            $apiToken = bin2hex(random_bytes(32));
    
            // Mettre à jour la clé API dans l'entité
            $user->api_token = $apiToken;
    
            // Utiliser la méthode save de l'entité elle-même
            if ($this->Users->save($user)) {
                $this->viewBuilder()->setClassName('Json');
                $this->set([
                    'success' => true,
                    'api_token' => $apiToken,
                ]);
                $this->viewBuilder()->setOption('serialize', ['success', 'api_token']);
                return $this->redirect(['plugin' => 'CakeDC/Users','controller' => 'Users', 'action' => 'profile']);
            } else {
                $this->set([
                    'success' => false,
                    'message' => 'Erreur lors de la sauvegarde de la clé API.',
                ]);
                $this->viewBuilder()->setOption('serialize', ['success', 'message']);
            }
        } else {
            debug($user->api_password);
            debug($passwordFromRequest);
            $this->set([
                'success' => false,
                'message' => 'Mot de passe incorrect.',
            ]);
            $this->viewBuilder()->setOption('serialize', ['success', 'message']);
        }
    }
    
    

    public function getSheetInfo() {
        $apiToken = $this->request->getQuery('api_token');
        $sheetId = $this->request->getQuery('id_sheet');
        
        $usersTable = $this->loadModel('Users');
    
        $user = $usersTable->find()->where(['api_token' => $apiToken])->first();
    
        if (!$user) {
            
            $this->set([
                'success' => false,
                'message' => 'Clé API invalide',
                '_serialize' => ['success', 'message']
            ]);
            return;
        }
    
        $sheet = $this->Sheets->findById($sheetId)->first();
    
        if (!$sheet) {
            $this->set([
                'success' => false,
                'message' => 'La fiche avec l\'ID spécifié n\'existe pas.',
                '_serialize' => ['success', 'message']
            ]);
            return;
        }
    
        if ($sheet->user_id !== $user->id) {
            $this->set([
                'success' => false,
                'message' => 'L\'utilisateur n\'a pas accès à cette fiche.',
                '_serialize' => ['success', 'message', 'sheetUserId', 'userId']
            ]);
            return;
        }
    
        $this->viewBuilder()->setClassName('Json');
        $this->set([
            'success' => true,
            'sheet_info' => $sheet->toArray(),
            '_serialize' => ['success', 'sheet_info']
        ]);
    }    
    
}
