<?php

namespace Fyryke;

/**
 * Micro-framework permettant le traitement d'image grace à un fichier de configuration
 *
 * @author mnoel
 */
class Styliser
{
    /**
     * Fichier de configuration.
     *
     * @var array
     */
    private $config_style = [];

    /**
     * Ensemble des problème intervenu dans le traitement de l'image.
     *
     * @var array
     */
    private $debug = [];

    /**
     * L'image source courante.
     *
     * @var ressource
     */
    private $img_src_resource;

    /**
     * Si $update_style est vrai alors les styles se mettent à jours.
     *
     * @var bool
     */
    private $update_style = false;

    private $anchor = [
        'top_left', 'top_middle', 'top_right',
        'middle_left', 'middle', 'middle_right',
        'bottom_left', 'bottom_middle', 'bottom_right'
    ];

    /**
     * @param string $config
     */
    public function __construct(array $config = [])
    {
        $this->debug = [
            'danger'  => [],
            'warning' => []
        ];

        $this->config_style = $config;
        $this->configCorrect($this->config_style);
    }

    /**
     * Ajoute une nouvelle configuration en plus de celle existante.
     *
     * @param array $config Configuration des styles d'image
     */
    public function addConfig(array $config)
    {
        array_push($config, $this->config_style);
    }

    /**
     * Permet de mettre à jour le style des images.
     */
    public function updateStyle()
    {
        $this->update_style = true;
    }

    /**
     * Vérifie si le schémat de donnée est conforme.
     *
     * @param array $config Tableau de configuration des styles d'image.
     *
     * @return bool
     */
    public function configCorrect(array $config)
    {
        foreach ($config as $styles) {
            if (!isset($styles[ 'name' ])) {
                /* Warnig ! pas de nom de style. */
            }
            /* Pour chaques style regarde les paramêtres (effets, format, quality) */
            if (isset($styles[ 'effets' ])) {
                foreach ($styles[ 'effets' ] as $values) {
                    if (!isset($values[ 'name' ])) {
                        $this->debug[ 'danger' ][] = 'Erreur ! votre effet ne porte pas de nom !';

                        continue;
                    }
                    if ($values[ 'name' ] === 'crop') {
                        if (isset($values[ 'width' ]) && !is_numeric($values[ 'width' ])) {
                            $this->debug[ 'danger' ][] = "Erreur ! Valeur de width doit être numérique pour mettre à l\'echelle !";
                        }
                        if (isset($values[ 'height' ]) && !is_numeric($values[ 'height' ])) {
                            $this->debug[ 'danger' ][] = "Erreur ! Valeur de height doit être numérique pour mettre à \'echelle !";
                        }
                        if (isset($values[ 'upscaling' ]) && !is_bool($values[ 'upscaling' ])) {
                            $this->debug[ 'danger' ][] = "Erreur ! Valeur d'agrandissement doit boolean pour mettre à \'echelle !";
                        }
                    } elseif ($values[ 'name' ] === 'scale') {
                        if (!isset($values[ 'width' ])) {
                            $this->debug[ 'danger' ][] = 'Erreur ! Valeur width doit être renseignée pour redimensionner !';
                        } elseif (!is_numeric($values[ 'width' ])) {
                            $this->debug[ 'danger' ][] = 'Erreur ! Valeur width doit être numérique pour redimensionner !';
                        }
                        if (!isset($values[ 'height' ])) {
                            $this->debug[ 'danger' ][] = 'Erreur ! Valeur height doit être renseignée pour redimensionner !';
                        } elseif (!is_numeric($values[ 'height' ])) {
                            $this->debug[ 'danger' ][] = 'Erreur ! Valeur height doit être numérique pour redimensionner !';
                        }
                    } elseif ($values[ 'name' ] === 'resize') {
                        if (!isset($values[ 'width' ])) {
                            $this->debug[ 'danger' ][] = 'Erreur ! Valeur width doit être renseignée pour recadrer!';
                        } elseif (!is_numeric($values[ 'width' ])) {
                            $this->debug[ 'danger' ][] = 'Erreur ! Valeur width doit être numérique pour recadrer !';
                        }
                        if (!isset($values[ 'height' ])) {
                            $this->debug[ 'danger' ][] = 'Erreur ! Valeur height doit être renseignée pour recadrer !';
                        } elseif (!is_numeric($values[ 'height' ])) {
                            $this->debug[ 'danger' ][] = 'Erreur ! Valeur height doit être numérique pour recadrer !';
                        }
                        if (isset($values[ 'anchor' ]) && !in_array($values[ 'anchor' ], $this->anchor)) {
                            $this->debug[ 'danger' ][] = 'Erreur ! Valeur "anchor" doit être correct pour recadrer !';
                        } else {
                            if (!isset($values[ 'x' ])) {
                                $this->debug[ 'danger' ][] = 'Erreur ! Valeur x doit être renseignée pour recadrer !';
                            } elseif (!is_numeric($values[ 'x' ])) {
                                $this->debug[ 'danger' ][] = 'Erreur ! Valeur x doit être numérique pour recadrer !';
                            }
                            if (!isset($values[ 'y' ])) {
                                $this->debug[ 'danger' ][] = 'Erreur ! Valeur de y doit être renseignée pour le recadrer!';
                            } elseif (!is_numeric($values[ 'y' ])) {
                                $this->debug[ 'danger' ][] = 'Erreur ! Valeur y doit être numérique pour recadrer !';
                            }
                        }
                    }
                }
            } else {
                /* Warnig ! Aucun effets existes pour le style (reveras l'image d'origine) */
            }
            if (!isset($values[ 'format' ])) {
                /* Warning ! Aucun format de sortie existe (revera le format d'origine) */
            }
            if (!isset($values[ 'quality' ])) {
                /* Warning ! Aucune qualité de sortie existe (revera une quality de 100%) */
            }
        }

        return empty($this->debug[ 'danger' ]);
    }

