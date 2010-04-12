<?php
// Returns true for email-formatted strings
function isEmail($email) {
  return eregi("^([a-zA-Z0-9_\.\-])+@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$", $email);
}
