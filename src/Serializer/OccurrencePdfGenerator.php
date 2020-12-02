<?php


namespace App\Serializer;

/**
 * Classe permettant de générer des PDFs.
 *
 * @internal   Mininum PHP version : 5.2
 * @category   CEL
 * @package    Services
 * @subpackage Bibliothèques
 * @version    0.1
 * @author     Mathias CHOUET <mathias@tela-botanica.org>
 * @author     Raphaël Droz <raphael@tela-botania.org>
 * @author     Jean-Pascal MILCENT <jpm@tela-botanica.org>
 * @author     Aurelien PERONNET <aurelien@tela-botanica.org>
 * @license    GPL v3 <http://www.gnu.org/licenses/gpl.txt>
 * @license    CECILL v2 <http://www.cecill.info/licences/Licence_CeCILL_V2-en.txt>
 * @copyright  1999-2014 Tela Botanica <accueil@tela-botanica.org>
 */

require_once __DIR__.'/../../vendor/tecnickcom/tcpdf/tcpdf.php';
require_once __DIR__.'/../../vendor/tecnickcom/tcpdf/config/tcpdf_config.php';

use TCPDF;

Class OccurrencePdfGenerator {

        public $pdf;

        function __construct($utilisateur = NULL) {
                // create new PDF document
                $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

                // set document information
                $pdf->SetCreator(PDF_CREATOR);
                $pdf->SetAuthor($utilisateur ? $utilisateur['prenom'] . ' ' . $utilisateur['nom'] : 'CEL - Tela Botanica');
                $pdf->SetTitle('Observations en étiquettes');
                $pdf->SetSubject('Étiquettes des observations');
                $pdf->SetKeywords('botaniques, observations, étiquettes, cel, tela-botanica');

                $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

                // set margins
                $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
                $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
                $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

                $pdf->SetAutoPageBreak(FALSE, PDF_MARGIN_BOTTOM);

                $pdf->SetFont('times', '', 9);
                $pdf->setCellPaddings(1, 1, 1, 1);
                $pdf->setCellMargins(1, 1, 1, 1);

                $pdf->AddPage();
                $pdf->setEqualColumns(2);

                $this->pdf = $pdf;
        }

        public function export($obs) {
                $pdf = &$this->pdf;

                $i = 0;
                while($i < count($obs)) {
                        $pdf->selectColumn(0);
                        // Multicell test
                        $this->doHTMLcell($obs[$i++]); if(!isset($obs[$i])) break;
                        $pdf->Ln();
                        $this->doHTMLcell($obs[$i++]);  if(!isset($obs[$i])) break;
                        $pdf->Ln();
                        $this->doHTMLcell($obs[$i++]); if(!isset($obs[$i])) break;
                        /*$pdf->MultiCell(0, 25, self::doTemplate($obs), 1, 'L', 1, 1, '', '', true);
                          $pdf->MultiCell(0, 25, self::doTemplate($obs), 1, 'L', 1, 1, '', '', true);*/

                        $pdf->selectColumn(1);
                        $this->doHTMLcell($obs[$i++]); if(!isset($obs[$i])) break;
                        $pdf->Ln();
                        $this->doHTMLcell($obs[$i++]); if(!isset($obs[$i])) break;
                        $pdf->Ln();
                        $this->doHTMLcell($obs[$i++]); if(!isset($obs[$i])) break;
                        /*$pdf->MultiCell(0, 25, self::doTemplate($obs), 1, 'L', 0, 1, '', '', true);
                        $pdf->MultiCell(0, 25, self::doTemplate($obs), 1, 'L', 0, 1, '', '', true);
                        $pdf->MultiCell(0, 25, self::doTemplate($obs), 1, 'L', 0, 1, '', '', true);*/

                        if(isset($obs[$i])) $pdf->AddPage();
                }
        }

        function getlinenb4($txt) {
                // store current object
                $this->pdf->startTransaction();
                // store starting values
                $start_y = $this->pdf->GetY();
                $start_page = $this->pdf->getPage();

                $this->pdf->MultiCell($this->column_width, $h=0, $txt, $border=0, $align='L', $fill=false, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0);
                $end_y = $this->pdf->GetY();
                $end_page = $this->pdf->getPage();
                // calculate height
                $height = 0;
                if ($end_page == $start_page) {
                        $height = $end_y - $start_y;
                } else {
                        for ($page=$start_page; $page <= $end_page; ++$page) {
                                $this->setPage($page);
                                if ($page == $start_page) {
                                        // first page
                                        $height = $this->pdf->h - $start_y - $this->pdf->bMargin;
                                } elseif ($page == $end_page) {
                                        // last page
                                        $height = $end_y - $this->pdf->tMargin;
                                } else {
                                        $height = $this->pdf->h - $this->pdf->tMargin - $this->bMargin;
                                }
                        }
                }
                // restore previous object
                $this->pdf = $this->pdf->rollbackTransaction();
                return $height;
        }

        function getlinenb3($txt) {
                return $this->pdf->getStringHeight($this->column_width, $txt);
        }

        function getlinenb2($txt) {
                //var_dump($line, $this->pdf->GetStringWidth($line));
                return ceil($this->pdf->GetStringWidth($txt)  / $this->column_width);
        }

        function getlinenb($txt) {
                return $this->pdf->getStringHeight('', $txt) / ($this->pdf->getFontSize() * $this->pdf->getCellHeightRatio());
        }

        // singe la propriété CSS3 "text-overflow" : "ellipsis"
        function elude($txt, $limite_lignes = 3) {
                // echo strlen($txt) . ' '.  $this->getlinenb($txt) . ' ' . $limite_lignes . "\n";

                $cell_paddings = $this->pdf->getCellPaddings();
                $marge = $cell_paddings['T'] + $cell_paddings['B'];
                $line_height = $this->pdf->getStringHeight($this->column_width, "a") - $marge;
                if($limite_lignes > 1) {
                        $lim = $line_height * $limite_lignes + $marge; // $line_height + ($line_height - $marge) * ($limite_lignes - 1);
                } else {
                        $lim = $line_height + $marge;
                }

                while(strlen($txt) > 4 && ($nb = $this->getlinenb3(strip_tags($txt))) > $lim) {
                        //echo "$nb / $line_height: $txt\n";
                        // TODO: mb_internal_encoding()
                        $txt = mb_substr($txt, 0, -4, 'UTF-8') . '…';
                }
                //echo "$txt: $nb / $limite_lignes \n";
                return $txt;
        }


        // TODO: affichage pays dans "localité"
        // ORDER BY id_observation
        // italique pour nom d'espèce, mais pas auteur
        function doHTMLcell(&$obs) {
                $this->pdf->setCellMargins(0,0,0,0);
                $width = $this->column_width = 88;

                //echo "cell_padding['T']: " . $this->pdf->getCellPaddings()['T'] . ", cell_padding['B']: " . $this->pdf->getCellPaddings()['B'] . "\n";

                $lh = $this->pdf->getFontSize() * $this->pdf->getCellHeightRatio();
                //$lh = $this->pdf->GetLineWidth();

                /*
                var_dump($this->pdf->GetLineWidth(),
                                 $this->pdf->GetCharWidth("a"),
                                 $this->pdf->getStringHeight(60, "Ê"),
                                 $this->pdf->getHTMLFontUnits("plop"),
                                 $this->pdf->GetStringWidth("aa"),
                                 $lh,

                                 5,
                                 $this->getlinenb4("Observation : Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum..."),
                                 $this->elude("Observation : Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum...", 5),

                                 4,
                                 $this->getlinenb4("Observation : Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor"),
                                 $this->elude("Observation : Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum...", 4),

                                 3,
                                 $this->getlinenb4("Observation : Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet"),
                                 $this->elude("Observation : Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum...", 3),

                                 2,
                                 $this->getlinenb4("Observation : Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore"),
                                 $this->elude("Observation : Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum...", 2),

                                 1,
                                 $this->getlinenb4("Observation : Lorem ipsum dolor sit amet, consectetur"),
                                 $this->elude("Observation : Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum...", 1)
                );
                die;
                */


                /*              $str = '<strong>Observation</strong> : ' . $obs['commentaire'];
                echo $this->getlinenb(strip_tags($str)) . "\n";
                echo $this->getlinenb2(strip_tags($str)) . "\n";
                echo $this->pdf->getStringHeight($width, strip_tags($str)) . "\n";
                echo $this->pdf->getStringHeight($width, "a") . "\n";
                echo ( $this->pdf->getStringHeight($width, strip_tags($str)) / $this->pdf->getStringHeight($width, "a")) . "\n";

                die;*/

                // 3ème paramètre = '' equivalent à $this->pdf->getX()
                // 4ème paramètre = '' equivalent à $this->pdf->getY()

                // référentiel
                /* $this->pdf->writeHTMLCell($w = $width, '', '', '',
                                                                  $html = '<strong>Référentiel</strong> : ' . $obs['nom_referentiel'],
                                                                  $border = 'LTR', $ln = 1, $fill = false, $reset = true, $align = 'L', $autopadding = true); */

                // famille
                $this->pdf->writeHTMLCell($w = $width, '', '', '',
                                                                  $html = '<strong>Famille</strong> : ' . strtoupper($obs['family']),
                                                                  $border = 'LTR', $ln = 1, $fill = false, $reset = true, $align = 'L', $autopadding = true);


                /*
                // taxon
                // la taille maximum en bdtfx est 115 caractères UTF-8 (num_nom: 101483)
                // SELECT num_nom, CONCAT(nom_sci, ' ', auteur) AS a, CHAR_LENGTH(CONCAT(nom_sci, ' ', auteur)) FROM bdtfx_v1_01 ORDER BY CHAR_LENGTH(a) DESC limit 2;
                $nom = '<em>' . $obs['nom_ret'] . '</em>';
                if($obs['certainty'] && stripos($obs['certainty'], 'certain') === false) {
                        $nom .= ' (' . $obs['certainty'] . ')';
                }
                $this->pdf->writeHTMLCell($w = $width, $lh * 3.5, '',  '',
                                                                  //$html = '<strong>Espèce</strong> : ' . self::elude('Espèce : ', $obs['nom_ret'], 2),
                                                                  //$html = $this->elude('<strong>Taxon</strong> : ' . $nom, 3),
                                                                  $html = '<strong>Taxon</strong> : ' . $nom, // on ne strip pas le nom de taxon, car pas plus de 3 lignes
                                                                  $border = 'LR', $ln = 1, $fill = false, $reset = true, $align = 'L', $autopadding = true);
                */

                // ou bien nom saisi...
                // la taille maximum dans cel_obs au 12/07/2013 est 112 caractères UTF-8 (id_observation: 787762)
                // SELECT id_observation, TRIM(nom_sel), CHAR_LENGTH(TRIM(nom_sel)) FROM cel_obs ORDER BY CHAR_LENGTH(TRIM(nom_sel)) DESC LIMIT 2;
                $nom = '<em>' . $obs['userSciName'] . '</em>';
                if($obs['certainty'] && stripos($obs['certainty'], 'certain') === false) {
                        $nom .= ' (' . $obs['certainty'] . ')';
                }
                $this->pdf->writeHTMLCell($w = $width, $lh * 3.5, '',  '',
                                                                  //$html = '<strong>Espèce</strong> : ' . self::elude('Espèce : ', $obs['nom_ret'], 2),
                                                                  //$html = $this->elude('<strong>Taxon</strong> : ' . $nom, 3),
                                                                  $html = '<strong>Taxon</strong> : ' . mb_substr(trim($nom), 0, 115, 'UTF-8'), // on ne strip pas le nom sélectionné, car pas plus de 3 lignes, mais on assure la mise en page
                                                                  $border = 'LR', $ln = 1, $fill = false, $reset = true, $align = 'L', $autopadding = true);

                // collecteur
                // TODO: pseudo
                $limite_nom = 26;
                $pseudo = $obs['userPseudo'];
                $this->pdf->writeHTMLCell($w = $width - 25, '', '', '',
                                                                  $html = '<strong>Collecteur</strong> : ' . $pseudo,
                                                                  $border = 'L', $ln = 0, $fill = false, $reset = true, $align = 'L', $autopadding = true);

                // N°: TODO: writeHTMLCell() semble bugger
                $this->pdf->Cell($w = 25, '',
                                                 $txt = 'N° : ' . $obs['id'], //. sprintf("%04d", $obs['ordre'])
                                                 $border = 'R', $ln = 1, $align = 'R', $fill = false, $link = false, $stretch = 1, $ignore_min_height = false, $calign = 'T', $valign = 'M');
                /*$this->pdf->writeHTMLCell($w = 30, '', '', '',
                                                                  $html = '<strong>N°</strong> : ' . $obs['id_observation'], //. sprintf("%04d", $obs['ordre']),
                                                                  $border = 'R', $ln = 1, $fill = true, $reset = true, $align = 'L', $autopadding = true);*/

                // localité
                // TODO: département
                // TEST: Corse (2A, 2B)
                $info_dep = "<strong>Localité</strong> : %s";

//                $donnees_dep = array($obs['zone_geo']);
//                if($obs['ce_zone_geo']) {
//                        $info_dep .= " (%s)";
//                        if(strpos($obs['ce_zone_geo'], 'INSEE') !== false) $donnees_dep[] = preg_replace('/^[^\d]*(\d\d).*/', '\1', $obs['ce_zone_geo']);
//                        else $donnees_dep[] = $obs['ce_zone_geo'];
//                }

                $info_loc = '';
                $donnees_loc = array();
                if($obs['locality']) {
                        $info_loc = "%s";
                        $donnees_loc[] = $obs['locality'];
                }

                if($obs['sublocality']) {
                        $info_loc = "%s";
                        $donnees_loc[] = $obs['sublocality'];
                }
                if($obs['station']) {
                        $info_loc .= ", %s";
                        $donnees_loc[] = $obs['station'];
                }
                if($obs['environment']) {
                        $info_loc .= " [%s]";
                        $donnees_loc[] = $obs['environment'];
                }
                $this->pdf->writeHTMLCell($w = $width, $lh * 3.5, '', '',
                                                                  //$html = "<strong>Localité</strong> : " .
                                                                  //self::elude('Localité : ', sprintf("%s (%s)\n%s, %s [%s]", $obs['zone_geo'], $obs['ce_zone_geo'], $obs['lieudit'], $obs['station'], $obs['milieu'] ), 3),
                                                                  // $html = self::elude(sprintf("<strong>Localité</strong> : %s (%s)\n%s, %s [%s]", $obs['zone_geo'], $obs['ce_zone_geo'], $obs['lieudit'], $obs['station'], $obs['milieu']), 3),
                                                                  $html = "<strong>Localité</strong> : " .
                                                                  $this->elude(vsprintf($info_loc, $donnees_loc), 2),
                                                                  $border = 'LR', $ln = 1, $fill = false, $reset = true, $align = 'L', $autopadding = true);




                // lon/lat/alt
                $info_geo = '';
                $donnees = array();
                if($obs['latitude'] && $obs['longitude'] /* TODO: clean DB ! */ && $obs['latitude'] != 0.00000) {
                        $info_geo .= "%.5f N  /  %.5f E";
                        array_push($donnees, $obs['latitude'], $obs['longitude']);
                }
                if($obs['elevation']) {
                        $info_geo .= ", %dm";
                        array_push($donnees, $obs['elevation']);
                }
                $this->pdf->writeHTMLCell($w = $width, '', '', '',
                                                                  $html = vsprintf("<strong>Lat. / Lon. , Alt.</strong> : " . $info_geo, $donnees),
                                                                  $border = 'LR', $ln = 1, $fill = false, $reset = true, $align = 'L', $autopadding = true);

                // commentaire
                $this->pdf->writeHTMLCell($w = $width, $lh * 4.5, '', '',
                                                                  //$html = '<strong>Observation</strong> : ' . self::elude('Observation : ', $obs['commentaire']),
                                                                  $html = self::elude('<strong>Observations</strong> : ' . $obs['annotation'], 4),
                                                                  $border = 'LR', $ln = 1, $fill = false, $reset = true, $align = 'L', $autopadding = true);

/*
                // date, note: en 64 bits, strtotime() renvoi un entier négatif (!= FALSE) pour l'an 0
                if(strncmp("0000", $obs['dateObserved'], 4) == 0) $temps = false;
                else $temps = strtotime($obs['dateObserved']);
*/
                $this->pdf->writeHTMLCell($w = $width, '', '', '',
                                                                  $html = '<strong>Date de récolte</strong> : ' . ($obs['dateObserved'] ? date_format($obs['dateObserved'], 'd-m-Y H:i:s'): '               '),
                                                                  $border = 'LBR', $ln = 1, $fill = false, $reset = true, $align = 'R', $autopadding = true);

        }

        function docell($obs) {
                $this->pdf->setCellMargins(0,0,0,0);

                $this->pdf->Cell($w = 60, '',
                                                 $txt = 'Famille : ' . $obs['famille'],
                                                 $border = 'LT', $ln = 0, $align = 'L', $fill = false, $link = false, $stretch = 1, $ignore_min_height = false, $calign = 'T', $valign = 'M');

                $this->pdf->Cell($w = 20, '',
                                                 $txt = 'N° : ' . $obs['id_observation'] /*. sprintf("%04d", $obs['ordre']) */,
                                                 $border = 'TR', $ln = 1, $align = 'L', $fill = false, $link = false, $stretch = 1, $ignore_min_height = false, $calign = 'T', $valign = 'M');

                $this->pdf->Cell($w = 80, '',
                                                 $txt = 'Espèce : ' . $obs['nom_ret'],
                                                 $border = 'RL', $ln = 1, $align = 'L', $fill = false, $link = false, $stretch = 1, $ignore_min_height = false, $calign = 'T', $valign = 'M');

                $this->pdf->Cell($w = 80, '',
                                                 $txt = 'Collecteur : ' . $obs['prenom_utilisateur'] . ' ' . $obs['nom_utilisateur'],
                                                 $border = 'RL', $ln = 1, $align = 'L', $fill = false, $link = false, $stretch = 1, $ignore_min_height = false, $calign = 'T', $valign = 'M');

                $this->pdf->MultiCell(80, 20,
                                                          $txt = sprintf("Localité : %s (%s)\n%s, %s", $obs['zone_geo'], $obs['ce_zone_geo'], $obs['lieudit'], $obs['station']),
                                                          $border = 'RL', 'L', 0, 1, '', '', true);

                $this->pdf->Cell($w = 80, '',
                                                 $txt = sprintf("Latitude, Longitude : %s  /  %s", $obs['latitude'], $obs['longitude']),
                                                 $border = 'RL', $ln = 1, $align = 'L', $fill = false, $link = false, $stretch = 1, $ignore_min_height = false, $calign = 'T', $valign = 'M');

                $this->pdf->MultiCell(80, 20,
                                                          $txt = 'Observation : ' . self::elude('Observation : ', $obs['commentaire']),
                                                          $border = 'RL', 'L', 0, 1, '', '', true);

                $this->pdf->Cell($w = 80, '',
                                                 $txt = 'Date : ' . strftime("%d/%m/%Y", strtotime($obs['date_observation'])),
                                                 $border = 'LBR', $ln = 1, $align = 'R', $fill = false, $link = false, $stretch = 1, $ignore_min_height = false, $calign = 'T', $valign = 'M');
        }


        // singe la propriété CSS3 "text-overflow" : "ellipsis"
        function elude_bis($intitule, $commentaire, $lignes = 3) {
                // TODO: GetLineWidth, GetCharWidth()
                $limite = $lignes /* lignes */ * 43 /* caractères */ - strlen($intitule);
                if(mb_strlen($commentaire, 'UTF-8') < $limite) return $commentaire;
                return mb_substr($commentaire, 0, $limite - 2) . '…';
        }


        function export1($observations) {
                $pdf = &$this->pdf;
                // MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)

                $pdf->setEqualColumns(2);

                $i = 0;
                while($i < count($observations)) {
                        $obs = $observations[$i];

                        $pdf->selectColumn(0);
                        // Multicell test
                        $pdf->MultiCell(0, 25, self::doTemplate($obs), 1, 'L', 1, 1, '', '', true);
                        $pdf->MultiCell(0, 25, self::doTemplate($obs), 1, 'L', 1, 1, '', '', true);
                        $pdf->MultiCell(0, 25, self::doTemplate($obs), 1, 'L', 1, 1, '', '', true);
                        $pdf->Ln();

                        $pdf->selectColumn(1);
                        $pdf->MultiCell(0, 25, self::doTemplate($obs), 1, 'L', 0, 1, '', '', true);
                        $pdf->MultiCell(0, 25, self::doTemplate($obs), 1, 'L', 0, 1, '', '', true);
                        $pdf->MultiCell(0, 25, self::doTemplate($obs), 1, 'L', 0, 1, '', '', true);

                        $i += 6;
                        if(isset($observations[$i])) $pdf->AddPage();
                }
        }

        static function doTemplate($obs) {
                $pattern =
<<<EOF
Famille: %s (%d)
Espèce: %s
Collecteur: %s
Localité: %s
Observation: %s  Date: %s
EOF;
                return sprintf($pattern,

                                           $obs['famille'],
                                           $obs['ordre'],
                                           $obs['nom_ret'],
                                           $obs['prenom_utilisateur'] . ' ' . $obs['nom_utilisateur'],
                                           $obs['zone_geo'],
                                           $obs['commentaire'],
                                           strftime("%Y-%m-%d", strtotime($obs['date_observation']))
                );

        }



        function export2($observations) {
                $pdf = &$this->pdf;

                $pdf->setEqualColumns(2);

                $i = 0;
                $y = $pdf->getY();
                $x = $pdf->getX();
                while($i < count($observations)) {
                        $obs = $observations[$i++];

                        $pdf->selectColumn(0);
                        // Multicell test
                        $pdf->writeHTMLCell(0, 25, $x, $y + 25 * 0, self::doHTMLTemplate($obs), 1, 0, 0, true);
                        $pdf->writeHTMLCell(0, 25, $x, $y + 25 * 1, self::doHTMLTemplate($obs), 1, 0, 0, true);
                        $pdf->writeHTMLCell(0, 25, $x, $y + 25 * 2, self::doHTMLTemplate($obs), 1, 0, 0, true);
                        //$pdf->Ln();

                        $pdf->selectColumn(1);
                        $pdf->writeHTMLCell(0, 25, $x, $y + 25 * 0, self::doHTMLTemplate($obs), 1, 1, 1, true);
                        $pdf->writeHTMLCell(0, 25, $x, $y + 25 * 1, self::doHTMLTemplate($obs), 1, 1, 1, true);
                        $pdf->writeHTMLCell(0, 25, $x, $y + 25 * 2, self::doHTMLTemplate($obs), 1, 1, 1, true);

                        $i += 6;
                        if(isset($observations[$i])) $pdf->AddPage();
                }
        }

        static function doHTMLTemplate($obs) {
                $pattern =
<<<EOF
<p>Famille: %s <span style="text-align: right">(%d)</span><br/>
Espèce: %s<br/>
Collecteur: %s<br/>
Localité: %s<br/>
Observation: %s  Date: %s</p>
EOF;
                return sprintf($pattern,

                                           $obs['famille'],
                                           $obs['ordre'],
                                           $obs['nom_ret'],
                                           $obs['prenom_utilisateur'] . ' ' . $obs['nom_utilisateur'],
                                           $obs['zone_geo'],
                                           $obs['commentaire'],
                                           strftime("%Y-%m-%d", strtotime($obs['date_observation']))
                );

        }

}
