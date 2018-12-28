<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link lien-navbar" href="index.php">Accueil</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link lien-navbar" href="index.php?mod=timeline&option=Concert">Concerts</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link lien-navbar" href="index.php?mod=timeline&option=Festival">Festivals</a>
                </li>
                <li class="nav-item dropdown dropdown-autre mb-1 active">
                    <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                        Autres
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>    
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>
            </ul>

            <a href="index.php" class="logoLien d-none d-lg-block"><img src="img/logo.png" alt="logo" class="logo mt-5"></a>

            <div class="mx-auto">
                <?php $this->getUserMenu($rights); ?>
            </div>

            <a href="index.php?mod=publipost"><div class="btn btn-warning btn-publier"><i class="fas fa-plus-circle"></i> Publier</div></a>

        </div>
    </div>        
</nav>
