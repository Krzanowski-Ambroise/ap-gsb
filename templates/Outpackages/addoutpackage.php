<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Outpackage $outpackage
 * @var \Cake\Collection\CollectionInterface|string[] $sheets
 */

// Récupère les paramètres de l'URL
$params = $this->request->getParam('pass');

// $params est maintenant un tableau, et $params[0] contient la valeur "8" dans cet exemple
$sheet_id = $params[0];
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Back to sheet'), ['controller' => 'sheets','action' => 'clientview', $sheet_id], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="outpackages form content">
            <?= $this->Form->create($outpackage) ?>
            <fieldset>
                <legend><?= __('Add Outpackage') ?></legend>
                <?php   
                    echo $this->Form->control('price');
                    echo $this->Form->control('title');
                    echo $this->Form->control('body');
                    
                    echo $this->Form->control('sheets._ids', ['value' => $sheet_id, 'style' => 'display: none','label' => false]);
                    
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
