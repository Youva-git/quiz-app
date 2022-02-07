Mini plate-forme Web permettant de concevoir des quiz riches, de les exécuter et, d’obtenir des statistiques sur leurs réponses.  
Un quiz est une série de questions sur un sujet donné. Les questions sont posées successivement et, pour chaque
question, un choix de réponses est proposé (en général 3 réponses) parmi lesquelles une seule est correcte.  
L’application permettra de construire des quiz de longueur (nombre de questions) arbitraire et chaque question
pourra avoir jusqu’à 4 réponses.  
La question ainsi que les réponses proposées pourront contenir :  
* du texte non structuré, c’est-à-dire sans élément de structuration (pas de section, paragraphe, titre ni table),
mais éventuellement quelques éléments de mise en forme (gras, italique),  
* du contenu riche limité aux formules mathématiques et aux dessins vectoriels simples.  
  
## Déploiement de l’application:  
  
1. Copiez le dossier du projet dans le dossier « /var/www/html/ ».  
  
2. Activez le mod_rewrite d’apache2 pour gérer la ré-écriture d’URL.  
(commande :  #sudo a2enmod rewrite.)  
  
3. Modifiez le fichier de configuration d’apache2 ‘/etc/apache2/apache2.conf’.  
-- Définir le AllowOverride du <Directory /var/www/ en All.  
  
4. Redémarrez le serveur apache2.  
  
5. Configurez les constantes des DB dans le fichier /QUIZZ/app/body/database.php pour la base de données.  
(Vous trouverez le fichier projet.sql qui contient le modèle de la base de données utiliser dans l’archive.) 
    
