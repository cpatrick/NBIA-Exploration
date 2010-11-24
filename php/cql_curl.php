<?php
$serviceWsdl = "http://imaging.nci.nih.gov".
  "/wsrf/services/cagrid/NCIACoreService?wsdl";

$xml = '<?xml version="1.0" encoding="utf-8"?>
<soap:Envelope 
  xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" 
  xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
  xmlns:xsd="http://www.w3.org/2001/XMLSchema">
  <soap:Header></soap:Header>
  <soap:Body>
<ns1:CQLQuery xmlns:ns1="http://CQL.caBIG/1/gov.nih.nci.cagrid.CQLQuery">
<ns1:Target name="gov.nih.nci.ncia.domain.Series" xsi:type="ns1:Object" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"> 
<ns1:Association name="gov.nih.nci.ncia.domain.Study" roleName="study" xsi:type="ns1:Association">  
<ns1:Group logicRelation="AND" xsi:type="ns1:Group">   
<ns1:Association name="gov.nih.nci.ncia.domain.Patient" roleName="patient" xsi:type="ns1:Association">       <ns1:Attribute name="patientId" predicate="EQUAL_TO" value="1.3.6.1.4.1.9328.50.1.0019" xsi:type="ns1:Attribute"/>    </ns1:Association>   
<ns1:Attribute name="studyInstanceUID" predicate="EQUAL_TO" value="1.3.6.1.4.1.9328.50.1.8858" xsi:type="ns1:Attribute"/>  
</ns1:Group> 
</ns1:Association> 
</ns1:Target>
</ns1:CQLQuery>
  </soap:Body>
</soap:Envelope>';

$headers = array( "Content-type: text/xml;charset=\"utf-8\"", 
                  "Accept: text/xml", 
                  "Cache-Control: no-cache", 
                  "Pragma: no-cache", 
                  "SOAPAction: \"retrieveDicomDataByPatientId\"", 
                  "Content-length: ".strlen($xml) ); 

$soap_do = curl_init();
curl_setopt($soap_do, CURLOPT_URL,            $serviceWsdl );
curl_setopt($soap_do, CURLOPT_CONNECTTIMEOUT, 10);
curl_setopt($soap_do, CURLOPT_TIMEOUT,        10);
curl_setopt($soap_do, CURLOPT_RETURNTRANSFER, true );
curl_setopt($soap_do, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($soap_do, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($soap_do, CURLOPT_POST,           true );            
curl_setopt($soap_do, CURLOPT_POSTFIELDS,     $xml );
curl_setopt($soap_do, CURLOPT_HTTPHEADER,     $headers );

$x = "";

if( ($x = curl_exec($soap_do)) === false)
  {                
  $err = 'Curl error: ' . curl_error($soap_do);
  curl_close($soap_do);
  echo $err;
  }
else
  {
  curl_close($soap_do);
  }

echo $x;

?>