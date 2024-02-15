TP-WEB
===

Bienvenue sur la plateform web pédagogique de l'Université de Rouen Normandie.

Dans le cadre de vos enseignements, vous disposez d'un espace d'hébergement Web nominatif de type LAMP (Linux Apache MySQL PHP).
Votre site personnel est consultable en accès libre depuis les réseaux informatiques internes de l'Université (WiFi et Filaire) et est soumis à authentification depuis l'extérieur (via votre compte multipass).

Vous disposez :
- d'un environnement de type LAMP: Linux Apache MySQL (MariaDB 10.6) PHP 8.1
- d'un espace de stockage de 5Go
- d'un compte et d'une base de données MySQL associée

# Accès Web

Votre site est consultable à l'adresse:
- http://dumondy1.tpweb.univ-rouen.fr

# Accès FTP
Pour accéder à votre espace d'hébergement, vous devez utiliser un client FTP (ex: FileZilla):
- adresse du serveur: ftp.tpweb.univ-rouen.fr
- identifiants: votre compte Multipass

Vos contenus Web (html, css, php, médias...) doivent être déposés dans le répertoire:  `public_html`
Ce dossier est un paramètre important de la configuration du serveur Web (DocumentRoot). Vous ne devez en aucun cas le supprimer.

# Accès MySQL
Pour gérer votre base de données MySQL, vous pouvez utiliser l'interface Web:
- https://sql.tpweb.univ-rouen.fr

Avec les informations suivantes:
- identifiant: usr-dumondy1
- mot de passe: qLd6IWPHdRj2
- nom la base de données: db-dumondy1
- adresse du serveur: localhost

Quelques remarques concernant votre base de données:
- vous disposez des privilèges SQL: `ALL PRIVILEGES` sur votre base y compris celui de la supprimer (prudence donc !).
- vous n'avez qu'une seule base de données. Pour éviter les conflits, il est conseillé d'utiliser une nomenclature propre à chacun de vos projets, en préfixant le nom de vos tables (ex: wp_xxxx pour un projet Wordpress).

# Respect de la législation en vigueur
Vous êtes tenu de respecter les différentes législations en vigueur. Notamment, et de manière non exhaustive :
- les lois Informatiques et Libertés
- les lois sur la Propriété Intellectuelle
- les lois sur le piratage informatique

# Chartes
Vous êtes tenu de respecter les différentes chartes en vigueur, notamment [celles de l'Université de Rouen](http://communaute-universitaire.univ-rouen.fr/chartes-588303.kjsp), et de RENATER.

# Support technique:
Pour toute demande d'assistance vous pouvez adresser un mail à [support-recherche@univ-rouen.fr](mailto:support-recherche@univ-rouen.fr)
