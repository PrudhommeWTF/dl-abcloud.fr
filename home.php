<?php
/**
 * Created by JetBrains PhpStorm.
 * User: thomasprudhomme
 * Date: 12/08/13
 * Time: 18:31
 * To change this template use File | Settings | File Templates.
 */

include 'includes/sessionCheck.php';
include 'includes/header.php';
include 'includes/functions.php';
include 'includes/namesCheck.php';
?>
    <div class="col-lg-3">
        <ul class="nav nav-pills nav-stacked">
            <li class=""><a href="#"><span class="badge pull-right">2</span><span class="glyphicon glyphicon-share"></span> Vos Partages</a></li>
            <li class=""><a href="#"><span class="badge pull-right">42</span><span class="glyphicon glyphicon-gift"></span> Vos badges</a></li>
            <li class="divider"></li>
            <li class=""><a href="#">Jumbotron</a></li>
            <li class=""><a href="#">Page header</a></li>
        </ul>
    </div>
    <div class="col-lg-9">
        <?php
        //aknowledge url directory
        if(isset($_GET['dir'])){
            $tmpDir = urldecode($_GET['dir']);
            $dir = explode('/', $tmpDir);
            $currentFolder = 'directory/'.$data->userUID.'/'.$tmpDir;
            $cntFolder = count($dir);
        } else {
            $currentFolder = 'directory/'.$data->userUID;
            $cntFolder = 0;
        }

        //breadcrumb - where am I ?
        ?>
        <ol class="breadcrumb">
            <?php
            if(!isset($_GET['dir'])){
                echo '<li class="active"><span class="glyphicon glyphicon-home"></span> Votre espace</li>';
            } else {
                echo '<li><a href="/home.php" style="text-decoration: none"><span class="glyphicon glyphicon-home"></span></a></li>';
            }
            if($cntFolder > 0){
                $numFolder = 1;
                foreach($dir as $value){
                    ?>
                    <li <?php if($numFolder == $cntFolder) { echo 'class="active"'; } else { echo '><a href="?dir='.$value.'"'; }?>><?php echo $value; ?><?php if($numFolder !== $cntFolder){ echo '</a>'; } ?></li>
                    <?php
                    $numFolder ++;
                }
            }
            ?>
        </ol>
        <div class="well">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Actions</th>
                    <th>Nom</th>
                    <th>Type</th>
                    <th>Taille</th>
                    <th>Dernière modification</th>
                </tr>
                </thead>
                <tbody>
                <?php
                //list content of current directory
                $folderContent = listDir($currentFolder);
                asort($folderContent);
                $k = 0;
                foreach($folderContent as $element){
                    echo '<tr>';
                    switch($element['type']) {
                        case 'repertoire':
                            //création de l'url du sous dossier
                            //récupértaion de GET['dir']
                            if(!empty($_GET['dir'])){
                                $urlFolder = urlencode($_GET['dir'].'/'.$element['nom']);
                            } else {
                                $urlFolder = urlencode($element['nom']);
                            }
                            ?>
                            <td style="text-align: center;  vertical-align: middle">
                                <a href="?a=archive&f=<?php echo rawurlencode($currentFolder."/".$element['nom']); ?>" style="text-decoration: none;" title="Télécharcher une archive de ce dossier">
                                    <i class=" glyphicon glyphicon-download-alt"></i>
                                </a>
                            </td>
                            <td>
                                <img alt="repertoire" src="/assets/ico/folder.png" />
                                <a  href="?dir=<?php echo $urlFolder; ?>" style="vertical-align: middle; cursor: pointer"><?php echo normalizeString($element['nom']) ?></a>
                            </td>
                            <td style="vertical-align: middle"><span>Dossier de fichiers</span></td>
                            <td> </td>
                            <td> </td>
                            <?php
                            break;
                        default:
                            ?>
                            <td style="text-align: center;  vertical-align: middle">
                                <a href="./<?php echo $currentFolder."/".$element['nom.extension'] ; ?>" style="text-decoration: none;" download="<?php echo shortenString(normalizeString($element['nom.extension']), 66) ?>" title="Télécharger ce fichier">
                                    <i class="glyphicon glyphicon-download-alt"></i>
                                </a>
                                <a href="#myModalSuppr<?php echo $k; ?>" title="Supprimer ce fichier" style="text-decoration: none;" data-toggle="modal" data-target="#myModalSuppr<?php echo $k; ?>">
                                    <i class="glyphicon glyphicon-remove"></i>
                                </a>
                                <!-- Modal -->
                                <div id="myModalSuppr<?php echo $k; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel<?php echo $k; ?>" aria-hidden="true">
                                    <div class="modal-header">
                                        <h3 id="myModalLabel<?php echo $k; ?>">Suppression de fichier</h3>
                                    </div>
                                    <div class="modal-body">
                                        <div class="alert alert-danger">
                                            <strong>Attention !</strong>
                                            <p>Toute suppression est définitive, aucune restauration ne peut être effectée.</p>
                                        </div>
                                        <p>Confirmer la suppression du fichier <?php echo $element['nom.extension']; ?>.</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Annuler</button>
                                        <a class="btn btn-danger" href='?a=remove&f=<?php echo $currentFolder . "/" . $element['nom.extension'];
                                        ?>'>Supprimer</a>
                                    </div>
                                </div>
                                <script>
                                    $('#myModalSuppr<?php echo $k; ?>').modal({
                                        keyboard: false
                                    });
                                </script>
                                <a href="#myModalDepl<?php echo $k; ?>" title="Déplacer ce fichier" data-toggle="modal" data-target="#myModalDepl<?php echo $k; ?>">
                                    <i class="glyphicon glyphicon-share"></i>
                                </a>
                                <!-- Modal -->
                                <div id="myModalDepl<?php echo $k; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel<?php echo $k; ?>" aria-hidden="true">
                                    <div class="modal-header">
                                        <h3 id="myModalLabel<?php echo $k; ?>">Suppression de fichier</h3>
                                    </div>
                                    <div class="modal-body">
                                        <form class="form-horizontal" action="" method="GET">
                                            <input type="hidden" name="a" value="move">
                                            <?php
                                            if(isset($_GET['p'])){
                                                $file = rawurldecode($_GET['p']) . '/' . $element['nom.extension'];
                                            } else {
                                                $file = 'documents/' . $element['nom.extension'];
                                            }
                                            ?>
                                            <input type="hidden" name="f" value="<?php echo $file; ?>">
                                            <div class="control-group">
                                                <label class="control-label" for="d">Dossier de destination</label>
                                                <div class="controls">
                                                    <?

                                                    ?>
                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Annuler</button>
                                                <button type="submit" class="btn btn-primary">Déplacer</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <script>
                                    $('#myModalDepl<?php echo $k; ?>').modal({
                                        keyboard: false
                                    });
                                </script>
                            </td>
                            <td>
                                <?php
                                if($element['type'] == 'image'){
                                    ?>
                                    <a data-toggle="lightbox" href="#Lightbox<?php echo $k; ?>">
                                        <img alt="image" src="/assets/ico/<?php echo strtolower($element['extension']) ?>.png" />
                                        <?php echo shortenString(normalizeString($element['nom.extension']), 66) ?>
                                    </a>
                                    <!-- Lightbox -->
                                    <div id="Lightbox<?php echo $k; ?>" class="lightbox hide fade"  tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class='lightbox-header'>
                                            <button type="button" class="close" data-dismiss="lightbox" aria-hidden="true">&times;</button>
                                        </div>
                                        <div class='lightbox-content'>
                                            <img src="./<?php echo $currentFolder."/".$element['nom.extension'] ; ?>" style="max-width: 1471px; max-height: 418px;">
                                        </div>
                                    </div>
                                    <script>
                                        $('#Lightbox<?php echo $k; ?>').lightbox({
                                            backdrop: false
                                        });
                                    </script>
                                <?php
                                } else {
                                    ?>
                                    <img alt="fichier" src="/assets/ico/<?php echo strtolower($element['extension']) ?>.png" />
                                    <a style="vertical-align: middle" href="./<?php echo $currentFolder."/".$element['nom.extension'] ; ?>">
                                        <?php echo shortenString(normalizeString($element['nom']), 66) ?>
                                    </a>
                                <?php
                                }
                                ?>
                            </td>
                            <td style="vertical-align: middle">
                                <span><?php echo $knownExt[strtolower($element['extension'])]?></span>
                            </td>
                            <td style="vertical-align: middle">
                                <?php echo formatSize($element['taille']) ?>
                            </td>
                            <td style="vertical-align: middle">
                                <?php echo date('d/m/Y', $element['date']) ?>
                            </td>
                            <?php
                            break;
                    }
                    echo '</tr>';
                    $k++;
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
<?php
include 'includes/footer.php';
?>