<?php ob_start(); ?>

<?php require('components/mediaDisplayer.php'); ?>

<?php $content = ob_get_clean(); ?>

<?php require('dashboard.php'); ?>
