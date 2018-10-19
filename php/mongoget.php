<?php
/*
  phpinfo();
/*
  $mng = new MongoDB\Driver\Manager("mongodb://localhost:27017");

    $stats = new MongoDB\Driver\Command(["dbstats" => 1]);
    $res = $mng->executeCommand("testdb", $stats);
    
    $stats = current($res->toArray());

    print_r($stats);
*/
/*
  new MongoDB\Driver\Manager("mongodb://SEKO:52Sebb17@cluster0-wzi3i.mongodb.net:27017,mycluster0-shard-00-01.mongodb.net:27017,mycluster0-shard-00-02.mongodb.net:27017/admin?ssl=true&replicaSet=Mycluster0-shard-0&authSource=admin&serverSelectionTryOnce=false&serverSelectionTimeoutMS=15000");
  $filter = [];
  $options = [
    'projection' => [],
  ];
  $query = new MongoDB\Driver\Query($filter);
  $rows = $mongo->executeQuery('Configs.equipment', $query); // $mongo contains the connection object to MongoDB
  foreach($rows as $r){
    print_($r);
  }
*/



  
  $docs_array = array();

  $server = "mongodb://readonly:readonly@5.56.153.58:27017/Configs";
  /*
  $server = "mongodb://SEKO:52Sebb17@" .
  "cluster0-shard-00-00-wzi3i.mongodb.net:27017," .
  "cluster0-shard-00-01-wzi3i.mongodb.net:27017," . 
  "cluster0-shard-00-02-wzi3i.mongodb.net:27017/" . 
  "admin?replicaSet=Mycluster0-shard-0&authSource=admin";
  */
  $options = array(
    //"ssl" => true
  );

  $m = new MongoClient($server, $options); 

  $db  = $m->selectDB('Configs');
  $collection = $db->selectCollection('equipment');

  //$db  = $m->selectDB('alstom');
  //$collection = $db->selectCollection('configs');

  //remember double quotes on reserved keywords
  $MongoQuery = '{
    
  }'; //Mongo query e.g. {'Equipment': 'CDA'} 
  $fields = array(); //fields to include in query response eg. array('name','id')


  $cursor = $collection->find(
    json_decode($MongoQuery), 
    $fields 
  ); 
  
  //Add documents to documents array
  foreach ($cursor as $value)
  {
    array_push($docs_array, $value);
  }

  echo json_encode($docs_array);

?>
