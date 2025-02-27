$(document).ready(function() {
            var selectedUsers = [];

            //voir les utilisateur lors de la recherche 
            $('#search').on('input', function() {
                var searchText = $(this).val().toLowerCase();
                if (searchText.length > 0) { // Si le champ de recherche n'est pas vide
                    $('#userList').show(); // Afficher la liste des utilisateurs
                } else {
                    $('#userList').hide(); // Sinon la cacher
                }

                // Parcourir la liste des utilisateurs et afficher ceux qui contiennent le texte de recherche
                $('#userList .user-item').each(function() { 
                    var username = $(this).data('username').toLowerCase();
                    if (username.indexOf(searchText) !== -1) { // Si le nom de l'utilisateur contient le texte de recherche
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });

            // Cacher la liste des utilisateurs lorsqu'on clique en dehors
            $(document).click(function(event) {
                if (!$(event.target).closest('#search, #userList').length) {
                    $('#userList').hide();
                }
            });
            /* Remarque: on utilise un champ cache pour stocker les utilisateurs et les recuperer dans le script php 
            de creation de post it  parce que l'utilisation d'un tableau de sesssion pour les stoker n'est pas efficace */
            // Ajouter un utilisateur à la liste des utilisateurs sélectionnés lorsqu'on clique sur un utilisateur
            $('#userList').on('click', '.user-item', function() {
                var username = $(this).data('username');
                if (!selectedUsers.includes(username)) {
                    selectedUsers.push(username);
                    $('#selectedUsers').append('<label class="user">' + username + '<span class="delete-icon">&times;</span></label>');
                    updateSelectedUsersInput();
                }
                $('#search').val('');
                $('#userList').hide();
            });

            // Supprimer un utilisateur de la liste des utilisateurs sélectionnés lorsqu'on clique sur l'icône de suppression
            $('#selectedUsers').on('click', '.delete-icon', function() {
                var username = $(this).parent().text().slice(0, -1);
                selectedUsers = selectedUsers.filter(function(user) {
                    return user !== username;
                });
                $(this).parent().remove();
                updateSelectedUsersInput();
            });

            // Mettre à jour la valeur de l'input caché qui contient les utilisateurs sélectionnés pour l'envoi du formulaire
            function updateSelectedUsersInput() {
                $('#selectedUsersInput').val(selectedUsers.join(','));
            }
        });