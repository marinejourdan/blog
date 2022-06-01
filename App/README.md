#Présentation du blog

Ce site est un blog de présentation de Marine Jourdan au niveau professionnel- Il met à jour ses nouvelles actualités par le biais d'articles.
Il se compose de deux parties:
-Public: accessible à tous- composition: Page d'accueil, page de blog, page d'inscription, page de connexion, contact
-Admin: Accessibles aux utilisateurs ayant les droits d'accès- composition: page accueil , page posts, users et comments
Il existe trois types d'utilisateurs
-Non inscrit- visiteur: possibilité de lecteur
-Inscrit et enabled: lecture et ajout de commentaires
-Inscrit et access:
    -Acces admin: modification, ajout, suppression de posts
                  modification, ajout, suppression de comptes utilisateurs
                  suppression de commentaires

##Realisation technique du blog

- Atom-éditeur de texte (html/php/css)
- phpmyadmin: serveur de gestion de base de données
- Git/Github: Gestionnaire de versions

### Installation du projet
Installez git et récupérez le projet de Github

'''git@github.com:marinejourdan/blog.git'''
Le contenu sera téléchargé dans le dossier où vous vous situez

- Paramêtrer le.env.dist avec vos propres données.


Au sein du projet vous aurez accès à trois dossiers:
- App : dans ce dossier se trouve le site
- Cas utilisation: Dans ce dossier se trouve les shémas des différents cas d'utilisation du site selon les profils (administrateur, vositeur inscrit, visiteur non-inscrit)
- Diagramme UML: Dans ce dossier, vous trouverez les diégrammes UML (MCD, MPD)
