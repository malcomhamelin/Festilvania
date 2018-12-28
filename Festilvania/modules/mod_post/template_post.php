<div class="container annonce container-post">
    <div class="row">
        <div class="col-lg-3 mx-auto float-left">
            <img src="img/background.jpg" alt="Photo evenement" class="photo-post"/>
        </div>
        <div class="col-lg-9 mx-auto float-right">
            <?php echo $this->getEditButton($rights); ?>
            <h1><?php echo $event['titreEvenement']; ?></h1>
            <p><?php echo $dateBegin->format('d/m/y'); ?> - <?php echo $dateEnd->format('d/m/y'); ?> | <?php echo $event['lieu']; ?></p>
        </div>
    </div>
    <hr>
    <div class="row text-justify">
        <div class="col-xs-12 col-lg-12 mx-auto">
            <p><?php echo $event['description']; ?></p>
        </div>
    </div>
    <hr>
    <div class="row comment-post">
        <div class="col-xs-12 col-lg-12 mx-auto">
            <h2>Commentaires : </h2>
                <?php echo $this->getComments($comments); ?>
    </div>
    </div>
    <hr>
    <div class="row">
        <?php echo $this->getCommentForm($rights); ?>
    </div>
</div>
