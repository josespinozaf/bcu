<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Version details
 *
 * @package    theme
 * @subpackage bcu
 * @copyright  2014 Birmingham City University <michael.grant@bcu.ac.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 */
// Fixed header is determined by the individual layouts.
if(!ISSET($fixedheader)) {
    $fixedheader = false;
}
theme_bcu_initialise_zoom($PAGE);
$setzoom = theme_bcu_get_zoom();

theme_bcu_initialise_full($PAGE);
$setfull = theme_bcu_get_full();

$left = (!right_to_left());  // To know if to add 'pull-right' and 'desktop-first-column' classes in the layout for LTR.

$hasmiddle = $PAGE->blocks->region_has_content('middle', $OUTPUT);
$hasfootnote = (!empty($PAGE->theme->settings->footnote));
$haslogo = (!empty($PAGE->theme->settings->logo));
// Get the HTML for the settings bits.
$html = theme_bcu_get_html_for_settings($OUTPUT, $PAGE);

if (right_to_left()) {
    $regionbsid = 'region-bs-main-and-post';
} else {
    $regionbsid = 'region-bs-main-and-pre';
}

echo $OUTPUT->doctype();
?>
<html <?php echo $OUTPUT->htmlattributes(); ?>>
<head>
    <title><?php echo $OUTPUT->page_title(); ?></title>
    <link rel="shortcut icon" href="<?php echo $OUTPUT->favicon(); ?>" />
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='//fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css'>
    <?php echo $OUTPUT->standard_head_html() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body <?php echo $OUTPUT->body_attributes(array('two-column', $setzoom)); ?>>

<?php echo $OUTPUT->standard_top_of_body_html() ?>
<div id="page" class="container-fluid <?php echo "$setfull"; ?>">
    
<?php if (core\session\manager::is_loggedinas()) { ?>
<div class="customalert">
<div class="container">
<?php echo $OUTPUT->login_info(); ?>
</div>
</div>

<?php
} else if (!empty($PAGE->theme->settings->alertbox)) {
?>
<div class="customalert">
<div class="container">
<?php echo $OUTPUT->get_setting('alertbox', 'format_html');; ?>
</div>
</div>
<?php
}
?>

<header id="page-header-wrapper" <?php if($fixedheader) { ?> style="position: fixed;" <?php } ?>>
    <div id="above-header">
        <div class="clearfix container userhead">
            <div class="pull-left">
                <?php //echo $OUTPUT->user_menu(); ?> 
            </div>
            <div class="headermenu row"> <!--DROPDOWN DEL NOMBRE ARRIBA A LA DERECHA-->
                <?php if (!isloggedin() || isguestuser()) { ?>
                    <?php echo $OUTPUT->login_info() ?>
                <?php } else { ?>
                    <div class="dropdown secondone">
                        <a class="dropdown-toggle usermendrop" data-toggle="dropdown" data-target=".secondone"><span class="fa fa-user"></span><?php echo fullname($USER) ?> <span class="fa fa-angle-down"></span></a>
                        <ul class="dropdown-menu usermen" role="menu">
                            <?php if (!empty($PAGE->theme->settings->enablemy)) { ?>
                                <li><a href="<?php p($CFG->wwwroot) ?>/my" title="My Dashboard"><i class="fa fa-dashboard"></i><?php echo get_string('myhome') ?></a></li>
                            <?php } ?>
                            <?php if (!empty($PAGE->theme->settings->enableprofile)) { ?>
                                <li><a href="<?php p($CFG->wwwroot) ?>/user/profile.php" title="View profile"><i class="fa fa-user"></i><?php echo get_string('viewprofile') ?></a></li>
                            <?php } ?>
                            <?php if (!empty($PAGE->theme->settings->enableeditprofile)) { ?>
                                <li><a href="<?php p($CFG->wwwroot) ?>/user/edit.php" title="Edit profile"><i class="fa fa-cog"></i><?php echo get_string('editmyprofile') ?></a></li>
                            <?php } ?>
                            <?php if (!empty($PAGE->theme->settings->enableprivatefiles)) { ?>
                                <li><a href="<?php p($CFG->wwwroot) ?>/user/files.php" title="private files"><i class="fa fa-file"></i><?php echo get_string('privatefiles', 'block_private_files') ?></a></li>
                            <?php } ?>
                            <?php  if (!empty($PAGE->theme->settings->enablebadges)) { ?>
                                <li><a href="<?php p($CFG->wwwroot) ?>/badges/mybadges.php" title="badges"><i class="fa fa-certificate"></i><?php echo get_string('badges') ?></a></li>
                            <?php } ?>
                            <?php if (!empty($PAGE->theme->settings->enablecalendar)) { ?>
                                <li><a href="<?php p($CFG->wwwroot) ?>/calendar/view.php" title="Calendar"><i class="fa fa-calendar"></i><?php echo get_string('pluginname', 'block_calendar_month') ?></a></li>
                            <?php } ?>
                            <li><a href="<?php p($CFG->wwwroot) ?>/login/logout.php" title="Log out"><i class="fa fa-lock"></i><?php echo get_string('logout') ?></a></li>
                        </ul>
                    </div>
                <?php } ?>
            </div>      
        </div>
    </div>
    <div id="page-header" class="clearfix container">
        <?php if ($haslogo) { ?>
            <a href="<?php p($CFG->wwwroot) ?>"><?php echo "<img src='".$PAGE->theme->setting_file_url('logo', 'logo')."' alt='logo' id='logo' />"; echo "</a>";
        } else { ?>
            <a href="<?php p($CFG->wwwroot) ?>"><img src="<?php echo $OUTPUT->pix_url('2xlogo', 'theme')?>" id="logo"></a>
        <?php } ?>
    <?php
    if (isset($PAGE) && !$PAGE->theme->settings->sitetitle) {
        $header = theme_bcu_remove_site_fullname($PAGE->heading);
        $PAGE->set_heading($header);
    }
    ?>
     <div id="coursetitle" class="pull-left">
     <span title='<?php echo $PAGE->heading ?>'><?php echo $PAGE->heading ?></span>
     </div>
  <?php 
  include ("/../../local/wellness/connect.php");
  global $USER, $CFG;
  $userid= $USER->id;
  $usermail= $USER->email;
  
  $result = mysql_query("SELECT * FROM cantasist WHERE DATE(NOW()) between diainicio and diatermino", $db);
  
  if (!$result) {
  	die("Error en la peticion SQL: " . mysql_error());
  }
  while ($row = mysql_fetch_array($result)) {
  	$semanaactual = $row['semana'];
  	$asistenciasnecesarias = (double) $row['totalasistencias'];
  }

