<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Outpackage $outpackage
 * @var string[]|\Cake\Collection\CollectionInterface $sheets
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $outpackage->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $outpackage->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Outpackages'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="outpackages form content">
            <?= $this->Form->create($outpackage) ?>
            <fieldset>
                <legend><?= __('Edit Outpackage') ?></legend>
                <?php
                    echo $this->Form->control('date');
                    echo $this->Form->control('price');
                    echo $this->Form->control('title');
                    echo $this->Form->control('body');
                    echo $this->Form->control('sheets._ids', ['options' => $sheets]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
