<?php
// Include CMS System
/**--**/ include "../inc/config.php";
//------------------------------------------------
// Site Informations
/**--**/  $meta['title'] = "ACP";
//------------------------------------------------
if (!permTo("menu_acp")) { $error = msg(_no_permissions); }

if (isset($_GET['acp'])) {
    $acp = $_GET['acp'];
} else {
    $acp = "";
}

$getd = db("SELECT * FROM menu WHERE part = 3");
while ($get = mysqli_fetch_assoc($getd))
{
    $acp_menu .= '<li><a href ="../acp/index.php?acp='.$get['link'].'">'.$get['title']."</a></li>";
    if ($acp != "" && $acp == $get['link'])
    {
        $file_exist = true;
    }
            
}

if ($file_exist)
{
    include $acp.".php";
}
else
{
    //Admin Welcome
}

if ($error == "") {
    init($acp_menu.'<hr>'.$content,$meta);
} else {
    init($error,$meta);
}
