// Modifier le fichier add.ctp dans le dossier templates/Outpackages
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Outpackage $outpackage
 * @var \Cake\Collection\CollectionInterface|string[] $sheets
 */
debug($this->request->getData());

// Récupère les paramètres de l'URL
$params = $this->request->getParam('pass');

// $params est maintenant un tableau, et $params[0] contient la valeur "8" dans cet exemple
$sheet_id = $params[0];

// Utilise $sheet_id comme nécessaire dans ta vue.
echo $sheet_id;
debug($this->request->getData('sheets._ids'))
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Outpackages'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="outpackages form content">
            <?= $this->Form->create($outpackage) ?>
            <fieldset>
                <legend><?= __('Ajouter un outpackage') ?></legend>
                <?php   
                    echo $this->Form->control('price');
                    echo $this->Form->control('title');
                    echo $this->Form->control('body');
                    
                    // Ajouter le champ pour sélectionner une fiche
                    
                    echo $this->Form->control('sheets._ids', [
                        'type' => 'hidden', // Définit le type du champ comme caché
                        'default' => [$sheet_id], // Utilise $sheet_id comme valeur par défaut
                    ]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Soumettre')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
