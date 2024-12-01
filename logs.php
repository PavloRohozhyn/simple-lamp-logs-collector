<?php

/**
 * Red string
 * 
 * @param type $data
 * @return boolean
 */
function redColor($data) {
    return true;
}

/**
 * Handler
 * 
 * @param type $logname
 * @param type $path
 */
function run($logname, $path) {
    echo '<hr />';
    echo "<b>{$logname}</b><br />";
    $output = null;
    try {
        $output = shell_exec('tail -n 20 '. $path);
        
//        // split by /n
//        $data = explode("\n", $output);
//        
//        foreach($data as $d) {
//            $pattern = "/\d{4}\-\d{2}\-\d{2} \d{2}:\d{2}:\d{2}/";
//            if (preg_match($pattern, $d, $matches)) {
//               
//                // red color
//                if(redColor($matches[0]))
//                    echo "<div style='color:red'>".$d."</div>";
//                else 
//                    echo $d;
//            } else {
//                echo $d;
//            }
//        }
        
        // print_r($data);
    } catch (Exception $ex) {
        echo $e->getMessage();
    }
    echo "<pre>$output</pre>";

}

$logs = [
    'nginx' => '',
    'postgresql' => '',
    'php-fpm'=> ''
];
 
echo '<b>Log collector</b><br/>';
echo '<b><div style="color:green">Server Time : ' . date('Y-m-d H:i:s', time()).'</div></b>';
echo '<a href="logs.php?task=clear">clear all logs</a>';

// simple clear log
if(isset($_GET,$_GET['task']) && $_GET['task'] == 'clear')
{
  // here we clear log
  foreach($logs as $l)
    file_put_contents($l, '');
    // rewrite to fantastik logs dashbord )))
    header('Location: '.$_SERVER['HTTP_REFERER']);
} else {
   // show dashboard 
   foreach ($logs as $logK => $logV) 
   {
       run($logK, $logV);
   } 
}
