# Neoness

Neoness est un exercice inventé dans le but, ici, d'apprendre à utiliser CodeIgniter lors de ma formation chez Beweb à Montpellier.

## Présentation du projet

Votre nouveau client NeoNess (salle de sport) vous demande de lui proposer une mini-application permettant de suivre l'évolution de chaque inscrit au club.
Le site web se décline en 3 pages incluant les fonctionnalités suivantes :
**- page d'accueil**: permet d'enregistrer un nouvel utilisateur et/ou d'entrer les références de celui-ci. Pour une première inscription, l'utilisateur doit entrer certaines informations (nom, prénom, tel, âge, poids, taille, objectif de poids) et son mot de passe. On pourra calculer ainsi l'IMC de chaque individu à chaque instant. L'utilisateur inscrit peut, suite à la saisie correcte de ses indentifiants, accéder à sa page individuelle de suivi, même si sa connexion précédente a été interrompue. (cookies+session)
**- page personnelle**: permet de préciser l'activité du jour et la restitution sous forme tabulaire (ou graphique) de l'évolution de son activité. L'utilisateur précise à partir d'un formulaire l'activité et le temps de pratique, et on proposera sous forme de tableau dynamique (modifiable) une visualisation de l'activité journalière. Une fois ce tableau finalisé, l'utilisateur pourra valider son activité en postant les informations de ce tableau. Tout est stocké en base de données pour présenter le récapitulatif global de l'activité sur une période plus importante. (1semaine / 1mois)
On peut également inclure une projection de l'IMC pour proposer à l'utilisateur une activité en fonction de ses objectifs si ils ne sont pas remplis.
On trouvera une présentation graphique sous forme de diagramme avec comme axe horizontal le temps et en axe vertical l'indice IMC.
**- page d'administration (back-office)**: L'administrateur a un compte déjà enregistré et unique, permettant d'afficher l'ensemble des données des utilisateurs (sous forme de tableau/liste), et de modifier les informations individuellement.

## Technos et outils utilisés

- php 
- codeIgniter (framework php)
- SQL & phpMyAdmin
