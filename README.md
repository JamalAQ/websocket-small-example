C'est un projet très simple pour expérimenter le fonctionnement de WebSocket.

Tout ce qu'il contient est l'ajout de données : nom d'utilisateur, e-mail et mot de passe (sans aucune condition de sécurité car il s'agit simplement d'un projet d'expérimentation).

Les données seront ajoutées directement à la page et à la base de données.
Il est possible d'ajouter plusieurs enregistrements sans problème.

Vous pouvez supprimer ou modifier les données en utilisant le nom d'utilisateur comme référence pour les données à modifier ou supprimer.

Comment faire fonctionner le site ?

Pour faire fonctionner le site, vous aurez besoin de XAMPP.

Lancez Apache et MySQL.

Ensuite, créez une base de données appelée "return" avec le type utf8mb4_general_ci.

Accédez à la base de données, sélectionnez l'option "importer" et choisissez le fichier return.sql dans les fichiers du projet.

Ensuite, copiez tous les fichiers du site dans un dossier du projet à l'intérieur du dossier htdocs dans le répertoire XAMPP.

Dans la ligne de commande, allez dans le dossier contenant le site, puis exécutez la commande suivante :
.
php websocket.php
.
Maintenant, nous avons un serveur PHP en cours d'exécution.
Allez dans votre navigateur et tapez l'adresse suivante :
.
http://localhost/nom_du_dossier_du_projet
.
Vous pouvez maintenant utiliser le site, et toutes les données, modifications ou suppressions seront sauvegardées.

Développé par :
Jamal Abou Kassem
