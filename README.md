# blindtest
Vous trouverez le code de l'application sur la branche "develop" du github

Url de l'application : http://antoinelau.alwaysdata.net/login

# Compte admin 
mrbacquet@test.fr 

password

# Diagramme UML 
https://drawsql.app/teams/robin-2/diagrams/cnam-blindtest

# Cahier des charges

## Titre

Développement d’une application web pour créer et participer à des blind-tests.

## Contexte

M. Bacquet et ses amis connaissent une quantité astronomique de musiques. Pour voir qui en connait le plus, M. Bacquet a demandé à la Spaghetti Agency de développer une webapp permettant de faire des blind tests. 

## Besoins et contraintes

Besoins :

- Créer un compte
- Gérer sa liste d’amis
- Lancer des blind tests en local et inviter des amis
- Ajouter de nouvelles musiques (lien youtube)
- Créer des playlists avec des tags
- Accéder à l’historique des parties

Contraintes :

- La solution devra être accessible depuis toutes les plateformes disposant d’un navigateur internet

## Livrables

- La solution sera déployée sur un serveur web.
- Une base de données MySql

# Réponse au besoin

- **Fonctionnel** → Une IHM permettant de
    - Créer un compte
    - Gérer sa liste d’amis
    - Lancer des playlists de blind tests et inviter des amis (avec ou sans compte)
    - Ajouter de nouvelles musiques
    - Créer des playlists avec des tags
    - Accéder à l’historique des parties
- **Technique :**
    - Le tout relié à une BDD MySQL persistant les données. Rapide, fiable et gratuit.
    - L’application sera développée avec le language PHP qui est le language le plus populaire pour le développement de sites internet.


# Base de donnée

Disponible sur la branche "develop" -> blindtest.sql 
