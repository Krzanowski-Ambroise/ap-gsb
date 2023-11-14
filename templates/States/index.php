<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\State> $states
 */
?>
<div class="states index content">
    <?= $this->Html->link(__('New State'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('States') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('state') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($states as $state): ?>
                <tr>
                    <td><?= $this->Number->format($state->id) ?></td>
                    <td><?= h($state->state) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $state->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $state->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $state->id], ['confirm' => __('Are you sure you want to delete # {0}?', $state->id)]) ?>
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
