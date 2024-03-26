<?php
require_once ("php/sessionManager.php");
userAccess();

delete_session();
redirect('index.php');
