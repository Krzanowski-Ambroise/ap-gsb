<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Outpackage> $outpackages
 */
?>
<div class="outpackages index content">
    <?= $this->Html->link(__('New Outpackage'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Outpackages') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('date') ?></th>
                    <th><?= $this->Paginator->sort('price') ?></th>
                    <th><?= $this->Paginator->sort('title') ?></th>
                    <th><?= $this->Paginator->sort('Body') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($outpackages as $outpackage): ?>
                <tr>
                    <td><?= $this->Number->format($outpackage->id) ?></td>
                    <td><?= h($outpackage->date) ?></td>
                    <td><?= $this->Number->format($outpackage->price) ?></td>
                    <td><?= h($outpackage->title) ?></td>
                    <td style="max-width: 500px; text-align: justify;"><?= h($outpackage->body) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $outpackage->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $outpackage->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $outpackage->id], ['confirm' => __('Are you sure you want to delete # {0}?', $outpackage->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
