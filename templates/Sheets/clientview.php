<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Sheet $sheet
 */

 $identity = $this->getRequest()->getAttribute('identity');
$identity = $identity ?? [];
$iduser = $identity["id"];

$total = 0;
$total_package = 0;
$total_outpackage = 0;
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
                    <th><?= __('Last name') ?></th>
                    <td><?= $sheet->user->last_name ?></td>
                </tr>
                <tr>
                    <th><?= __('First name') ?></th>
                    <td><?= $sheet->user->first_name ?></td>
                </tr>
                <tr>
                    <th><?= __('State') ?></th>
                    <td><?= $sheet->state->state ?></td>
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
                <?= $this->Form->create($sheet, ['url' => ['controller' => 'Sheets', 'action' => 'clientview', $sheet->id]]) ?>
                <?php if (!empty($sheet->packages)) : ?>
                    <div class="table-responsive">
                        <table>
                            <tr>
                                <th><?= __('Id') ?></th>
                                <th><?= __('Quantity') ?></th>
                                <th><?= __('Price') ?></th>
                                <th><?= __('Title') ?></th>
                            </tr>
                            <?php foreach ($sheet->packages as $package) : ?>
                                <tr>
                                    <td><?= h($package->id) ?></td>
                                    <?php if ($sheet->state->id == 1): ?>
                                        <?php if (!$sheet->sheetvalidated): ?>
                                            <td>
                                                <?= $this->Form->hidden("packages.{$package->id}.id", ['value' => $package->_joinData->id]) ?>
                                                <?= $this->Form->control("packages.{$package->id}.quantity", ['type' => 'text', 'label' => false, 'value' => isset($package->_joinData->quantity) ? $package->_joinData->quantity : 0]) ?>
                                            </td>
                                        <?php else: ?>
                                            <td><?= $package->_joinData->quantity ?></td>
                                        <?php endif; ?>
                                    <?php endif; ?> 
                                    <td><?= h($package->price) ?> €</td>
                                    <td><?= h($package->title) ?></td>
                                    <?php if ($sheet->state->id == 1 && !$sheet->sheetvalidated): ?>
                                        <td style="display: none">
                                            <?= $this->Form->postLink(__('None')) ?>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                                <?php $total_package += ($package->_joinData->quantity * $package->price) ?>
                            <?php endforeach; ?>
                        </table>
                    </div>
                    <?php if ($sheet->state->id == 1 && !$sheet->sheetvalidated): ?>
                        <td>
                            <?= $this->Form->hidden('action', ['value' => '']) ?>
                            <?= $this->Form->button('Save', ['type' => 'submit']) ?>
                        </td> 
                    <?php endif; ?>
                <?php endif; ?>
                <?= $this->Form->end() ?>

                
                <?= '<strong>Total outpackage : </strong>' ?>
                <?= $total_package." €" ?>
                
                



            </div>
            <div class="related">
                <h4 class="float-left"><?= __('Related Outpackages') ?></h4>
                <?php if($sheet->state->id == 1): ?>
                    <?php if($sheet->sheetvalidated == false): ?>
                        <?= $this->Html->link('New outpackage', ['controller' => 'Outpackages', 'action' => 'addoutpackage', $sheet->id], ['class' => 'button float-right']) ?>
                    <?php endif; ?>
                <?php endif; ?>
                <?php if (!empty($sheet->outpackages)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Date') ?></th>
                            <th><?= __('Price') ?></th>
                            <th><?= __('Title') ?></th>
                            <th><?= __('Body') ?></th>
                            <?php if($sheet->state->id == 1): ?>
                                <?php if($sheet->sheetvalidated == false): ?>
                                    <th class="actions"><?= __('Actions') ?></th>
                                <?php endif; ?>
                            <?php endif; ?>
                        </tr>
                        <?php foreach ($sheet->outpackages as $outpackages) : ?>
                        <tr>
                            <td><?= h($outpackages->id) ?></td>
                            <td><?= h($outpackages->date) ?></td>
                            <td><?= h($outpackages->price) ?> €</td>
                            <td><?= h($outpackages->title) ?></td>
                            <td><?= h($outpackages->body) ?></td>
                            <?php if($sheet->state->id == 1): ?>
                                <?php if($sheet->sheetvalidated == false): ?>
                                    <td class="actions">
                                        <?= $this->Form->postLink(__('Delete'), ['controller' => 'Outpackages', 'action' => 'delete', $outpackages->id], ['confirm' => __('Are you sure you want to delete # {0}?', $outpackages->id)]) ?>
                                    </td>
                                <?php endif; ?>
                            <?php endif; ?>
                        </tr>
                        <?php $total_outpackage = $total_outpackage + $outpackages->price; ?>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
                <?= '<strong>Total outpackage : </strong>' ?>
                <?= $total_outpackage." €" ?>
                <?= '</br><strong>Total : </strong>' ?>
                <?= $total = $total_outpackage + $total_package." €" ?>
            </div>
            
        </div>
    </div>
</div>
