<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
return [
    'accepted'                => [
        'must' => 'Le champ :label doit être accepté.',
        'not'  => 'Le champ :label ne doit pas être accepté.'
    ],
    /* OK */
    'alpha_num'               => [
        'must' => 'Le champ :label doit contenir que des lettres et des chiffres.',
        'not'  => 'Le champ :label ne doit pas contenir des lettres et des chiffres.'
    ],
    'alpha_num_text'          => [
        'must' => 'Le champ :label doit contenir que des lettres, des chiffres et des caractères de ponctuation.',
        'not'  => 'Le champ :label ne doit pas contenir des lettres, des chiffres et des caractères de ponctuation.'
    ],
    /* OK */
    'array'                   => [
        'must' => 'Le champ :label doit être un tableau.',
        'not'  => 'Le champ :label ne doit pas être un tableau.'
    ],
    'base64'                  => [
        'must' => 'Le champ :label doit être encodé en base64.',
        'not'  => 'Le champ :label ne doit pas être encodé en base64.'
    ],
    /* OK */
    'bewteen'                 => [
        'must' => 'Le champ :label doit être entre :min et :max.',
        'not'  => 'Le champ :label ne doit pas être entre :min et :max.'
    ],
    'between_numeric'         => [
        'size_numeric' => 'Le champ :label doit être numérique.'
    ],
    /* OK */
    'bool'                    => [
        'must' => 'La valeur du champ :label doit être un boolean.',
        'not'  => 'La valeur du champ :label ne doit pas être un boolean.'
    ],
    'callback'                => [
    ],
    'colorhex'                => [
        'must' => 'Le champ :label doit être une couleur au format hexadecimal.',
        'not'  => 'Le champ :label ne doit pas être une couleur au format hexadecimal.',
    ],
    /* OK */
    'date'                    => [
        'must' => 'Le champ :label doit être une date.',
        'not'  => 'Le champ :label ne doit pas être une date.'
    ],
    /* OK */
    'date_after'              => [
        'after'     => 'Le champ :label doit être une date supérieur à :dateafter.',
        'not_after' => 'Le champ :label ne doit pas être une date supérieur à :dateafter.'
    ],
    'date_after_or_equal'     => [
    ],
    /* OK */
    'date_before'             => [
        'before'     => 'Le champ :label doit être une date inférieur à :datebefore.',
        'not_before' => 'Le champ :label ne doit pas être une date inferieur à :datebefore.'
    ],
    'date_before_or_equal'    => [
    ],
    /* OK */
    'date_format'             => [
        'format'     => 'Le champ :label doit être une date au format :datebefore.',
        'not_format' => 'Le champ :label ne doit pas être une date au format :datebefore.'
    ],
    /* OK */
    'dir'                     => [
        'must' => 'Le champ :label doit être un chemin valide.',
        'not'  => 'Le champ :label ne doit pas être un chemin valide.'
    ],
    /* OK */
    'email'                   => [
        'must' => 'Le champ :label doit être une adresse e-mail valide.',
        'not'  => 'Le champ :label ne doit pas être une adresse e-mail valide.'
    ],
    /* OK */
    'equal'                   => [
        'must' => 'Le champ :label doit être égale à :value',
        'not'  => 'Le champ :label ne doit pas être égale à :value'
    ],
    'equal_strict'            => [
        'must' => 'Le champ :label doit être strictement égale à :value',
        'not'  => 'Le champ :label ne doit pas être strictement égale à :value'
    ],
    /* OK */
    'file'                    => [
        'must'        => 'Le fichier :label n\'est pas un fichier.',
        'not'         => 'Le fichier :label ne doit pas être un fichier.',
        'ini_size'    => 'La taille du fichier téléchargé excède la valeur de upload_max_filesize, configurée dans le php.ini',
        'form_size'   => 'La taille du fichier téléchargé excède la valeur de MAX_FILE_SIZE, qui a été spécifiée dans le formulaire HTML.',
        'err_partial' => 'Le fichier n\'a été que partiellement téléchargé.',
        'no_file'     => 'Aucun fichier n\'a été téléchargé.',
        'no_tmp_dir'  => 'Un dossier temporaire est manquant.',
        'cant_write'  => 'Échec de l\'écriture du fichier sur le disque.',
        'extension'   => 'Une extension PHP a arrêté l\'envoi de fichier.'
    ],
    'file_extensions'         => [
        'ext'     => 'L\'extensions du fichier :label doit être dans la liste suivante : :list.',
        'not_ext' => 'L\'extensions du fichier :label ne doit pas être dans la liste suivante : :list.'
    ],
    'file_mimes'              => [
        'mimes'     => 'L\extension doit correspond au minetype de :label',
        'not_mimes' => 'L\extension ne doit pas correspondre au minetype de :label'
    ],
    'file_mimetype'           => [
        'mimetype'     => 'Le fichier :label doit être dans la liste suivante : :list',
        'not_mimetype' => 'Le fichier :label ne doit pas être dans la liste suivante : :list'
    ],
    /* OK */
    'float'                   => [
        'must' => 'La valeur du champ :label doit être un nombre flottant.',
        'not'  => 'La valeur du champ :label ne doit pas être un nombre flottant.'
    ],
    'fontawesome'             => [
        'must' => 'Le :label doit correspondre pas aux styles de FontAwesome : :use_fonts.',
        'not'  => 'Le :label ne doit pas correspondre aux styles de FontAwesome : :use_fonts.'
    ],
    'image'                   => [
    ],
    'image_dimensions_height' => [
        'height'     => 'La hauteur de l\'image :label doit être comprise entre :min (px) et :max (px).',
        'not_height' => 'La hauteur de l\'image :label ne doit pas être comprise entre :min (px) et :max (px).'
    ],
    'image_dimensions_width'  => [
        'width'     => 'La largeur de l\'image :label doit être comprise entre :min (px) et :max (px).',
        'not_width' => 'La largeur de l\'image :label ne doit pas être comprise entre :min (px) et :max (px).'
    ],
    'inarray'                 => [
        'must' => 'La valeur du champ :label doit être dans la liste suivante : :list.',
        'not'  => 'La valeur du champ :label ne doit pas être dans la liste suivante : :list.'
    ],
    'int'                     => [
        'must' => 'La valeur du champ :label doit être un nombre entier.',
        'not'  => 'La valeur du champ :label ne doit pas être un nombre entier.'
    ],
    'instanceof'              => [
        'must' => 'Le champ :label doit être une instance de :class',
        'not'  => 'Le champ :label ne doit pas être une instance de :class'
    ],
    'class_exists'            => [
        'must' => 'Le champ :label doit être une classe :class définit.',
        'not'  => 'Le champ :label ne doit pas être une classe :class définit.'
    ],
    'ip'                      => [
        'must' => 'Le champ :label doit être une adresse :version valide.',
        'not'  => 'Le champ :label ne doit pas être une adresse :version valide.'
    ],
    'iterable'                => [
        'must' => 'Le champ :label doit être un objet itérable.',
        'not'  => 'Le champ :label ne doit pasêtre un objet itérable.'
    ],
    'json'                    => [
        'must' => 'Le champ :label doit être au format JSON.',
        'not'  => 'Le champ :label ne doit pas être au format JSON.'
    ],
    'max'                     => [
        'must' => 'Le champ :label ne doit pas être supérieur à :max.',
        'not'  => 'Le champ :label doit être supérieur à :max.'
    ],
    'max_numeric'             => [
        'size_numeric' => 'Le champ :label doit être numérique.'
    ],
    'min'                     => [
        'must' => 'Le champ :label ne doit pas être inférieur à :min.',
        'not'  => 'Le champ :label doit être inférieur à :min.'
    ],
    'min_numeric'             => [
        'size_numeric' => 'Le champ :label doit être numérique.'
    ],
    'null'                    => [
        'must' => 'Le champ :label doit être NULL.',
        'not'  => 'Le champ :label ne doit pas être NULL.',
    ],
    'numeric'                 => [
        'must' => 'Le champ :label doit être une valeur numérique.',
        'not'  => 'Le champ :label ne doit pas être une valeur numérique.'
    ],
    'regex'                   => [
        'must' => 'Le champ :label ne correspond pas à la règle de validation :regex',
        'not'  => 'Le champ :label ne doit pas correspondre à la règle de validation :regex'
    ],
    'required'                => [
        'must' => 'Le champ :label est requis.'
    ],
    'required_with'           => [
        'must' => 'Le champ :label est requis.'
    ],
    'required_with_all'       => [
        'must' => 'Le champ :label est requis.'
    ],
    'required_without'        => [
        'must' => 'Le champ :label est requis.'
    ],
    'required_without_all'    => [
        'must' => 'Le champ :label est requis.'
    ],
    'slug'                    => [
        'must' => 'Le champ :label doit contenir que des lettres, chiffres, tirets et anderscore.',
        'not'  => 'Le champ :label ne doit pas contenir que des lettres, chiffres, tirets et anderscore.'
    ],
    'string'                  => [
        'must' => 'Le champ :label doit être une chaine de caractères.',
        'not'  => 'Le champ :label ne doit pas être une chaine de caractères.'
    ],
    'token'                   => [
        'error'   => 'Une erreur est survenue.',
        'invalid' => 'Le token n\'est pas valide.',
        'time'    => 'Vous avez attendu trop longtemps, veilliez recharger la page.'
    ],
    'url'                     => [
        'must' => 'La valeur de :label doit être une URL valide.',
        'not'  => 'La valeur de :label ne doit pas être une URL valide.'
    ],
    'uuid'                    => [
        'must' => 'Le champ :label doit être accepté.',
        'not'  => 'Le champ :label ne doit pas être accepté.'
    ],
    'version'                 => [
        'must' => 'Le champ :label doit être une version semantic valide.',
        'not'  => 'Le champ :label ne doit pas être une version semantic valide.'
    ]
];
