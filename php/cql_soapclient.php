<?php
$serviceWsdl = "http://imaging.nci.nih.gov".
  "/wsrf/services/cagrid/NCIACoreService?wsdl";

try 
{
  $client = new SoapClient( $serviceWsdl,
                            array('soap_version' => SOAP_1_1) );
  var_dump($client);
  $r = $client->__getFunctions();
  foreach($r as $v)
    {
    echo $v . "<br /><br />";
    }

} 
catch(SoapFault $fault) 
{
  echo "there was an issue : \n" .
    " faultcode: $fault->faultcode\n" .
    "  faultstring: $fault->faultstring\n";
}
?>