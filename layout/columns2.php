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

require_once(dirname(__FILE__) . '/includes/header.php');
$left = theme_bcu_get_block_side();
?>

<div class="container outercont">
    <div id="page-content" class="row-fluid">
    <div id="page-navbar" class="span12">
        <?php echo $OUTPUT->navbar(); ?>
    </div>
        <?php
        if($left == 1) {
            echo $OUTPUT->blocks('side-post', 'span3 desktop-first-column');
        }
        ?>
        <section id="region-main" class="span9 <?php if ($left) { echo ' '; } else { echo 'desktop-first-column'; } ?> ">
            <?php
             echo $OUTPUT->course_content_header();
             echo $OUTPUT->main_content();
             echo $OUTPUT->course_content_footer();
            ?>
        </section>
        <?php
        if ($left == 0) {
            echo $OUTPUT->blocks('side-post', 'span3');
        }
        ?>
    </div>
    </div>

    <?php
    require_once(dirname(__FILE__) . '/includes/footer.php');
