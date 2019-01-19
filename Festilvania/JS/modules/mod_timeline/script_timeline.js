/*
**Initialisation de l'écoute
*/
document.addEventListener('DOMContentLoaded', init, false);

function init() {

    /*
    ** Système de upvote/downvote
    */
    $(".like, .dislike").click(function() {
        vote = $(this).attr("data-vote");
        post = $(this).attr("data-post");
        rateArticle(vote, post);
    });

    function rateArticle(vote, post) {
        $.ajax({
            type: 'POST',
            url: 'JS/modules/mod_timeline/vote.php', 
            data: {vote:vote, postID:post},
            success: function(nbVotes){
                if (nbVotes == "not connected") {
                    window.alert("Vous devez être connecté pour pouvoir voter !");
                }
                else {
                    $('.nbVotes[data-post=' + post + ']').html(nbVotes); 
                }
            }
        });
    }

    /*
    ** Système d'ajout/retrait de l'agenda
    */
    $(".schedule").click(function() {
        post = $(this).attr("data-post");
        userID = $(this).attr("data-user");
        dataSchedule = $(this).attr("data-schedule");
        manageSchedule(post, userID, dataSchedule);
    });

    function manageSchedule(post, userID, dataSchedule) {
        $.ajax({
            type: 'POST',
            url: 'JS/modules/mod_timeline/schedule.php', 
            data: {userID:userID, postID:post, dataSchedule:dataSchedule},
            success: function(iClass){
                $('.schedule[data-post=' + post + ']').addClass(iClass);

                if (iClass == "fa-plus") {
                    $('.schedule[data-post=' + post + ']').attr("title", "Ajouter à mon agenda");
                    $('.schedule[data-post=' + post + ']').attr("data-schedule", "add");

                    if ($('.schedule[data-post=' + post + ']').hasClass('fa-minus')) {
                        $('.schedule[data-post=' + post + ']').removeClass('fa-minus');
                    }
                    else {
                        window.alert("Vous devez être connecté pour pouvoir ajouter un événèment à votre agenda !");
                    }
                }
                else if (iClass == "fa-minus") {
                    $('.schedule[data-post=' + post + ']').attr("title", "Retirer de mon agenda");
                    $('.schedule[data-post=' + post + ']').attr("data-schedule", "del");

                    if ($('.schedule[data-post=' + post + ']').hasClass('fa-plus')) {
                        $('.schedule[data-post=' + post + ']').removeClass('fa-plus');
                    }
                }
            }
        });
    }
};