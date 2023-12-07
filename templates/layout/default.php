<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

$cakeDescription = 'CakePHP: the rapid development php framework';

$identity = $this->getRequest()->getAttribute('identity');
$identity = $identity ?? [];
if ($identity) {
$iduser = $identity["id"];
$roleuser = $identity["is_superuser"];
$roleuser_name = $identity["role"];
}

?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css(['normalize.min', 'milligram.min', 'fonts', 'cake']) ?>
    <?= $this->Html->script(['app.js']) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,500,0,0" />
</head>
<body>
    <nav class="top-nav">
        <div class="top-nav-title">
            <a href="<?= $this->Url->build('/') ?>"><span>Appli | </span>| Frais</a>
        </div>
        <div class="top-nav-links">
        <?php
            echo $this->Html->Link('Acceuil', ['plugin' => NULL, 'controller' => 'Pages', 'action' => 'home']);
            if(isset($roleuser) && !empty($roleuser)){
                if($roleuser == true){
                    echo $this->Html->Link('Mes fiches', ['plugin' => NULL, 'controller' => 'Sheets', 'action' => 'list']);
                    echo $this->Html->Link('Comptable sheets', ['plugin' => NULL, 'controller' => 'Sheets', 'action' => 'complist']);
                    echo $this->Html->Link('Admin panel', ['plugin' => NULL, 'controller' => 'Pages', 'action' => 'adminpanel']);
                    echo $this->Html->Link('Mon compte', ['plugin' => 'CakeDC/Users','controller' => 'Users', 'action' => 'profile']);
                    echo $this->Html->Link('Déconnexion' , ['plugin' => 'CakeDC/Users', 'controller' => 'Users', 'action' => 'logout'], ['onclick' => "return confirm('Etes-vous sûr de vouloir vous déconnecter ?')"]);
                }elseif($roleuser == false){
                    if($roleuser_name == "comptable"){
                        echo $this->Html->Link('Comptable sheets', ['plugin' => NULL, 'controller' => 'Sheets', 'action' => 'complist']);
                    }else{
                        echo $this->Html->Link('Mes fiches', ['plugin' => NULL, 'controller' => 'Sheets', 'action' => 'list']);
                    }
                    echo $this->Html->Link('Mon compte', ['plugin' => 'CakeDC/Users','controller' => 'Users', 'action' => 'profile']);
                    echo $this->Html->Link('Déconnexion' , ['plugin' => 'CakeDC/Users', 'controller' => 'Users', 'action' => 'logout'], ['onclick' => "return confirm('Etes-vous sûr de vouloir vous déconnecter ?')"]);
                }
            }else{
                echo $this->Html->Link('Login', ['plugin' => 'CakeDC/Users','Controller'=> 'Users','action'=> 'login'] );
            }
        ?>
        </div>
    </nav>
    <main class="main">
        <div class="container">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
    </main>
    <footer>
        </br>
        </br>
        </br>
        </br>
        </br>
    </footer>
</body>
</html>
