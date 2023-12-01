<?php
function str_replace_once($search, $replace, $text)
{
	$pos = strpos($text, $search);
	return $pos!==false ? substr_replace($text, $replace, $pos, strlen($search)) : $text;
}
function debug($var)
{
	echo "<pre>";
	var_dump($var);
	echo "</pre>";
}
function logWrite($message, string $logName)
{
	$date = date('j-y');
	$logMess = "FILE - " . __FILE__ . "||LINE - " . __LINE__ . "||MESSAGE: {$message}||\n";
	file_put_contents("app/logs/{$logName}-{$date}.log", print_r($logMess, true), FILE_APPEND);
}