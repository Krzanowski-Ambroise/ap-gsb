<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Package $package
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Package'), ['action' => 'edit', $package->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Package'), ['action' => 'delete', $package->id], ['confirm' => __('Are you sure you want to delete # {0}?', $package->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Packages'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Package'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="packages view content">
            <h3><?= h($package->title) ?></h3>
            <table>
                <tr>
                    <th><?= __('Title') ?></th>
                    <td><?= h($package->title) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($package->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Price') ?></th>
                    <td><?= $this->Number->format($package->price) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Body') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($package->body)); ?>
                </blockquote>
            </div>
            <div class="related">
                <h4><?= __('Related Sheets') ?></h4>
                <?php if (!empty($package->sheets)) : ?>
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
                        <?php foreach ($package->sheets as $sheets) : ?>
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
