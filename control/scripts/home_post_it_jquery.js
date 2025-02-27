   // Fonction pour rafraîchir les post-its
        function loadPostIts() {
            $('#postItList').load('/TER_MIAGE/control/get_post_its.php');
        }

        // Fonction pour rafraîchir les post-its partagés
        function loadSharedPostIts() {
            $('#sharedPostItList').load('/TER_MIAGE/control/get_post_its_share.php');
        }

        // Rafraîchir les post-its toutes les 2 secondes
        $(document).ready(function() {
            loadPostIts();
            loadSharedPostIts();
            setInterval(loadPostIts, 2000); // Rafraîchir toutes les 2 secondes les post-its
            setInterval(loadSharedPostIts, 2000); // Rafraîchir les post-its partagés toutes les 2 secondes
        });