    /**
     * Réalise une operation sur une image (recadrage, redimentionnement...).
     *
     * @param string $srcImage Chemin de l'image à traiter.
     * @param string $style    Nom du style à opérer sur l'image.
     *
     * @return string chemin de la nouvelle image n cas de succès ou le chemin de l'image d'origine si une erreur survient.
     */
    public function getImage($srcImage, $style)
    {
        $config = $this->config_style;

        /* Vérifie si la configuration est correte. */
        if (empty($this->debug[ 'danger' ])) {
            /* Si l'image existe. */
            if (!file_exists($srcImage)) {
                $this->debug[ 'danger' ][] = 'Le fichier "' . $srcImage . '" est non existant';
            }
            /* Si le style de l'image existe dans la config. */
            if (!isset($config[ $style ])) {
                $this->debug[ 'danger' ][] = 'Le style "' . $style . '" est non existant';
            }
        }

        if (empty($this->debug[ 'danger' ])) {

            /* Gestion des dossiers d'enregistrements. */
            if (isset($config[ $style ][ 'out' ])) {
                /* Par la sortie prévus. */
                $out_folder = $this->config_style[ $style ][ 'out' ];
            } else {
                /* Sortie non prévu (key du style). */
                $out_folder = $style;
                if (isset($config[ $style ][ 'name' ])) {
                    /* Sortie non prévus (nom du style). */
                    $out_folder = $config[ $style ][ 'name' ];
                }
            }
            if (!file_exists($out_folder)) {
                mkdir($out_folder, 0775);
            }

            $nameImage = strtolower($this->getFileName($srcImage));
            $format    = isset($config[ $style ][ 'format' ])
                ? $config[ $style ][ 'format' ]
                : $this->getFileExtension($srcImage);

            /* Si un fichier existe en chemin de sortie. */
            if (!file_exists("$out_folder/$nameImage.$format") or $this->update_style) {
                $img_dst_ressource = $this->createNewImage($srcImage, $style);

                /* Vérifions tout d'abord que nous pouvons enregistrer le fichier. */
                $this->saveImageRessource($img_dst_ressource, $out_folder, $nameImage, $format);
            }
            $srcImage = "$out_folder/$nameImage.$format";
        }

        return $srcImage;
    }

    /**
     * @param string $path_file Chemin d'un fichier
     *
     * @return string Uniquement le nom du fichier (sans l'extension ni le chemin)
     */
    public function getFileName($path_file)
    {
        return strchr(basename($path_file), '.', true);
    }

    /**
     * @param string $path_file Chemin d'un fichier
     *
     * @return string Extension du fichier.
     */
    public function getFileExtension($path_file)
    {
        return strtolower(pathinfo($path_file, PATHINFO_EXTENSION));
    }

