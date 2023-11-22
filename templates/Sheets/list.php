<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Sheet> $sheets
 * 
 * 
 * <th><?= $this->Paginator->sort('user_id') ?></th>
 * $sheet->has('user') ? $this->Html->link($sheet->user->username, ['controller' => 'Users', 'action' => 'view', $sheet->user->id]) : ''
 */


$identity = $this->getRequest()->getAttribute('identity');
$identity = $identity ?? [];
$iduser = $identity["id"]

?>
<div class="sheets index content">
<div class="float-left" style="padding: 10px 20px;">Bonjour <strong><?php if(empty($identity["first_name"]) && empty($identity["last_name"])){echo $identity["username"];}elseif(empty($identity["first_name"])){echo 'Mr. '.$identity["last_name"];}else{echo $identity["first_name"];} ?></strong>, vous pouvez remplir vos fiches ci-dessous : </div>
    <?= $this->Form->create($sheet) ?>
    <?php 
        echo $this->Form->control('sheetvalidated', ['type' => 'hidden', 'default' => 0]);
        echo $this->Form->control('state_id', ['type' => 'hidden', 'default' => 1]);
        echo $this->Form->control('user_id', ['type' => 'hidden', 'default' => $identity["id"]]);
    ?>
    <?= $this->Form->button(__('Create sheet'), ['class' => 'button float-right']) ?>
    <?= $this->Form->end() ?>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('state_id') ?></th>
                    <th><?= $this->Paginator->sort('sheetvalidated') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($sheets as $sheet): ?>
                    <tr>
                        <td><?= $this->Number->format($sheet->id) ?></td>
                        <td><?= $sheet->has('state') ? $this->Html->link($sheet->state->state, ['controller' => 'States', 'action' => 'view', $sheet->state->id]) : '' ?></td>
                        <td><?php if($sheet->sheetvalidated == 1){echo "Validate";}else{echo "Unvalidated";} ?></td>
                        <td><?= h($sheet->created) ?></td>
                        <td><?= h($sheet->modified) ?></td>
                        <td class="actions">
                            <?php if($sheet->state->id > 1){echo $this->Html->link(__('View'), ['action' => 'clientview', $sheet->id]);}elseif($sheet->state->id == 1){echo $this->Html->link(__('View - Edit'), ['action' => 'clientview', $sheet->id]);}else{echo $this->Html->link(__('Edit'), ['action' => 'clientview', $sheet->id]);}  ?>
                            <?php 
                            /**
                             * if($sheet->state->id === 1):
                             * $this->Html->link(__('Edit'), ['action' => 'edit', $sheet->id])
                             * endif; 
                            **/
                            ?>
                            <!-- $this->Form->postLink(__('Delete'), ['action' => 'delete', $sheet->id], ['confirm' => __('Are you sure you want to delete # {0}?', $sheet->id)]) -->
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
