<?php 

$event['nbVotes'] == null ? $nbVotes = 0 : $nbVotes = $event['nbVotes']; 
$dateBegin = new DateTime($event['date_debut']);
$dateEnd = new DateTime($event['date_fin']);

?>

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
                    <span class="my-auto font-weight-bold" id="annonce-corps-infos"><?php echo $dateBegin->format('d/m/y') . ' - ' . $dateEnd->format('d/m/y') . ' à ' . $event['lieu']; ?></span>
                </div>
            </div>
            <div class="row mt-3 mx-auto">
                <div class="col-10 col-sm-8 col-md-10">
                    
                    <?php $this->getScheduleButton($userInfos, $event['idEvenement']); ?>
                    <?php $this->getEditButton($rights); ?>

                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <span class="post-titre ml-5">Programme</span>
        <hr style="height:2px;border:none;color:white;background-color:grey;" class="mx-auto col-5 col-md-8 col-lg-9">
    </div>

    <div class="description ml-4 mr-4 text-justify">
        <p><?php echo $event['description']; ?></p>
    </div>

    <div class="row mt-3">
        <span class="post-titre ml-5">Commentaires</span>
        <hr style="height:2px;border:none;color:white;background-color:grey;" class="mx-auto col-5 col-md-8 col-lg-9">
    </div>

    <div class="description ml-5">
        <p class="text-center mt-3"><?php $this->getComments($comments); ?></p>
    </div>
    
    <div class="row mt-3">
        <span class="post-titre ml-5">Commenter</span>
        <hr style="height:2px;border:none;color:white;background-color:grey;" class="mx-auto col-5 col-md-8 col-lg-9">
    </div>

    <?php $this->getCommentForm($rights); ?>
</div>