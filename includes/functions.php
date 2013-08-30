<?php
function pwdValidator($password)
{
    if (strlen($password) >= 4)
        return true;
    else
        return false;
}

function mailValidator($mail)
{
    if (filter_var($mail, FILTER_VALIDATE_EMAIL) !== false)
        return true;
    else
        return false;
}

function shortenString($chaine, $max = 200)
{

    if (strlen($chaine) >= $max)
        $chaine = substr($chaine, 0, $max) . "...";

    return $chaine;

}

function normalizeString($chaine)
{

    if (mb_detect_encoding($chaine) === 'UTF-8')
        return $chaine;
    else
        return utf8_decode($chaine);

}

function getInfos($base, $entree, $type)
{

    $t_infos = array();

    switch ($type) {

        case 'repertoire':
            $t_infos = array(
                'type' => 'repertoire',
                'nom' => $entree,
                'date' => filemtime($base . "/" . $entree),
                'taille' => (int)filesize($base . "/" . $entree),
                'acces' => fileatime($base . "/" . $entree)
            );
            break;

        case 'fichier':
            switch (strtolower(pathinfo($base . "/" . $entree, PATHINFO_EXTENSION))) {
                case 'jpg':
                case 'jpeg':
                case 'png':
                case 'gif':
                    $infos_image = getimagesize($base . "/" . $entree);
                    $t_infos = array(
                        'type' => 'image',
                        'nom' => pathinfo($base . '/' . $entree, PATHINFO_FILENAME),
                        'extension' => pathinfo($base . '/' . $entree, PATHINFO_EXTENSION),
                        'nom.extension' => pathinfo($base . '/' . $entree, PATHINFO_BASENAME),
                        'mime' => $infos_image[2],
                        'taille' => (int)filesize($base . '/' . $entree),
                        'date' => filemtime($base . '/' . $entree),
                        'acces' => fileatime($base . '/' . $entree),
                        'largeur' => $infos_image[0],
                        'hauteur' => $infos_image[1],
                        'style' => $infos_image[3]
                    );
                    break;
                default:
                    $t_infos = array(
                        'type' => 'fichier',
                        'nom' => pathinfo($base . '/' . $entree, PATHINFO_FILENAME),
                        'extension' => pathinfo($base . '/' . $entree, PATHINFO_EXTENSION),
                        'nom.extension' => pathinfo($base . '/' . $entree, PATHINFO_BASENAME),
                        'taille' => (int)filesize($base . '/' . $entree),
                        'date' => filemtime($base . '/' . $entree),
                        'acces' => filemtime($base . '/' . $entree));
                    break;
            }
            break;

        case 'erreur':
            $return = array("type" => "erreur");
            break;

        default:
            $return = array("type" => "erreur");
            break;
    }

    return $t_infos;

}

function formatSize($taille)
{

    $t_unites = array('octets', 'Ko', 'Mo', 'Go', 'To');
    $i = 0;
    $nombre_a_afficher = 0;

    while ($taille >= 1) {
        $nombre_a_afficher = $taille;
        $taille /= 1024;
        $i++;
    }

    if (!$i) $i = 1;
    $d = explode(".", $nombre_a_afficher);
    if ($d[0] != $nombre_a_afficher) {
        $nombre_a_afficher = number_format($nombre_a_afficher, 2, ",", " ");
    }

    return $nombre_a_afficher . " " . $t_unites[$i - 1];

}

function listDir($repertoire_a_lister) {

    global $t_repertoires_sensibles, $t_fichiers_sensibles, $orderby;
    $t_repertoires = array();
    $t_fichiers = array();

    if (false !==($ressource = opendir($repertoire_a_lister))) {

        while (false !== ($entree = readdir($ressource)))  {

            if( is_dir($repertoire_a_lister."/".$entree) ) {
                if( !in_array($entree, $t_repertoires_sensibles) && !preg_match("/^\./", $entree) ) {
                    $t_repertoires[] = getInfos($repertoire_a_lister, $entree, 'repertoire');
                }
            }
            else {
                if( !in_array($entree, $t_fichiers_sensibles) )
                    $t_fichiers[] = getInfos($repertoire_a_lister, $entree, 'fichier');

            }

        }

        // fusion des 2 tableaux pour affichage
        $liste_du_repertoire = array_merge($t_repertoires, $t_fichiers);

        closedir($ressource);

    }
    //else die("pas de ressources");

    return $liste_du_repertoire;

}

function redirect($location) {

    if (!headers_sent()) {
        header("Location: " . $location);
    }
    else { ?>
        <script>
            document.location.href='<?php echo $location ?>';
        </script>
    <?php }

    die();

}