    /**
     * Réalise un redimentionnement sur une image (attention risque de déformation).
     *
     * @param resource $img_src Identifiant de ressource d'image.
     * @param int      $width   Largeur du redimentionnement.
     * @param int      $height  Lauteur du redimentionnement.
     *
     * @return resource|bool Identifiant de ressource d'image en cas de succès ou FALSE si une erreur survient.
     */
    public function scale($img_src, $width, $height)
    {
        $src_w = imagesx($img_src);
        $src_h = imagesy($img_src);

        $img_dst = imagecreatetruecolor($width, $height);
        imagealphablending($img_dst, false);
        imagesavealpha($img_dst, true);

        $result = imagecopyresampled($img_dst, $img_src, 0, 0, 0, 0, $width, $height, $src_w, $src_h);

        return $result
            ? $img_dst
            : false;
    }

    /**
     * Réalise un recadrage sur une image à partir d'une ancre.
     *
     * @param resource $img_src Identifiant de ressource d'image.
     * @param int      $anchor  Coordonnées du point source.
     * @param int      $width   Largeur du redimentionnement.
     * @param int      $height  Lauteur du redimentionnement.
     *
     * @return resource|bool Identifiant de ressource d'image en cas de succès ou FALSE si une erreur survient.
     */
    public function scaleAnchor($img_src, $anchor, $width, $height)
    {
        $src_w = imagesx($img_src);
        $src_h = imagesy($img_src);

        $y = $x = 0;
        if ($anchor == 'top_middle') {
            $x = ($src_w / 2) - ($width / 2);
        } elseif ($anchor == 'top_right') {
            $x = $src_w - $width;
        } elseif ($anchor == 'middle_left') {
            $y = ($src_h / 2) - ($height / 2);
        } elseif ($anchor == 'middle') {
            $x = ($src_w / 2) - ($width / 2);
            $y = ($src_h / 2) - ($height / 2);
        } elseif ($anchor == 'middle_right') {
            $x = $src_w - $width;
            $y = ($src_h / 2) - ($height / 2);
        } elseif ($anchor == 'bottom_left') {
            $y = $src_h - $height;
        } elseif ($anchor == 'bottom_middle') {
            $x = ($src_w / 2) - ($width / 2);
            $y = $src_h - $height;
        } elseif ($anchor == 'bottom_right') {
            $x = $src_w - $width;
            $y = $src_h - $height;
        }

        $img_dst = imagecreatetruecolor($width, $height);
        imagealphablending($img_dst, false);
        imagesavealpha($img_dst, true);

        $result = imagecopyresampled($img_dst, $img_src, 0, 0, $x, $y, $width, $height, $width, $height);

        return $result
            ? $img_dst
            : false;
    }

    /**
     * Réalise un recadrage sur une image.
     *
     * @param resource $img_src
     * @param int      $x       Coordonnées du point source.
     * @param int      $y       Coordonnées du point source.
     * @param int      $width   Largeur du redimentionnement.
     * @param int      $height  Hauteur du redimentionnement.
     *
     * @return resource|bool Identifiant de ressource d'image en cas de succès ou FALSE si une erreur survient.
     */
    public function resize($img_src, $x, $y, $width, $height)
    {
        $img_dst = imagecreatetruecolor($width, $height);
        imagealphablending($img_dst, false);
        imagesavealpha($img_dst, true);

        $result = imagecopyresampled($img_dst, $img_src, 0, 0, $x, $y, $width, $height, $width, $height);

        return $result
            ? $img_dst
            : false;
    }

