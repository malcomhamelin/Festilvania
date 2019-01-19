function profileCreated() {
    location.href = 'index.php';
    window.alert("Vous pouvez maintenant vous connecter !");
}

function pseudoAlreadyUsed() {
    event.preventDefault();
    window.alert("Pseudonyme déjà utilisé");
}

function emailAlreadyUsed() {
    location.href = 'index.php?mod=register';
    window.alert("E-mail déjà utilisé");
}

function mismatchPasswords() {
    event.preventDefault();
    window.alert("Les mots de passe ne correspondent pas");
}

function specialCharactersInPseudo() {
    location.href = 'index.php?mod=register';
    window.alert("Caractères spéciaux interdits dans le pseudonyme");
}

function missingField() {
    location.href = 'index.php?mod=register';
    window.alert("Un ou plusieurs champs ne sont pas remplis");
}

function checkForm() {
    
}