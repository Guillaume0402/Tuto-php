document.addEventListener('DOMContentLoaded', function() {
    // Support pour appareils tactiles
    const dropdownToggles = document.querySelectorAll('.dropdown-toggle');
    
    dropdownToggles.forEach(toggle => {
        // Sur mobile, le premier clic ouvre le menu, le deuxième ferme
        let isOpen = false;
        
        toggle.addEventListener('click', function(e) {
            const dropdown = this.closest('.dropdown');
            const dropdownMenu = dropdown.querySelector('.dropdown-menu');
            
            if (!isOpen) {
                // Fermer tous les autres menus
                document.querySelectorAll('.dropdown-menu').forEach(menu => {
                    if (menu !== dropdownMenu) {
                        menu.style.display = 'none';
                    }
                });
                
                // Ouvrir ce menu
                dropdownMenu.style.display = 'block';
                isOpen = true;
            } else {
                // Fermer ce menu
                dropdownMenu.style.display = 'none';
                isOpen = false;
            }
            
            e.preventDefault();
        });
    });
    
    // Fermer le menu déroulant lorsque l'utilisateur clique ailleurs
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.dropdown')) {
            document.querySelectorAll('.dropdown-menu').forEach(menu => {
                menu.style.display = '';
            });
            
            dropdownToggles.forEach(toggle => {
                toggle.isOpen = false;
            });
        }
    });
});