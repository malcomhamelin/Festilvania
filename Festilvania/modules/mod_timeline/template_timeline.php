<div class="accueil">
    <div class="titreEtRecherche">
        <h1 class="mb-4 d-flex justify-content-center text-center">Envie de vous amuser ?</h1>
        <div class="search-bar d-flex justify-content-center">
            <div class="input-group col-10 col-md-8 col-lg-6 mx-auto">
                <form action="index.php?mod=timeline&option=search#timeline-title" method="post" id="search"></form>
                <input class="form-control form-control-lg" type="text" form="search" name="searchInput" id="searchInput" placeholder="Rechercher un festival..." aria-label="Search">
                
                <div class="input-group-append">
                    <button class="btn btn-warning ml-0" form="search">
                        <i class="fas fa-search mt-2"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="decouvrir">
        <div class="row">
            <hr style="height:2px;border:none;color:white;background-color:white;" class="mx-auto col-1 col-sm-2 col-md-3 col-lg-4">
            <span class="phraseAccueil">Découvrez en plus</span>
            <hr style="height:2px;border:none;color:white;background-color:white;" class="mx-auto col-1 col-sm-2 col-md-3 col-lg-4">
        </div>
        <div class="row">
            <img src="img/nextb.png" alt="next" class="mx-auto nextBottom">
        </div>
    </div>
</div>

<div class="container-fluid blocs-annexes bg-dark pt-4">

    <div class="row">
        <span class="blocs-annexes-titre ml-3">Le meilleur</span>
        <hr style="height:2px;border:none;color:white;background-color:white;" class="mx-auto col-6 col-md-9 col-lg-10">
    </div>

    <div class="row mt-4">

        <?php $this->getAsideBloc($hottestContent); ?>

    </div>

    <div class="row">
        <span class="blocs-annexes-titre ml-3">Derniers événements</span>
        <hr style="height:2px;border:none;color:white;background-color:white;" class="mx-auto col-4 col-md-8 col-lg-9">
    </div>

    <div class="row mt-4">

        <?php $this->getAsideBloc($latestContent); ?>

    </div>

</div>

<div class="container-fluid bloc-principal py-5">

    <?php $this->getTitle($option); ?>

    <?php $this->getMainTimeline($content, $userInfos); ?>

</div>