$resulta = mysql_query("SELECT DISTINCT asistencias2.*, fitnessgram.RUT FROM asistencias2 INNER JOIN fitnessgram WHERE asistencias2.rut = fitnessgram.RUT AND fitnessgram.email = '$usermail' AND asistencias2.Periodo='S-SEM. 2012/1'", $db);
$asistenciasperiodo = 0;
while ($row = mysql_fetch_array($resulta)) {
	if ($row['Asistencia'] == '1'){
		$asistenciasperiodo = $asistenciasperiodo + 1;
	}
	else if ($row['Asistencia'] == '0,5'){
		$asistenciasperiodo = $asistenciasperiodo + 0.5;
	}
	else if ($row['Asistencia'] == '-1'){
		$asistenciasperiodo = $asistenciasperiodo - 1;
	}
}
$asisttot=$asistenciasperiodo;


  if (isloggedin() && !is_siteadmin()){
  	
  	  echo' <div class="headerlogo">';
      $asistenciasuy = $asistenciasnecesarias-2;
    
            if ($asisttot>=$asistenciasnecesarias) {
                echo '<a href="#aldia" id="login_pop"><img border="0" alt="Atrasado" src="http://i.imgur.com/RDTG9vO.jpg" width="56.5156px" heigth="56.5156px"></a>';
      }
      else if ($asisttot>=$asistenciasuy && $asisttot<$asistenciasnecesarias) {
      	echo '<a href="#peligro" id="login_pop"><img border="0" alt="Atrasado" src="http://i.imgur.com/jT9KI0n.jpg" width="56.5156px" heigth="56.5156px"></a>';
      }
      else {
      	echo '<a href="#atrasado" id="login_pop"><img border="0" alt="Atrasado" src="http://i.imgur.com/AuzuiVW.jpg" width="56.5156px" heigth="56.5156px"></a>';
      }
 
  }
     ?>
		</div>
    
		
        <div id="course-header">
            <?php echo $OUTPUT->course_header(); ?>
        </div>
    </div>

    <div id="navwrap">
        <div class="container">
            <div class="navbar">
                <nav role="navigation" class="navbar-inner">
                    <div class="container-fluid">
                        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </a>
                        <div class="nav-collapse collapse ">
                            <?php echo $OUTPUT->navigation_menu(); //BARRA DE NAVEGACION! ?>
                            <?php echo $OUTPUT->custom_menu(); ?>
                            <?php echo $OUTPUT->tools_menu(); ?>

                            <ul class="nav pull-right">
                                <?php //CAMBIO DE IDIOMA!!!!!!
                                if (empty($PAGE->layout_options['langmenu']) || $PAGE->layout_options['langmenu']) {
                                    echo $OUTPUT->lang_menu();
                                }
                                ?>
                            </ul>
                            <div id="edittingbutton" class="pull-right breadcrumb-button"><?php echo $OUTPUT->page_heading_button(); //PERSONALIZAR LA PAGINA?></div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>

<a href="#x" class="overlay" id="atrasado"></a>
        <div class="popup">
            <center><h3><?php echo 'Estas en la semana '.$semanaactual;?></h3></center>
            <h3><?php echo 'Debes llevar '. $asistenciasnecesarias.' asistencias.'?></h3>
            <h3><?php echo 'Llevas '. $asistenciasperiodo.' asistencias.'?></h3>
            <h5>Debes asistir entre 8am y 9:30am o entre 5pm<br><center> y 7pm al gym o a las outfits disponibles.</center></h5>
            <center><h6></h6></center>
            <a class="close" href="#close"></a>
        </div>
        
<a href="#x" class="overlay" id="peligro"></a>
        <div class="popup">
            <center><h3><?php echo 'Estas en la semana '.$semanaactual;?></h3></center>
            <h3><?php echo 'Debes llevar '. $asistenciasnecesarias.' asistencias.'?></h3>
            <h3><?php echo 'Llevas '. $asistenciasperiodo.' asistencias.'?></h3>
            <center><h4>Ponte al dia y evitaras bloqueos futuros.</h4></center>
            <a class="close" href="#close"></a>
        </div>

<a href="#x" class="overlay" id="aldia"></a>
        <div class="popup">
            <center><h3><?php echo 'Estas en la semana '.$semanaactual;?></h3></center>
            <h3><?php echo 'Debes llevar '. $asistenciasnecesarias.' asistencias.'?></h3>
            <h3><?php echo 'Debes llevar '. $asistenciasperiodo.' asistencias.'?></h3>
            <h4>Sigue asi y evitaras bloqueos futuros.</h4>
            <a class="close" href="#close"></a>
        </div>