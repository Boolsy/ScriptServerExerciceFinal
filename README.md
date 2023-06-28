# Evaluation certificative Script Server

Ce projet requiert un serveur Web pour être exécuté.<br> 
Il est recommandé d'utiliser un serveur tel que Wamp pour assurer une compatibilité optimale.<br> 
Vous devez également vous assurer d'avoir une connexion Internet active pour accéder aux dépendances externes, telles que les fichiers CSS et JavaScript, qui peuvent être chargés à partir de sources en ligne.

## Prérequis

Assurez-vous d'avoir les éléments suivants installés sur votre système :

- PHP 8.2.0
- MySql 8.0.31
- Apache 2.4.54.2

## Installation

Il existe deux façons d'installer le projet :

### Méthode 1: Téléchargement direct

1. Téléchargez l'intégralité du projet en cliquant sur le bouton "Download" et décompressez-le.

2. Copiez le dossier "ScriptServerExerciceFinal" dans votre dossier www (si vous utilisez Wamp).

### Méthode 2: Clonage du projet

1. Ouvrez votre invite de commande ou terminal.

2. Accédez au répertoire www de votre serveur en utilisant la commande `cd` :

3. cd /chemin/vers/votre/dossier/www

   
3. Clonez le projet en utilisant la commande `git clone` avec l'URL suivante :
4. `git clone https://github.com/Boolsy/ScriptServerExerciceFinal.git`

   
##  Importez la base de données en utilisant par exemple PHPMyAdmin :
1. Ouvrez PHPMyAdmin dans votre navigateur.
2. Créez une nouvelle base de données vide et nommez-la "webex".
3. Importez le fichier `sql/webex.sql` dans la base de données que vous venez de créer.

Vous pouvez maintenant passer à l'étape suivante de configuration du projet.


## Configuration

1. Renommez le fichier `config-dist.php` en `config.php`.

2. Ouvrez le fichier `config.php` et remplissez les variables pour l'utilisation de la base de données en fonction de votre configuration.

   Exemple :
   ```php
   <?php
   define('DB_NAME', 'votre_nom_base_de_donnees');
   define('DB_HOST', 'localhost');
   define('DB_USER', 'votre_nom_utilisateur');
   define('DB_PASSWORD', 'votre_mot_de_passe');

3. Enregistrez les modifications effectuées dans le fichier config.php.

   
   


