# Documentation Soosyze

## Guide de l'utilisateur de SoosyzeCMS

* [Héberger](/user/00_héberger.md)
* [Installer](/user/01_installer.md)
* [Configurer](/user/02_configurer.md)
* [Gérer](/user/03_gérer.md)

# Guide de développement de SoosyzeCMS

* [Introduction](development/00_introduction.md)
* [Installation et configuration](development/01_installation_et_configuration.md)
  * [Exigences d’installation](development/01_installation_et_configuration.md#exigences-dinstallation)
    * [Serveur Web](development/01_installation_et_configuration.md#serveur-web)
    * [Version PHP](development/01_installation_et_configuration.md#version-php)
    * [Extensions requises](development/01_installation_et_configuration.md#extensions-requises)
    * [Mémoire requise](development/01_installation_et_configuration.md#mémoire-requise)
    * [Connexion à internet](development/01_installation_et_configuration.md#connexion-à-internet)
  * [Installation](development/01_installation_et_configuration.md#installation)
    * [Téléchargement rapide](development/01_installation_et_configuration.md#téléchargement-rapide)
    * [Téléchargement via Git & Composer](development/01_installation_et_configuration.md#téléchargement-via-Git--Composer)
    * [Installation du CMS](development/01_installation_et_configuration.md#installation-du-cms)
  * [Configuration](development/01_installation_et_configuration.md#configuration)
    * [Ngnix](development/01_installation_et_configuration.md#ngnix)
* [Structure du CMS](development/02_structure_du_cms.md)
* [Tutoriel développer un module](development/03_tutoriel_développer_un_module.md#tutoriel-développer-un-module)
* [Environnement et outils de développement](development/04_environnement_et_outils_de_développement.md#environnement-et-outils-de-développement) new
  * [Environnement](development/04_environnement_et_outils_de_développement.md#environnement)
  * [Outils de développements](development/04_environnement_et_outils_de_développement.md#outils-de-développements)
* [Structure d’un module](development/05_structure_module/05_structure_module.md)
* [Hello World !](develoment/06_hello_world.md)
* [Routeur](development/07_routeur.md)
  * [Routes statiques](development/07_routeur.md#routes-statiques)
  * [Routes dynamiques](development/07_routeur.md#routes-dynamiques)
* [Contrôleurs](development/08_controleur.md#contrôleur)
  * [Namespace](development/08_controleur.md#namespace)
  * [Requête et Réponse](development/08_controleur.md#requête-et-réponse)
  * [RESTful](development/08_controleur.md#restfull) new
  * [Redirect](development/08_controleur.md#redirect)
* [Template](development/09_template.md#template)
  * [Utiliser un template](development/09_template.md#utiliser-un-template)
  * [Injection de variable](development/09_template.md#injection-de-variable)
  * [Injection de template](development/09_template.md#injection-de-template)
  * [Exercice page d’administration](development/09_template.md#exercice-page-dadministration) new
  * [Correction page d’administration](development/09_template.md#correction-page-dadministration)
  * [Bonus lexical](development/09_template.md#bonus-lexical) new
* [Formulaire](development/10_formulaire.md)
  * [Formulaire simple](development/10_formulaire.md#formulaire-simple)
  * [Formulaire simple & dynamique](development/10_formulaire.md#formulaire-simple--dynamique)
  * [Formulaire dynamique](development/10_formulaire.md#formulaire-dynamique)
  * [Protection CSRF](development/10_formulaire.md#protection-csrf)
  * [Exrecice formulaire d’édition](development/10_formulaire.md#exrecice-formulaire-dédition)
  * [Correction formulaire d’édition](development/10_formulaire.md#correction-formulaire-dédition)
* [Validation de données](development/11_validation.md#validation-de-données)
  * [Règles, valeurs et validation](development/11_validation.md#règles--valeurs-et-validation)
  * [Retour des succès et erreurs](development/11_validation.md#gestion-des-succès-et-erreurs)
  * [Exercice validation de l’édition](development/11_validation.md#exercice-validation-de-lédition)
  * [Correction validation de l’édition](development/11_validation.md#correction-validation-de-lédition)
* [Container et Services](development/12_container_services.md)
  * [Container](development/12_container_services.md#container)
  * [Utiliser un service](development/12_container_services.md#utiliser-un-service)
  * [Créer un service](development/12_container_services.md#créer-un-service)
  * [Injection d’arguments et de dépendances](development/12_container_services.md#injection-darguments-et-de-dépendances)
* [Modèle](development/13_model.md)
  * [SGBD](development/13_model.md#sgbd)
  * [QueryFlatFile](development/13_model.md#queryflatfile)
    * [Ajouter une table manuellement](development/13_model.md#ajouter-une-table-manuellement)
    * [Récupération de données](development/13_model.md#récupération-de-données)
    * [Requête dans un service](development/13_model.md#requête-dans-un-service)
    * [Insertion d’item](development/13_model.md#insertion-ditem)
    * [Exercice d’édition d’item](development/13_model.md#exercice-dédition-ditem)
    * [Correction de l’édition d’item](development/13_model.md#correction-de-lédition-ditem)
    * [Exercice suppression d’item](development/13_model.md#exercice-suppression-ditem)
    * [Correction suppression d’item](development/13_model.md#correction-suppression-ditem)
* [Hook](development/14_hooks.md)
  * [Princinpe du hook](development/14_hooks.md#pricinpe-du-hook)
  * [Appeler les hooks](development/14_hooks.md#appeler-les-hooks)
  * [Déclarer les hooks](development/14_hooks.md#déclarer-les-hooks)
  * [Exercice d’édition d’item](development/14_hooks.md#exercice-dédition-ditem)
  * [Correction de l’édition d’item](development/14_hooks.md#correction-de-lédition-ditem)
* [Intégration a SoosyzeCMS](#intégration-à-soosyzecms)
  * [Utilisez les thèmes de SoosyzeCMS]()
  * [Installation au ModuleManager]()
  * [Ajouter des droits utilisateur]()
  * [Ajouter un lien dans le menu]()
* [Notions avancées]()
  * [Envoie d’e-mail]()
  * [Utilisation du service config]()

## Prochainement

* Notions avancées
  * Envoie d’e-mail
  * Utilisation du service config
  * Upload de fichiers/images
  * Créer une node personnalisée
* Publier votre module
  * Convention de nommage
  * Convention syntaxique
  * Code de production
  * Documentation
  * Proposer votre module au téléchargement
* Tutoriel développer un theme
  * Structure d’un theme
  * Overide un template
* Publier votre theme
  * Convention de nommage
  * Convention syntaxique
  * Code de production
  * Documentation
  * Proposer votre theme au téléchargement

## Composants

* Email
* [FormBuilder](components/formebuilder.md)
* Http
* Template
* Util
* [Validator](components/validator.md)

## FAQ

* Modifier le formulaire de contact
* Intégrer une carte Google map
  * En brut (template)
  * Dans vos contenus (node)
* Intégrer une carte OpenStreetMap
  * En brut (template)
  * Dans vos contenus (node)
* Intégrer une vidéo Youtube
  * En brut (template)
  * Dans vos contenu (node)
* Intégrer une vidéo Dailymotion
  * En brut (template)
  * Dans vos contenus (node)
* Créer une ancre dans votre menus