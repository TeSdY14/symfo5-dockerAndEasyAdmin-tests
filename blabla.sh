#!/bin/bash
echo -n "
Faut il lancer des Workers en arrière plan ? [y]es / [n]o
"
read yesNo
echo yesNo
if [ "$yesNo" = "y" ] || [ "$yesNo" = "Y" ]; then 
	echo "
	Lancement des workers Symfony en tache de fond ...
	"
else 
	echo "
	pour lancer manuellement les workers en arrière plan, exécuter la commande : 
	symfony run -d --watch=config,src,templates,vendor symfony console messenger:consume async
	"
fi

sleep 5s