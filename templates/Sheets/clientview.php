<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Sheet $sheet
 */

 $identity = $this->getRequest()->getAttribute('identity');
$identity = $identity ?? [];
$iduser = $identity["id"]
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(__('Delete Sheet'), ['action' => 'delete', $sheet->id], ['confirm' => __('Are you sure you want to delete # {0}?', $sheet->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Sheets'), ['action' => 'list'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="sheets view content">
            <h3><?= h($sheet->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $sheet->has('user') ? $this->Html->link($sheet->user->username, ['controller' => 'Users', 'action' => 'view', $sheet->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('State') ?></th>
                    <td><?= $sheet->has('state') ? $this->Html->link($sheet->state->state, ['controller' => 'States', 'action' => 'view', $sheet->state->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($sheet->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($sheet->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($sheet->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Sheetvalidated') ?></th>
                    <td><?= $sheet->sheetvalidated ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            
            <div class="related">
                <h4 class="float-left"><?= __('Related Packages') ?></h4>
                <?= $this->Html->link('New package', ['action' => 'addpackage', $sheet->id], ['class' => 'button float-right']) ?>
                <?php if (!empty($sheet->packages)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Quantity') ?></th>
                            <th><?= __('Price') ?></th>
                            <th><?= __('Title') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($sheet->packages as $packages) : ?>
                        <tr>
                            <td><?= h($packages->id) ?></td>
                            <td><?= h($packages->_joinData->quantity) ?></td>
                            <td><?= h($packages->price) ?></td>
                            <td><?= h($packages->title) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Packages', 'action' => 'view', $packages->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Packages', 'action' => 'delete', $packages->id], ['confirm' => __('Are you sure you want to delete # {0}?', $packages->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4 class="float-left"><?= __('Related Outpackages') ?></h4>
                <?= $this->Html->link('New outpackage', ['action' => 'addoutpackage', $sheet->id], ['class' => 'button float-right']) ?>
                <?php if (!empty($sheet->outpackages)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Date') ?></th>
                            <th><?= __('Price') ?></th>
                            <th><?= __('Title') ?></th>
                            <th><?= __('Body') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($sheet->outpackages as $outpackages) : ?>
                        <tr>
                            <td><?= h($outpackages->id) ?></td>
                            <td><?= h($outpackages->date) ?></td>
                            <td><?= h($outpackages->price) ?></td>
                            <td><?= h($outpackages->title) ?></td>
                            <td><?= h($outpackages->body) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Outpackages', 'action' => 'view', $outpackages->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Outpackages', 'action' => 'edit', $outpackages->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Outpackages', 'action' => 'delete', $outpackages->id], ['confirm' => __('Are you sure you want to delete # {0}?', $outpackages->id)]) ?>
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
