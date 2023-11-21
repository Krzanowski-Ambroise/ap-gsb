<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Sheet $sheet
 * @var \Cake\Collection\CollectionInterface|string[] $users
 * @var \Cake\Collection\CollectionInterface|string[] $states
 */

$identity = $this->getRequest()->getAttribute('identity');
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Sheets'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="sheets form content">
            <?= $this->Form->create($sheet) ?>
            <fieldset>
                <legend><?= __('Add Sheet') ?></legend>
                <?php
                    echo $this->Form->control('sheetvalidated', ['type' => 'hidden', 'default' => 0]);
                    echo $this->Form->control('state_id', ['type' => 'hidden', 'default' => 1]);
                    echo $this->Form->control('user_id', ['type' => 'hidden', 'default' => $identity["id"]]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
