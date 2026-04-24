document.addEventListener('submit', (e) => {
    const form = e.target;
    const nom = form.nom.value.trim();
    const prenom = form.prenom.value.trim();
    const filiere = form.filiere ? form.filiere.value : true;

    if (!nom || !prenom || !filiere) {
        e.preventDefault();
        alert("Attention : Tous les champs sont obligatoires !");
    }
});