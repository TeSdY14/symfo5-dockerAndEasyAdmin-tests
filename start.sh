#!/bin/bash
echo "
Launching the docker-compose images => 'docker-compose up -d' ...
"

docker-compose up -d

echo "
Launching Symfony Web Server => 'symfony server:start -d' ...
"

symfony server:start -d

echo "

Liste des \"containers\" lancés => 'docker-compose ps' ...
"

docker-compose ps

echo "
Launching Application in web browser => 'symfony open:local' ...
"

symfony open:local

echo "
Launching RabbitMQ => 'symfony open:local:rabbitmq' ...
"

symfony open:local:rabbitmq

echo "
Launching Mail Catcher => 'symfony open:local:webmail' ...
"

symfony open:local:webmail

echo -n "
Faut il lancer des Workers en arrière plan ? [y]es / [n]o
"
read yesNo
echo yesNo
if [ "$yesNo" = "y" ] || [ "$yesNo" = "Y" ]; then 
	echo "
	Lancement des workers Symfony en tache de fond ...
	"
	symfony run -d --watch=config,src,templates,vendor symfony console messenger:consume async
else 
	echo "
	pour lancer manuellement les workers en arrière plan, exécuter la commande : 
	symfony run -d --watch=config,src,templates,vendor symfony console messenger:consume async
	"
fi

sleep 5s