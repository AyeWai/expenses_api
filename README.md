# Documentation de l'API Expenses
Cette API permet de récupérer, ajouter, modifier et supprimer des note de frais.

##Installation

Cloner le projet et effectuer la commande suivante :
```
composer install
```

## Endpoints

GET /api/expenses : Renvoie toutes les note de frais enregistrées
GET /api/expense/{id} : Renvoie la note de frais correspondant à l'ID spécifié
POST /api/expense/new : Crée une nouvelle note de frais
PUT /api/expense/edit/{id} : Modifie la note de frais correspondant à l'ID spécifié
DELETE /api/expense/del/{id} : Supprime la note de frais correspondant à l'ID spécifié

## Paramètres
date : La date de la note de frais au format "DD-MM-YYYY"
amount : Le montant de la note de frais
expensestype : Le type de la note de frais
companyname : Le nom de l'entreprise associée à la note de frais

## Réponses

GET /api/expenses :
Code de statut : 200 OK
Contenu : Un tableau JSON de toutes les note de frais enregistrées. Si aucune note de frais n'a été trouvée, une exception 404 Not Found est renvoyée.

GET /api/expense/{id} :
Code de statut : 200 OK
Contenu : Un objet JSON représentant la note de frais correspondant à l'ID spécifié. Si aucune note de frais n'a été trouvée, une exception 404 Not Found est renvoyée.


POST /api/expense/new :
Code de statut : 200 OK
Contenu : Un objet JSON représentant la nouvelle note de frais créée.

PUT /api/expense/edit/{id} :
Code de statut : 200 OK
Contenu : Un objet JSON représentant la note de frais modifiée.

POST /api/expense/del/{id} :
Code de statut : 200 OK
Contenu : Un message JSON indiquant que la note de frais a été supprimée avec succès.
