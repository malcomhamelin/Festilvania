function checkpublication(result) {
    if (result) {
        window.alert("Vous avez bien créé une nouvelle catégorie !");
    }
    else {
        window.alert("Impossible de créer cette catégorie : une catégorie du même nom existe déjà");
    }
}

function needToBeConnectedToPost() {
    window.alert("Vous devez être connecté pour pouvoir poster !");
    document.location.href="index.php";
}