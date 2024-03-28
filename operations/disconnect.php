<?php
require_once ("../php/session_manager.php");
userAccess();

delete_session();
redirect('../index.php');
