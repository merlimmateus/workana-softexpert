<?php

use Doctrine\ORM\Tools\Console\ConsoleRunner;

require_once 'config/database.php';

return ConsoleRunner::createHelperSet($entityManager);
