document.addEventListener('DOMContentLoaded', function () {
    const quantityControls = document.querySelectorAll('.quantity-control');

    quantityControls.forEach(control => {
        control.addEventListener('click', function () {
            const packageId = this.getAttribute('data-package-id');
            const action = this.getAttribute('data-action');

            // Envoie une requête Ajax au serveur pour mettre à jour la quantité
            fetch(`/sheets/updateQuantity/${packageId}/${action}`, {
                method: 'GET',
            })
            .then(response => response.json())
            .then(data => {
                // Met à jour la quantité affichée sans recharger la page
                const quantityElement = document.querySelector(`.quantity[data-package-id="${packageId}"]`);
                quantityElement.textContent = data.quantity;
            })
            .catch(error => console.error('Error:', error));
        });
    });
});