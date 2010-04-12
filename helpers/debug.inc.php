<?php
function debug($var,$info='pre') {
    echo "\n\t<pre><strong>$info: </strong>";
    print_r($var);
    echo "\n\t</pre>";
}