    /**
     * Réalise une mise à l'echelle sur une image.
     *
     * @param resource $img_src   Identifiant de ressource d'image.
     * @param int      $width     Largeur du redimentionnement.
     * @param int      $height    Hauteur du redimentionnement.
     * @param bool     $upscaling Agrendissement autorisé.
     *
     * @return type Identifiant de ressource d'image en cas de succès ou FALSE si une erreur survient.
     */
    public function crop(
        $img_src,
        $width = null,
        $height = null,
        $upscaling = false
    ) {
        $src_w = imagesx($img_src);
        $src_h = imagesy($img_src);

        if ($width === null && $height === null) {
            $width  = $src_w;
            $height = $src_h;
        } elseif ($width !== null && $height === null) {
            $height = $src_h / ($src_w / $width);
        } elseif ($width === null && $height !== null) {
            $width = $src_w / ($src_h / $height);
        } else {
            $height = $src_h / ($src_w / $width);
        }
        /* Peu importe si h ou w, si il y a agrandissement les 2 valeur changerons. */
        if (($height > $src_h) && !$upscaling) {
            $width  = $src_w;
            $height = $src_h;
        }

        $img_dst = imagecreatetruecolor($width, $height);
        imagealphablending($img_dst, false);
        imagesavealpha($img_dst, true);

        $result = imagecopyresampled($img_dst, $img_src, 0, 0, 0, 0, $width, $height, $src_w, $src_h);

        return $result
            ? $img_dst
            : false;
    }

    /**
     * Créer une image nouvelle image source à partir de l'extension de l'image donnée.
     *
     * @param string $filename Chemin de l'image
     *
     * @return resource|bool Identifiant de ressource d'image en cas de succès ou FALSE si une erreur survient.
     */
    public function getImageRessource($filename)
    {
        switch ($this->getFileExtension($filename)) {
            case 'jpg':
            case 'jpeg':
                return imagecreatefromjpeg($filename);

            case 'gif':
                return imagecreatefromgif($filename);

            case 'png':
                return imagecreatefrompng($filename);
        }

        return false;
    }

    /**
     * Créer une image nouvelle image source à partir de l'extension de l'image donnée.
     *
     * @param resource $img_dst Chemin de l'image.
     * @param string   $path    Chemin de l'image.
     * @param string   $name    Nom de l'image.
     * @param string   $ext     Extension de l'image.
     *
     * @return resource|bool Identifiant de ressource d'image en cas de succès ou FALSE si une erreur survient.
     */
    public function saveImageRessource($img_dst, $path, $name, $ext)
    {
        switch ($ext) {
            case 'jpg':
            case 'jpeg':
                $result = imagejpeg($img_dst, "$path/$name.$ext");
                imagedestroy($img_dst);

                break;
            case 'png':
                $result = imagepng($img_dst, "$path/$name.$ext");
                imagedestroy($img_dst);

                break;
            case 'gif':
                $result = imagegif($img_dst, "$path/$name.$ext");
                imagedestroy($img_dst);

                break;
            default:
                $result = false;

                break;
        }

        return $result;
    }

    /**
     * Réalise un redimentionnement sur une image (attention risque de déformation).
     *
     * @param string $srcImage Chemin de l'image à traiter.
     * @param string $style    Style d'image à opérer sur l'image.
     *
     * @return resource
     */
    private function createNewImage($srcImage, $style)
    {
        /* /* Parse le tableau de configuation. */
        $param   = $this->config_style[ $style ];
        $img_dst = $this->getImageRessource($srcImage);

        foreach ($param[ 'effets' ] as $effet) {
            /* Parcour le tableau d'effet pour les executer en fonction de l'odre de la configuration. */
            if ($effet[ 'name' ] == 'scale') {
                $img_dst = $this->scale($img_dst, $effet[ 'width' ], $effet[ 'height' ]);
            }
            /* Verifie si le style comprend l'effet de recadrement. */
            if ($effet[ 'name' ] == 'resize') {
                if (isset($effet[ 'anchor' ])) {
                    $img_dst = $this->scaleAnchor($img_dst, $effet[ 'anchor' ], $effet[ 'width' ], $effet[ 'height' ]);
                } else {
                    $img_dst = $this->resize($img_dst, $effet[ 'x' ], $effet[ 'y' ], $effet[ 'width' ], $effet[ 'height' ]);
                }
            }
            /* Verifie si le style comprend l'effet d'echelle. */
            if ($effet[ 'name' ] == 'crop') {
                $w       = isset($effet[ 'width' ])
                    ? $effet[ 'width' ]
                    : null;
                $h       = isset($effet[ 'height' ])
                    ? $effet[ 'height' ]
                    : null;
                $a       = isset($effet[ 'upscaling' ])
                    ? $effet[ 'upscaling' ]
                    : false;
                $img_dst = $this->crop($img_dst, $w, $h, $a);
            }
        }

        return $img_dst;
    }
}
