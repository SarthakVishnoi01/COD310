<!DOCTYPE html>
<html>
<head>
<script>
  function httpGet(theUrl){
      var xmlHttp = new XMLHttpRequest();
      xmlHttp.open( "GET", theUrl, false ); // false for synchronous request
      xmlHttp.send( null );
      // return xmlHttp.responseText;
      return xmlHttp.responseText.op_returns;
  }
</script>
</head>

<body>
<?php
  $file_result = "";

  if ($_FILES["indexFile"]["error"] > 0)
  {
    // If No file is uploaded
    $file_result .= "No File Uploaded ";
    $file_result .= "Error COde " . $_FILES["file"]["error"] . "<br>";
  } else {

    $dirpath = realpath(dirname(getcwd()));
    // print "$dirpath.<br>";

    // $file_result .=
    // "Upload: " . $_FILES["file"]["name"] . "<br>" .
    // "Type: " . $_FILES["file"]["type"] . "<br>" .
    // "Size: " . ($_FILES["file"]["size"]/1024) . "<br>" .
    // "Temp File: " . $_FILES["file"]["tmp_name"] . "<br>";
    // $fileName = $_FILES["file"]["name"];
    //Run a script to check whether the hash of index file is same as the hash of the index which which we have

    $indexFile = $_FILES["indexFile"]["tmp_name"];
    $uploadedIndexFile = $dirpath . "/examples/uploads/" . basename($_FILES['indexFile']['name']);
    $mainIndexFile = $dirpath . "/examples/server/index.pdf";
    // echo "$uploadedIndexFile.<br>";
    move_uploaded_file($indexFile, $uploadedIndexFile);

    // $outFirst = shell_exec("python3 $dirpath/examples/pythonScripts/checkHash.py $uploadedIndexFile 2>&1");
    // echo "$outFirst.<br>";

    // if (strcmp($outFirst, "The uploaded index File is incorrect")>0)
    // {
    //   echo "<br>";
    //   echo "Session Terminated! GO BACK TO MAIN PAGE TO TRY AGAIN";
    // }
    // else {


    // Computing the hash of the input certificate
    $new_name = $_FILES["certificate"]["name"];
    $certificateTempName = $_FILES["certificate"]["tmp_name"];
    //certiHash has the hash of the certificate uploaded by the user
    $certiHash = shell_exec("python3 $dirpath/examples/pythonScripts/genHash.py $certificateTempName 2>&1");
    // echo "<br>";
    echo "Certificate Hash is :$certiHash <br>";
    $indexFileHash = shell_exec("python3 $dirpath/examples/pythonScripts/genHash.py $uploadedIndexFile 2>&1");
    echo "Index File Hash is :$indexFileHash <br>";
    // Append ASCII of IITDDOCS as prefix to this Hash
    $ascii = shell_exec("python3 $dirpath/examples/pythonScripts/asciiGenerator.py");
    echo "Ascii is: $ascii <br>";
    $tempIndexFileHash = "$ascii$indexFileHash<br>";
    echo "Temp Index File is : $tempIndexFileHash<br>";
    $finalIndexFileHash = preg_replace('/\s+/', '', $tempIndexFileHash);
    echo "Final Index File Hash: $finalIndexFileHash <br>";
    //Match if it is in the given block
    // Now the process of mining the block starts

    $blockNum = $_POST["blockNum"];
    echo "Block Number is: $blockNum<br>";
    $url = "http://api-testnet.coinsecrets.org/block/" . "$blockNum";
    echo "Url is: $url <br>";
    $content = file_get_contents($url);
    $json = json_decode($content, true);
    $count = 0;
    for($i=0; $i<sizeof($json['op_returns']); $i++){
      $text = (string)$json['op_returns'][$i]['hex'];
      $text = preg_replace('/\s+/', '', $text);
      if(strcmp($text,substr($finalIndexFileHash,0,80))==0){
        echo "The uploaded index file is correct";
        echo "<br>";
        $count = 1;
      }
    }
    echo "COUNT IS $count <br>";
    if($count == 0){
      echo "Session Terminated! GO BACK TO MAIN PAGE TO TRY AGAIN";
      echo "<br>";
    }
    // The index file uploaded is correct
    // Execute a python script which sees whether that certificate is present in the index file
    $checkCerti = shell_exec("python3 $dirpath/examples/pythonScripts/a.py $mainIndexFile $certiHash 2>&1");
    // echo "<br>";
    echo $checkCerti;
    echo "<br>";
    echo "YOLO";
  }
?>
</body>
</html>

<!-- // Function for getting the data from curl
function get_data($url)
{
  $ch = curl_init();
  $timeout = 5;
  curl_setopt($ch,CURLOPT_URL,$url);
  curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
  curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
  $data = curl_exec($ch);
  curl_close($ch);
  return $data;
}
print_r(get_data($url)); -->
49495444444f4353d1c0aab3cb4837b5240c11a4a93a51aa51f9acd171d4465335c72b387f33c594
