<?php
 
  $docs_array = array();

  $server = "mongodb://readonly:readonly@5.56.153.58:27017/Configs";

  $options = array(
    //"ssl" => true
  );

  $m = new MongoClient($server, $options); 

  $db  = $m->selectDB('Configs');
  $collection = $db->selectCollection('equipment');

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
