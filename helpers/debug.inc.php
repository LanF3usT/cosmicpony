<?php
function debug($var, $info='debug') {
  echo "\n\t<pre><strong>$info:</strong> ";
  print_r($var);
  echo "\n\t</pre>";
}
