# Analise

- Définir les fonctionnalités (interface et/ou UML use case)
- Créer diagramme de classes
- Associer controllers et fonctionnalités / interface
- Créer un repo dans Github


# Implementation

## 1. Modèle

- Créer le modèle 
- Créer script (.bat en windows) pour initialiser-effacer la BD-lancer les migrations
- Créer un script pour pusher votre code dans le repo remote
- Lancer la migration (faites le à chaque changement du modèle)

- Creer le système d'authentication (class User) et le controller pour login
- Créer le controller pour s'enregistrer sur le site

- Créer des fixtures pour remplir de données de base du modèle, speciálement pour l'User car vous ne voulez pas devoir enregistrer à la main un User à chaque migration (voir UserFixtures dans le projet, elle est particulière)
  
## 2. Controllers et vues

- Installez webpack-encore
- Lancer yarn install

- Créer un prémier controller (p.e. HomeController) et une action home (route "/") auquel on redirige après le login 
- Créer la vue pour l'action précédante
- Implementer une par une (dans un ordre logique) les fonctionnalités dans les controllers, créer de services pour les fonctionnalités qui se répétent ou qui se trouvent dans plusieurs actions (ex: file upload)


