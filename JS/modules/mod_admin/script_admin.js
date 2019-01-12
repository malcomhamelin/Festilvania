function checkaddCategory(result) {
    if (result) {
        window.alert("Vous avez bien créé une nouvelle catégorie !");
    }
    else {
        window.alert("Impossible de créer cette catégorie : une catégorie du même nom existe déjà");
    }
}

function checkdelCategory(result) {
    if (result) {
        window.alert("Vous avez bien supprimé cette catégorie !");
    }
    else {
        window.alert("Impossible de supprimer cette catégorie : des évènements en font partie");
    }
}

function checkaddGroup(result) {
    if (result) {
        window.alert("Vous avez bien créé un nouveau groupe !");
    }
    else {
        window.alert("Impossible de créer ce groupe : un groupe du même nom existe déjà");
    }
}

function checkdelGroup(result) {
    if (result) {
        window.alert("Vous avez bien supprimé ce groupe !");
    }
    else {
        window.alert("Impossible de supprimer ce groupe : des membres en font partie");
    }
}

function checkaffectUser(result) {
    window.alert("Vous avez bien affecté ce membre au nouveau groupe !");
}