<?php
session_start();
$db = new mysqli('localhost','root','','dbms')
	or die($db->connect_error);