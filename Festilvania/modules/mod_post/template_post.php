<?php $event['nbVotes'] == null ? $nbVotes = 0 : $nbVotes = $event['nbVotes']; ?>

<div class="container annonce shadow-sm mt-5">
    <div class="row">
        <div class="col-2 col-md-1 col-lg-1 votes ml-5 my-auto">
            <a href="index.php?mod=post&action=upvote&idEvenement=<?php echo $event['idEvenement']?>"><img src="img/nexttg.png" alt="upvote" class="votes-img"></a>
            <div class="btn font-weight-bold"><span><?php echo $nbVotes; ?></span></div>
            <a href="index.php?mod=post&action=downvote&idEvenement=<?php echo $event['idEvenement']?>"><img src="img/nextbg.png" alt="downvote" class="votes-img"></a>
        </div>

        <div class="col-7 col-md-4 col-lg-3 annonce-col">
            <img src="<?php echo $event['lienImage']; ?>" alt="Photo évenement" class="annonce-col-img rounded">
        </div>

        <div class="col-12 col-md-6 annonce-corps">
            <div class="row mx-auto">
                <div class="col-12 col-sm-12 col-md-12">
                    <span class="my-auto annonce-corps-titre"><a href="index.php?mod=post&idEvenement=<?php echo $event['idEvenement']?>"><?php echo $event['titreEvenement']; ?>   </a></span>
                    <span class="my-auto font-weight-bold" id="annonce-corps-infos">01/01/2018 - 02/03/2018 à Paris</span>
                </div>
            </div>
            <div class="row mt-3 mx-auto">
                <div class="col-10 col-sm-8 col-md-10">
                    
                    <?php $this->getScheduleButton($userInfos, $event['idEvenement']); ?>

                    <a href="index.php?mod=post&idEvenement=<?php echo $event['idEvenement']?>"><div class="btn btn-warning annonce-corps-btn ml-3">Voir l'évènement</div></a>
                </div>
            </div>
        </div>
    </div>
</div>';