<?php
require_once("config.php");
require_once("db.class.php");

$db=new db("tableName");

/* ----------------------------------------------------------------
(ARRAY) ALL
PARAM1st [OFFSET PAGE(OPTION)]
PARAM2nd [COLUMN(OPTION)]
-----------------------------------------------------------------*/
/*$result=$db->all();
print_r($result);*/



/* ----------------------------------------------------------------
(BOOLEAN) POST
PARAM1st [ARRAY]
-----------------------------------------------------------------*/
/*$data=array(
	"title"=>"testTitle",
	"content"=>"testContent"
);
$result=$db->post($data);
print_r($result);*/



/* ----------------------------------------------------------------
(BOOLEAN) UPDATE
PARAM1st [ARRAY]
-----------------------------------------------------------------*/
/*$data=array(
	"id"=>7,
	"title"=>"testtestTitle",
	"content"=>"testContent"
);
$db->update($data);*/



/* ----------------------------------------------------------------
(ARRAY) FIND
PARAM1st [ID]
PARAM2nd [COLUMN](OPTION)
-----------------------------------------------------------------*/
/*$result=$db->find(1);
print_r($result);*/



/* ----------------------------------------------------------------
(BOOLEAN) REMOVE
PARAM1st [ID]
-----------------------------------------------------------------*/
/*$db->remove(6);*/



/* ----------------------------------------------------------------
(ARRAY) SEARCH
PARAM1st [KEYWORDS]
-----------------------------------------------------------------*/
/*$result=$db->search("test");
print_r($result);*/



/* ----------------------------------------------------------------
(INT) COUNT
-----------------------------------------------------------------*/
/*echo $db->count();*/


?>