<?php
include_once "login.php";

session_start();
session_destroy();

header('location:index.php');
