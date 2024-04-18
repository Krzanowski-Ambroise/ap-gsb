<?= $this->Form->create($editdoctor) ?>
<?php echo $this->Form->select(
  
  'field',
  [1 => 'Pas de docteur', 2 => 'Mr.X'],
  ['empty' => '(choisissez)']
);?>
<?= $this->Form->button(__('Enregistrer')) ?>
<?= $this->Form->end() ?>