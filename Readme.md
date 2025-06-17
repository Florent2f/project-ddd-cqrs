## DDD - CQRS - Clean architecture project

Projet personnel dont l’objectif principal est de renforcer mes compétences en architecture logicielle.
Ce projet me permet d’approfondir l’application concrète de concepts avancés tels que le CQRS, le DDD, Pattern Command, etc..
Il constitue également un terrain d’expérimentation pour consolider mes connaissances théoriques et améliorer ma capacité à concevoir des systèmes orientés domaine, découplés et évolutifs.


### Couche Domain
C'est le cœur de l'application. Elle contient toute la logique métier, ce que fait réellement le système, indépendamment de toute technologie ou infrastructures. C'est ici qu'on modélise les entités, les values, objects et les services métiers. Cette couche ne connaît ni symfony, ni doctrine, ni quoi que ce soit d'extérieur. Elle est totalement pure et indépendante, ce qui la rend testable facilement.

### Couche Application
Orchestre les cas d'usage de notre système. Elle décrit ce que fait le système. Elle utilise les objets du domaine pour exécuter des scénarios concrets, sans contenir la logique métier. 
On y retrouve des commandes, des handlers, des queries, parfois des ports. Elle est le pont entre les intentions de l'utilisateur et les règles métiers.
Elle dépend du domaine, mais ne connaît ni symfony ni doctrine. 

### Couche Infrastructure
Contient toutes les dépendances techniques, base de données, email, API externes, file storage..
Elle implémente les interfaces définies par l'application ou le domaine. C'est aussi ici qu'on configure les outils comme Symfony Messenger, doctrine ou encore la sérialisation.
L'infrastructure ne doit jamais contenir de logique métier. C'est une couche d'exécution, interchangeable si besoin. 

### Couche Présentation
Gère la communication entre l'utilisateur et le système. Elle interprète les requêtes HTTP, les commandes CLI, les événements websocket, puis transmet les données sous forme de commande à l'application. Elle s'occupe également de formater les réponses.
Cette couche contient les contrôleurs, les formulaires, les validations de requêtes, les templates.
Elle peut utiliser les composants du framework, mais ne doit pas contenir de logique métier.