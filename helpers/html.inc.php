<?php

// Alias for htmlspecialchars
function h($txt) {
  return htmlspecialchars($txt);
}

// Returns the given javascript files as <script> tags
// Example:
//   link_js(array('foo.js', 'bar.js')); # => <script src="foo.js"></script>
function link_js($javascripts) {
  $markup = '';
  foreach ((array) $javascripts as $js) {
    $js = add_extension($js, 'js');
    $markup .= "\t<script src=\"$js\"></script>\n";
  }
  return $markup;
}

// Returns the given css as <link rel="stylesheet"> tags
// CSS files names can be given as an array of (name, media-type[, title])
// Example:
//   link_css(array('foo.css', array('bar.css', 'print')));
//   # => <link href="foo.css" rel="stylesheet" media="print" />
//   #    <link href="bar.css" rel="stylesheet" media="print" />
function link_css($stylesheets) {
  $markup = '';
  foreach ((array) $stylesheets as $css) {
    if (is_array($css)) {
      if (count($css) == 2)
        $css[] = '';

      list($name, $media, $title) = $css;
    } else {
      list($name, $media) = array($css, 'screen');
      $title = '';
    }
    $name = add_extension($name, 'css');
    $alternate = ($title != '' ? 'alternate ' : '');

    $markup .= sprintf("\t".'<link href="%s" %s %s charset="utf-8" rel="%sstylesheet"  />'."\n", $name, ($media != '' ? "media=\"$media\"" : ''), ($title != '' ? "title=\"$title\"" : ''), $alternate);
  }
  return $markup;
}
