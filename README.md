# Wiki™ : Explorez, Créez et Partagez des Savoirs Ensemble!

## Contexte du projet
Wiki a besoin d'un système de gestionnaire de contenu efficace, associé à un front office, pour offrir une expérience utilisateur exceptionnelle.
Ce système devrait permettre aux administrateurs de gérer facilement les catégories, les tags et les wikis, tout en offrant aux auteurs la possibilité de créer, modifier et supprimer leur propre contenu.
Du côté du front office, l'accent sera mis sur une interface utilisateur, avec des fonctionnalités telles que l'inscription simplifiée, une barre de recherche efficace, et des affichages dynamiques des derniers wikis et catégories pour une navigation.
L'objectif principal est de faire un endroit où tout le monde peut travailler ensemble, créer, trouver et partager des wikis de manière facile et intéressante.
​

## Fonctionalités clés:

**L'administrateur** doit avoir la capacité de créer, modifier et supprimer des catégories pour organiser le contenu.
Il devrait étre possibe d'associer plusieurs wikis à une catégorie.
L'administrateur doit pouvoir créer, modifier et supprimer des tags pour faciliter la recherche et le regroupement du contenu.
Les tags doivent être associés aux wikis pour une navigation plus précise.
Les administrateurs doivent avoir la possibilité d'archiver les wikis inappropriés pour maintenir un environnement sûr et pertinent.
Dashboard: Consultation des statistiques des entités via le tableau de bord.


**Les auteurs** doivent pouvoir s'inscrire sur la plateforme en fournissant des informations de base, telles que le nom, l'adresse e-mail et un mot de passe sécurisé.
Les auteurs doivent avoir la capacité de créer, modifier et supprimer leurs propres wikis.
Les auteurs devraient pouvoir associer une seul catégorie et plusieurs tags à leurs wikis pour faciliter l'organisation et la recherche.

**Les visiteurs** peuvent accéder à la page home pour consulter les wikis

## Partie Front Office:

- Les utilisateurs ont la possibilité de créer un compte (Register) en fournissant des informations de base, ainsi que de se connecter (Login) à leurs comptes existants. Si l'utilisateur possède un rôle administrateur, il sera redirigé vers la page du tableau de bord (dashboard), sinon, il sera redirigé vers la page d'accueil (Home).
- Une barre de recherche qui permet aux visiteurs de rechercher des wikis, des catégories, des tags sans nécessiter d'actualisation de la page en utilisant de AJAX.
- La page d'accueil qui affiche les derniers wikis ajoutés sur la plateforme, offrant ainsi aux utilisateurs un accès rapide au contenu le plus récent.
- En cliquant sur un wiki, les utilisateurs sont redirigés vers une page unique dédiée à ce wiki, offrant des détails complets tels que le contenu, les catégories associées, les tags, et les informations sur l'auteur.

​
## Technologies utilisées:
#### Technologie Frontend: 
[https://img.shields.io/badge/<svg role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><title>HTML5</title><path d="M1.5 0h21l-1.91 21.563L11.977 24l-8.564-2.438L1.5 0zm7.031 9.75l-.232-2.718 10.059.003.23-2.622L5.412 4.41l.698 8.01h9.126l-.326 3.426-2.91.804-2.955-.81-.188-2.11H6.248l.33 4.171L12 19.351l5.379-1.443.744-8.157H8.531z"/></svg>_HTML-5_#E34F26](https://img.shields.io/badge/:badgeContent?logo=HTML&logoColor=%23E34F26&labelColor=%23E34F26
)
HTML5, CSS Framework et Javascript

#### Technologie Backend: 
PHP 8 

Architecture MVC:
-- Système de routage La mise en place d'un système de routage selon l'architecture Modèle-Vue-Contrôleur (MVC)

-- Autoload: inclure l'utilisation de namespace pour l'organisation des classes.

#### Database: 
PDO driver

## Liens:
[Présentation](https://www.canva.com/design/DAF5sF9N7QI/c2Dw0bmwaXIDBu2dgS6FVQ/edit?utm_content=DAF5sF9N7QI&utm_campaign=designshare&utm_medium=link2&utm_source=sharebutton)
[GitHub Repository](https://github.com/HIBA-BEG/Wiki_Soutenance_Croisee_1.git)
