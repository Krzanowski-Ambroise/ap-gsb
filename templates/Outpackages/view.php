<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Outpackage $outpackage
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Outpackage'), ['action' => 'edit', $outpackage->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Outpackage'), ['action' => 'delete', $outpackage->id], ['confirm' => __('Are you sure you want to delete # {0}?', $outpackage->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Outpackages'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Outpackage'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="outpackages view content">
            <h3><?= h($outpackage->title) ?></h3>
            <table>
                <tr>
                    <th><?= __('Title') ?></th>
                    <td><?= h($outpackage->title) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($outpackage->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Price') ?></th>
                    <td><?= $this->Number->format($outpackage->price) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date') ?></th>
                    <td><?= h($outpackage->date) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Body') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($outpackage->body)); ?>
                </blockquote>
            </div>
            <div class="related">
                <h4><?= __('Related Sheets') ?></h4>
                <?php if (!empty($outpackage->sheets)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('State Id') ?></th>
                            <th><?= __('Sheetvalidated') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($outpackage->sheets as $sheets) : ?>
                        <tr>
                            <td><?= h($sheets->id) ?></td>
                            <td><?= h($sheets->user_id) ?></td>
                            <td><?= h($sheets->state_id) ?></td>
                            <td><?= h($sheets->sheetvalidated) ?></td>
                            <td><?= h($sheets->created) ?></td>
                            <td><?= h($sheets->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Sheets', 'action' => 'view', $sheets->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Sheets', 'action' => 'edit', $sheets->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Sheets', 'action' => 'delete', $sheets->id], ['confirm' => __('Are you sure you want to delete # {0}?', $sheets->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
