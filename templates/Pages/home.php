<?php 

$identity = $this->getRequest()->getAttribute('identity');
$identity = $identity ?? [];

?>
<header>
        <h1>Page d'accueil</h1>
    </header>
 
    <div class="container">
        <div class="content">
            <?php if ($identity): ?>
                Bonjour <strong><?php if(empty($identity["first_name"]) && empty($identity["last_name"])){echo $identity["username"];}elseif(empty($identity["first_name"])){echo 'Mr. '.$identity["last_name"];}else{echo $identity["first_name"];} ?></strong>,<h2>Bienvenue sur notre site !</h2>
            <?php else: ?>
               <p>Bienvenue sur notre application GSB. Pour accéder à l'interface client et bénéficier de nos services, veuillez vous connecter. Si vous n'avez pas de compte, vous pouvez vous inscrire.</p>
            <?php endif; ?>
            <!-- Ici, vous pouvez ajouter du contenu supplémentaire, des liens, des images, etc. -->
        </div>
    </div>