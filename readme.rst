##################################
Projet interne - Beweb - Deeveadee
##################################

pré-requis: codeigniter 3.1.4, mysql workbench,phpmyadmin, jquery/ajax,
bootstrap-sass.3.3.7 ( l’utilisation de plugin est proscrite).

********
Enoncé :
********

On désire réaliser une base de données pour la gestion d’une bibliothèque de DVDs.
Chaque société de location de DVD a un nom et une adresse (nom de rue et ville),
ainsi qu’un nom de directeur. Plusieurs sociétés de location peuvent porter le même
nom.
Tout DVD possède un titre, un auteur, une année de sortie, un numéro qui permet
de l'identifier, une catégorie (ex : action, aventure); on enregistre également sa date
d'acquisition, le nombre d’exemplaires achetés et la société qui l’a acquis.
Pour un acteur on mémorise son nom, son prénom, son âge et son sexe. Pour
chaque DVD et pour chaque acteur principal du film concerné, on mémorise le rôle
tenu dans le film.
Un DVD est emprunté par un client (numéro du client, nom, prénom,adresse) à une
date donnée et pour une durée déterminée (nombre de jours). Un même client ne
peut emprunter un même DVD plus d’une fois par jour.

**********************************
Cahier des charges : ​ Deeveadee.my
**********************************

Le client souhaite mettre en place un système de gestion de location de dvd
commun à toutes ses boutiques (il en possède 4).
L’ensemble des dvd seront centralisés sur une seule table, cependant le stock et les
références ne sont pas commun aux 4 boutiques.
Partie visiteur / Client
Une Landing page présentant les activités de sa société.
Le design de la page devra être épuré,de style résolument moderne et en respectant
la palette de couleur choisie par le client:Color Hex RGB
#97ecdb (151,236,219)
#fc5e21 (252,94,33)
#c90b0b (201,11,11)
#70146a (112,20,106)
#879528 (135,149,40)
Polices souhaitées : Comfortaa, Samarkan (dossier de ressources G.drive).
La page devra être aussi adaptée aux mobiles (responsive).
Mise en avant des nouveautés, des films et des genres le plus consultés.
Proposer des abonnements.
Possibilitée de partage sur les réseaux sociaux.
Mettre en avant ses boutiques via un une googlemaps.
Permettre au client :
voir la liste des films avec ou sans filtre thématique
de créer un compte,
de gérer son abonnement,
de voir son historique de location,
de réserver un film,
de laisser un commentaire sur un film,
de noter un film,
de recevoir des offres promotionnelles en fonction de ses goûts.
Partie gérant/employé
fonctionnalités souhaités : (employés, gérant)
voir/ajouter/éditer/supprimer un film.
voir/ajouter/éditer/supprimer un thème.
voir/ajouter/éditer/supprimer un abonnementvoir le nombre d’exemplaire disponible d’un film de façon globale ou
par boutique.
voir la liste de ses clients, de la boutique dans laquelle il s’est abonné.
Voir quel thème est le plus consulté de façon globale ou par boutique.
Voir quelle boutique est la plus performante.
Partie gérant
Gérer ses employés.
voir/ajouter/éditer/supprimer une boutique.
voir/ajouter/éditer/supprimer un employé.
afficher l’emploi du temps des employés.
voir/ajouter/éditer/supprimer des horaires.
Technologies souhaitées : Codeigniter, mysql, jquery/ajax, bootstrap, css3…
Votre travail sera enregistré sur votre git perso, avec votre base de donnée
enregistrée sauvegarder en fichier deeveadee_bdd.txt