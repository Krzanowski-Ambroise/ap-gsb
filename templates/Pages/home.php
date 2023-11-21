<?php 

$identity = $this->getRequest()->getAttribute('identity');

?>
<header>
        <h1>Mon Site Web</h1>
    </header>
 
    <div class="container">
        <div class="content">
        Bonjour <strong><?php if(empty($identity["first_name"]) && empty($identity["last_name"])){echo $identity["username"];}elseif(empty($identity["first_name"])){echo 'Mr. '.$identity["last_name"];}else{echo $identity["first_name"];} ?></strong>,<h2>Bienvenue sur notre site !</h2>
        <p>C'est la page d'accueil.</p>
            <!-- Ici, vous pouvez ajouter du contenu supplémentaire, des liens, des images, etc. -->
        </div>
    </div>