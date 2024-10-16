<?php

require_once __DIR__ . '/includes/includes.php';

\Model\Model::_setup();
\Controller\Controller::_entry($_SERVER['PATH_INFO']);