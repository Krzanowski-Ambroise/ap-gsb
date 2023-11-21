<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Sheet $sheet
 * @var \Cake\Collection\CollectionInterface|string[] $users
 * @var \Cake\Collection\CollectionInterface|string[] $states
 */
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
                    echo $this->Form->control('user_id', ['options' => $users, 'empty' => false]);
                    echo $this->Form->control('state_id', ['options' => $states]);
                    echo $this->Form->control('sheetvalidated');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
