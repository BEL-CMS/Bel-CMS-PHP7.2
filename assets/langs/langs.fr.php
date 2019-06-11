<?php
/**
 * Bel-CMS [Content management system]
 * @version 0.0.1
 * @link https://bel-cms.be
 * @link https://stive.eu
 * @license http://opensource.org/licenses/GPL-3.0 copyleft
 * @copyright 2014-2019 Bel-CMS
 * @author Stive - determe@stive.eu
 */

if (!defined('CHECK_INDEX')) {
	header($_SERVER['SERVER_PROTOCOL'] . ' 403 Direct access forbidden');
	exit(ERROR_INDEX);
}

Common::constant(array(
	#####################################
	# Fichier lang en français - Erreur
	#####################################
	'ERROR'                  => 'Erreur',
	'UNKNOWN_ERROR'          => 'Erreur inconnu',
	'WARNING'                => 'Avertissement',
	'INFO'                   => 'Information',
	'SUCCESS'                => 'Succès',
	'ACCESS'                 => 'Accès',
	'NO_ACCESS_REQUEST_PAGE' => 'L\'accès à la page demandée est interdite',
	'NO_ACCESS_PAGE'         => 'La page demandée est actuellement fermée',
	'NO_ACCESS_GROUP_PAGE'   => 'Votre groupe d\'accès ne vous permet pas d\'accéder à cette page',
	'DEFAULT_AVATAR'         => 'assets/imagery/default_avatar.jpg',
	'COPYLEFT'               => '<a id="bel_cms_copyleft" href="https://bel-cms.be" title="BEL-CMS">Powered by Bel-CMS</a>',
	'PUBLISH'                => 'Publier',
	'YOUR_COMMENT'           => 'Votre commentaire',
	'COMMENT_EMPTY'          => 'Commentaire vide',
	'URL_EMPTY'              => 'URL vide',
	'COMMENT_SEND_TRUE'      => 'Le commentaire a été posté avec succès.',
	'COMMENT_SEND_FALSE'     => 'Le commentaire n\'a pas pu être envoyé.',
	'ERROR_NO_ID_VALID'      => 'L’ID transmis est incorrecte',
	'ERROR_NO_ID'            => 'Aucun ID transmis',
	'ERROR_INSERT_BDD'       => 'Il y a eu une erreur de BDD, lors de l\'insertion',
	'ERROR_UPDATE_BDD'       => 'Il y a eu une erreur de BDD, lors de la mise à jour',
	'ERROR_NO_USER'          => 'Utilisateur n\'existe pas',
	'NO_TEXT_DEFINED'        => 'Aucun texte n\'a été défini',
	#####################################
	# COMMUN
	#####################################
	'VALIDATE_MEMBER'        => 'Membre validé',
	'VALIDATE_MEMBER'        => 'Membre actif',
	'PENDING_MEMBER'         => 'Membre en attente',
	'VISITOR'                => 'Visiteur',
	'VISITORS'               => 'Visiteurs',
	'VALID'                  => 'Valider',
	'SEE'                    => 'Voir',
	'ADD'                    => 'Ajouter',
	'EDIT'                   => 'Editer',
	'MODIFY'                 => 'Modifier',
	'DELETE'                 => 'Supprimer',
	'BACK'                   => 'Retour',
	'CONFIRM'                => 'Confirmer',
	'UNKNOWN'                => 'Inconnu',
	'MESSAGE'                => 'Message',
	'MESSAGES'               => 'Messages',
	'MESSAGES_PRIVATE'       => 'Boîte de réception',
	'ON'                     => 'Sur',
	'THE'                    => 'Le',
	'SEND'                   => 'Envoyer',
	'ABOUT_ME'               => 'À propos de moi',
	'VIEW'                   => 'Voir',
	'USERNAME'               => 'Nom d\'utilisateur',
	'BIRTHDAY'               => 'Anniversaire',
	'COUNTRY'                => 'Pays',
	'DESCRIPTION'            => 'Description',
	'LOCATION'               => 'Emplacement',
	'GENDER'                 => 'Genre',
	'WEBSITE'                => 'Site Internet',
	'NAME'                   => 'Nom',
	'DATE'                   => 'Date',
	'OF'                     => 'sur',
	'BY'                     => 'par',
	'OPTIONS'                => 'Options',
	'SAVE'                   => 'Enregister',
	'CANCEL'                 => 'Annuler',
	'LOGIN_REQUIRE'          => 'Login requis',
	'SUBMIT'                 => 'Soumettre',
	'EMPTY'                  => 'Vide',
	'OTHER'                  => 'Autre',
	'TITLE'                  => 'Titre',
	'PUBLIC'                 => 'Public',
	'PRIVATE'                => 'Privé',
	'SIGN_OUT'               => 'Se déconnecter',
	'SIGN_IN'                => 'Se connecter',
	'MAIL'                   => 'E-mail',
	'UPDATE_NOW'             => 'Mettre à jour maintenant',
	'FILE'                   => 'Fichier',
	'FILES'                  => 'Fichiers',
	'LINK'                   => 'Lien',
	'LINKS'                  => 'Liens',
	'PROFIL'                 => 'Profil',
	'LAST'                   => 'Hier',
	'TODAY'                  => 'Aujourd\'hui',
	'NOW'                    => 'Maintenant',
	'ADMINISTRATOR'          => 'Administrateur',
	'ADMINISTRATORS'         => 'Administrateurs',
	'FILE_ATTACHMENT'        => 'Pièce jointe',
	#####################################
	# UPLOAD
	#####################################
	'UPLOAD_ERROR'           => 'Echec de l\'upload !',
	'UPLOAD_ERROR_FILE'      => 'Vous devez uploader un fichier de type prédéfini.',
	'UPLOAD_ERROR_SIZE'      => 'Le fichier est trop volumineux',
	'UPLOAD_FILE_SUCCESS'    => 'Upload effectué avec succès.',
	'UPLOAD_NONE'            => 'Aucun fichier en upload',
	#####################################
	# COLOR
	#####################################
	'RED'                    => 'Rouge',
	'BLUE'                   => 'Bleu',
	'YELLOW'                 => 'Jaune',
	'GREEN'                  => 'Vert',
	#####################################
	# POSITION
	#####################################
	'TOP'                    => 'Haut',
	'RIGHT'                  => 'Droit',
	'BOTTOM'                 => 'Bas',
	'LEFT'                   => 'Gauche',
	#####################################
	# Management
	#####################################
	'TITLE_MANAGEMENT'       => 'Management',
	'PREFGEN'                => 'Préférences Générales',
	'ERROR_NO_DATA'          => 'Erreur aucune données !',
	'NEW_PARAMETER_SUCCESS'  => 'Mise à jour de la configuration avec succès.',
	'NEW_PARAMETER_ERROR'    => 'Erreur durant la mise à jour de la configuration.',
	'ACTIVE'                 => 'Actif',
	'ACTIVATE'               => 'Activer',
	'DISABLE'                => 'Désactiver',
	'GROUPS'                 => 'Groupes',
	'PAGE'                   => 'Page',
	'PAGES'                  => 'Pages',
	'WIDGET'                 => 'Widget',
	'WIDGETS'                => 'Widgets',
	'MAX_SHOUTBOX'           => 'Maximum de message',
	'MAX_SHOUTBOX_ADMIN'     => 'Maximum de message management',
	'MAX_USER'               => 'Maximum d\'utilisateur à affiché',
	'MAX_USER_ADMIN'         => 'Maximum d\'utilisateur à affiché (admin)',
	'MAX_BLOG'               => 'Maximum de blog à affiché',
	'MAX_BLOG_ADMIN'         => 'Maximum de blog à affiché (admin)',
	'CUSTOM_NAME'            => 'Nom personnalisé',
	'POSITION'               => 'Position',
	'ORDER'                  => 'Ordre',
	'ACCESS_PAGE'            => 'Accès page',
	'CONFIG'                 => 'Configuration',
	'PARAMETER'              => 'Paramètre',
	'PARAMETERS'             => 'Paramètres',
	'GENERAL'                => 'Général',
	'NAVIGATION'             => 'Navigation',
	'EXTRA'                  => 'Extra',
	'EXTRAS'                 => 'Extras',
	#####################################
	# Nom des modules
	#####################################
	'HOME'                   => 'Accueil',
	'BLOG'                   => 'Blog',
	'NEWS'                   => 'News',
	'DOWNLOADS'              => 'Téléchargements',
	'FORUM'                  => 'Forum',
	'USER'                   => 'Utilisateur',
	'USERS'                  => 'Utilisateurs',
	'COMMENTS'               => 'Commentaires',
	'COMMENT'                => 'Commentaire',
	'READMORE'               => 'Lire la suite',
	'NEWTHREAD'              => 'Nouveau Post',
	'INBOX'                  => 'Boîte de réception',
	#####################################
	# USER
	#####################################
	'FEMALE'                 => 'Femme',
	'MALE'                   => 'Homme',
	'UNISEXUAL'              => 'Unisexe',
	'NO_SPEC'                => 'Non spécifié',
	'MEMBER'                 => 'Membre',
	'MEMBERS'                => 'Membres',
	'PSEUDO'                 => 'Pseudo',
	'ABOUT'                  => 'À propos',
	'MY_AVATAR'              => 'Mes avatars',
	'AVATAR'                 => 'Avatar',
	'AVATARS'                => 'Avatars',
	#####################################
	# WIDGETS USERS
	# ###################################
	'CONNECTED'              => 'Connectés',
	#####################################
	# LANG
	# ###################################
	'FRENCH'                 => 'fr',
	'ENGLISH'                => 'eng',
	'NETHERLANDS'            => 'nl',
	'DEUTCH'                 => 'de',
));