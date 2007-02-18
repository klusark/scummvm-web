<?php

/*
 * Documentation Page for ScummVM
 * by Jeremy Newman <jnewman@dracowulf.com>
 *
 */

// set this for position of this file relative
$file_root = ".";

// load libraries
require($file_root."/include/"."incl.php");

// start of html
html_page_header('ScummVM :: Documentation');

html_content_begin('ScummVM Documentation');

echo '<div class="par-item">';

$view = $HTTP_GET_VARS['view'];

if ($view and file_exists($file_root."/docs/".$view.".xml")) {
  echo  '  <div class="par-head">';
  echo display_xml($file_root."/docs/".$view.".xml",'NAME');
  echo  '  </div>';
  echo '  <div class="par-content">';
  // extract the body from the XML file
  $html = display_xml($file_root."/docs/".$view.".xml",'BODY');
  // Now evaluate any PHP code embedded into it, and output the result
  echo eval("?>" . $html . "<?php ");
  echo "<br>";
  echo "  </div>\n";
} else {
?>
  <div class="par-intro">
    <br>
    Click the title of the section of the documentation you want to read.
    <br>
    <br>
  </div>

  <div class="par-content">
  <br>

  <!-- Ohloh badge with project metrics -->
  <SCRIPT type='text/javascript' language='JavaScript' src='http://www.ohloh.net/projects/113;badge_js'></SCRIPT>
  <br>
  <br>

  <a href='http://svn.sourceforge.net/viewcvs.py/*checkout*/scummvm/scummvm/tags/release-0-9-1/README'>README 0.9.1</a><br>
  The ScummVM README, for version 0.9.1<br><br>

  <a href='http://wiki.scummvm.org/index.php/Documentation'>Documentation on Wiki</a><br>
    Assorted documentation on our Wiki, several important HOWTO's<br><br>

  <a href='http://wiki.scummvm.org/index.php/Developer_Central'>Developer Central</a><br>
  Guidelines on how to hack ScummVM. A must read for developers.<br><br>
<?php


  // get list of documentation items
  $docs = get_files($file_root."/docs","xml");
  sort($docs);
    
  // loop and display docs
  $c = 0;
  while (list($key,$item) = each($docs)) {
    $c++;
    list($file,$ext) = split("\.",$item,2);

    echo "<a href='?view=$file'>".display_xml($file_root."/docs/".$item,'NAME')."</a><br>\n";
    echo display_xml($file_root."/docs/".$item,'DESC')."<br><br>\n";
  } // end of docs loop

?>
  <a href='http://wiki.scummvm.org/index.php/Datafiles'>Game data files</a><br>
  This page lists for many supported games which files exactly are needed by ScummVM in order to play that game.<br><br>

<?php

?>
  <a href='http://wiki.scummvm.org/index.php/TODO'>ScummVM current areas of focus</a><br>
  This page is the current TODO list for ScummVM.<br><br>

<?php
     echo "<a href='$file_root/docs/doxygen/html/index.php'>Source code documentation</a><br>\n";
?>
  Cross referenced source code documentation for ScummVM, generated using
  <a href='http://www.doxygen.org'>Doxygen</a>.<br><br>

<?php

  // Hard code link to specs for now...
  echo "<a href='$file_root/docs/specs/index.php'>The inComplete SCUMM Reference Guide</a><br>\n";
  echo "being a Partially Complete and Mostly Accurate guide to the SCUMM Engine data file Format for Versions Five and Six (and above)<br><br>\n";

  echo "  </div>\n";
}

echo "</div>\n";

html_content_end();
html_page_footer();

?>
