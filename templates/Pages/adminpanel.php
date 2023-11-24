<?= __('<strong>Sheets :</strong>') ?>
<?= $this->Html->link('Lists sheets', ['plugin' => NULL,'controller' => 'Sheets', 'action' => 'index'], ['class' => 'button','style'=> 'width:100%']) ?>
<?= $this->Html->link('Lists states', ['plugin' => NULL,'controller' => 'states', 'action' => 'index'], ['class' => 'button','style'=> 'width:100%;margin-bottom: 30px']) ?>
<?= __('<strong>Packages :</strong>') ?>
<?= $this->Html->link('Lists packages', ['plugin' => NULL,'controller' => 'Packages', 'action' => 'index'], ['class' => 'button','style'=> 'width:100%']) ?>
<?= $this->Html->link('Lists outpackages', ['plugin' => NULL,'controller' => 'Outpackages', 'action' => 'index'], ['class' => 'button','style'=> 'width:100%;margin-bottom: 30px']) ?>

<?= __('<strong>User :</strong>') ?>
<?= $this->Html->link('Lists users', ['plugin' => 'CakeDC/Users','controller' => 'Users', 'action' => 'index'], ['class' => 'button','style'=> 'width:100%']) ?>