<?php

$targetFolder ='/home/erir1/rayan_etfa/storage/app/public';
$linkFolder = $_SERVER['DOCUMENT_ROOT'].'/storage';

symlink($targetFolder,$linkFolder);
echo 'Symlink completed';