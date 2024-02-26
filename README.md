#  Panne Alerte
## Table des matieres 

1. Contexte du projet
2. Objectifs du projet
3. Mise en place du projet
4. Api Endpoints

# 1-Contexte du projet 
Le présent projet est un détecteur de rupture de service, similaire à Down Detector, adapté aux besoins locaux. Ce détecteur de rupture de service sera une plateforme en ligne permettant aux utilisateurs de signaler et de surveiller les interruptions de service dans divers domaines tels que les télécommunications, l'électricité, l'eau, etc.
Développer une plateforme conviviale permettant aux utilisateurs togolais de signaler les interruptions de service.
Fournir aux utilisateurs des informations en temps réel sur les interruptions de service dans différentes régions du Togo.
Faciliter la communication entre les fournisseurs de services et les consommateurs pour résoudre rapidement les problèmes de service.

# 2-Objectifs du projet
- Développer une plateforme conviviale permettant aux utilisateurs locaux de signaler les interruptions de service.
- Fournir aux utilisateurs des informations en temps réel sur les interruptions de service dans différentes régions.

# 3-Mise en place du projet

### Installation des dépendances
- Pour la branche Master (principale contenant l'API)

Vous devez cloner le repo sur votre machine en utilisant la commande qui suit 

```bash
https://github.com/TheLordSide/TogoPanneAlerte.git
```

Une fois le projet cloné exectuez cette commande à la racine du dossier contenant le projet

```bash
composer install
```

En cas d'échec de la commande précédente, faute à alto router , executer les commandes suivantes : 

```bash
composer remove altorouter/altorouter
```

```bash
composer require altorouter/altorouter

```

- Pour la branche FrontEnd (pour les templates)

### Branches du repository
3 branches pour l'instant : Master, FrontEnd, Deploy.

- Master : Cette branche contient l'API. Elle contient les modifications pour le BackEnd.
- FrontEnd : Comme son nom l'indique elle contient les differents FrontEnd ( Web pour l'instant). Tous les commit sur le front seront sur cette branche
- Deploy : On verra.

### Database 
La base de données choisie est MySQL. Vous pouvez retouver la documentation officielle de MySQL [ici](https://dev.mysql.com/doc/). Vous retrouvez le fichier .SQL dans l'arborescance comme suit 

```bash
TogoPanneAlerte/
|----api
     |----config
     |----|-togopannealerte.sql

```

# 4-Api Endpoints

il y a 2 méthodes HTTP utilisés : GET, POST


## Endpoints pour USER


### GET/TogoPanneAlerte/api/users

#### Afficher tous les utilisateurs 

Cet endpoint retourne une liste de tous les utilisateurs, la valeur du success , le statut code. La Méthode est GET.

l'url à utiliser sur un serveur local est le suivant :

```bash
 http://127.0.0.1/TogoPanneAlerte/api/users

```

Voici les un exemple des résultats attendus en cas de success 

```bash
{
  "response": {
    "success": true,
    "data": [
      {
        "id": 1,
        "username": "ss",
        "email": "f",
        "created_on": "2024-02-20 20:32:26.000000"
      },
      {
        "id": 2,
        "username": "ss",
        "email": "f",
        "created_on": "2024-02-20 20:34:35.000000"
      },
      {
        "id": 3,
        "username": "ss",
        "email": "f",
        "created_on": "2024-02-20 20:39:12.000000"
      },
  },
  "statuscode": 200
}

```

### GET/TogoPanneAlerte/api/users/?id

#### Afficher les informations d'un utilisateur

Cet endpoint retourne les informations dur un utilisateur depuis la recherche par son ID, la valeur du success , le statut code. La Méthode est GET.

l'url à utiliser sur un serveur local est le suivant :

```bash
 http://127.0.0.1/TogoPanneAlerte/api/users/1

```
Voici les un exemple des résultats attendus en cas de success 

```bash
{
    "response": {
        "success": true,
        "data": {
            "id": 1,
            "username": "ss",
            "email": "f",
            "created_on": "2024-02-20 20:32:26.000000"
        }
    },
    "statuscode": 200
}
```

Voici un exemple de résultat attendu dans lorsque l'utilisateur n'existe pas

```bash

{
    "response": {
        "success": false,
        "erreur": "Ce compte n'existe pas"
    },
    "statuscode": 404
}
```

### POST/TogoPanneAlerte/api/users/create

#### Enregistrer un utilisateur 

Cet endpoint permet d'enregistrer un utilisateur et retourne une liste de tous les utilisateurs, la valeur du success , le statut code. La Méthode est POST.

l'url à utiliser sur un serveur local est le suivant :


```bash
 http://127.0.0.1/TogoPanneAlerte/api/users/create

```

Voici un exemple de résultat attendu en cas de success

```bash
{
    "response": {
        "success": true,
        "data": {
            "id": "11",
            "username": "ruben",
            "email": "mobileff",
            "created_on": "2024-02-23 17:33:31"
        }
    },
    "statuscode": 200
}

```
Voici un exemple de résultat attendu dans le cas d'enregistrement d'un utilisateur dont l'email existe déjà

```bash

{
    "response": {
        "success": false,
        "erreur": "Ce compte existe déjà"
    },
    "statuscode": 409
}

```

Voici un exemple de résultat attendu lorsque aucune information n'est renseignée

```bash
{
    "response": {
        "success": false,
        "erreur": "Informations manquantes pour continuer la création du compte"
    },
    "statuscode": 400
}

```


## Endpoints pour SERVICE

### GET/TogoPanneAlerte/api/services

#### Afficher tous les services 

Cet endpoint retourne une liste de tous les services, la valeur du success , le statut code. La Méthode est GET.

l'url à utiliser sur un serveur local est le suivant :

```bash
 http://127.0.0.1/TogoPanneAlerte/api/services

```

Voici les un exemple des résultats attendus en cas de success 

```bash
{
    "response": {
        "success": true,
        "data": [
            {
                "id": 1,
                "designation": "d",
                "fournisseur": "dde",
                "type": "efe",
                "description": "f"
            },
            {
                "id": 2,
                "designation": "togo",
                "fournisseur": "togocom",
                "type": "mobile money",
                "description": "blabla"
            },
            {
                "id": 3,
                "designation": "togog",
                "fournisseur": "togocom",
                "type": "mobile money",
                "description": "blabla"
            }
        ]
    },
    "statuscode": 200
}

```

### GET/TogoPanneAlerte/api/services/?id

#### Afficher les informations d'un service

Cet endpoint retourne les informations dur un service depuis la recherche par son ID, la valeur du success , le statut code. La Méthode est GET.

l'url à utiliser sur un serveur local est le suivant :

```bash
 http://127.0.0.1/TogoPanneAlerte/api/services/1

```
Voici les un exemple des résultats attendus en cas de success 

```bash
{
    "response": {
        "success": true,
        "data": {
            "id": 1,
            "designation": "d",
            "fournisseur": "dde",
            "type": "efe",
            "description": "f"
        }
    },
    "statuscode": 200
}
```

Voici un exemple de résultat attendu dans lorsque l'utilisateur n'existe pas

```bash

{
    "response": {
        "success": false,
        "erreur": "Ce service n'existe pas"
    },
    "statuscode": 404
}
```