<?php
// Include CMS System
/**--**/ include "../inc/base.php";
//------------------------------------------------
// Site Informations
/**--**/  $meta['title'] = "News";
/**--**/  $meta['page_id'] = 2;
//------------------------------------------------

if ($_GET['id']== '')
{ 
    $content = getNews(2);    
}  else {
    
    if (permTo('site_edit')){
    $content = "site/content_editable";
    } else {
        $content = "site/content"; 
    }
    
    $newsid = $_GET['id'];
    
    $post = db("SELECT * FROM news WHERE id = ".sqlInt($newsid),'object');
    
    //Print
    $_SESSION['print_content'] = $post->content;
    $_SESSION['print_title'] = $post->title;
    $meta['title'] = $post->title;
    $meta['keywords'] = $post->keywords;
    $meta['description'] = $post->description;
    $content = show("news/layout", array(
                                    "news_headline" => $post->title,
                                    "author"=> getUserInformations($post->userid, 'gplus')->gplus,
				    "news_date" => date("F j, Y, G:i",$post->date),
                                    "content" => show($content, array("content" => $post->content)),
                                    "comments" => dispComments($meta['page_id'], $post->id)
    ));
}

//Initialisierung der Seite */
init($content,$meta);   