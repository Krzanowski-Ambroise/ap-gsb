<?php 

$identity = $this->getRequest()->getAttribute('identity');
$identity = $identity ?? [];

?>
<header>
        <h1>Home page</h1>
    </header>
 
    <div class="container">
        <div class="content">
            <?php if ($identity): ?>
                Hello <strong><?php if(empty($identity["first_name"]) && empty($identity["last_name"])){echo $identity["username"];}elseif(empty($identity["first_name"])){echo 'Mr. '.$identity["last_name"];}else{echo $identity["first_name"];} ?></strong>,<h2>Welcome to our website !</h2>
            <?php else: ?>
               <p>Welcome to our GSB app. To access the customer interface and benefit from our services, please log in. If you don't have an account, you can register.</p>
            <?php endif; ?>
            <!-- Ici, vous pouvez ajouter du contenu supplémentaire, des liens, des images, etc. -->
        </div>
    </div>