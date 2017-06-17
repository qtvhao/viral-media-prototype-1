<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="app.css">
</head>
<body class="top_level_index_php">
<nav class="navbar navbar-inverse navbar-fixed-top" id="navbar">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">
                <img src="https://assets-9gag-fun.9cache.com/s/fab0aa49/30eb052420799ef4f74bd669a7e9c55e3bba9d24/static/dist/web6/img/header-logo.png"
                     alt="" style="width: 38px;">
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="#">
                        Hot
                    </a>
                </li>
                <li><a href="#">Trending</a></li>
                <li><a href="#">Fresh</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        More <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">One more separated link</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right user-function">
                <li><a href="#"><span class="glyphicon glyphicon-search"></span></a></li>
                <li class="dropdown ">
                    <a href="#" class="dropdown-toggle avatar-container" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <img src="http://i.imgur.com/5igYpER.jpg" alt="">
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="btn btn-default btn-upload">
                        <span class="icon-plus">+</span>
                        <span class="text-upload">Upload</span>
                    </a>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<?php
$html_9gag = file_get_contents('https://9gag.com/');
preg_match_all("#<article.*?article>#is", $html_9gag, $gag_articles_html);
/*var_export($articles[0]);
if (isset($articles[0][0])) {
    var_export($articles[0][0]);
}*/
$articles = [];
foreach ($gag_articles_html[0] as $gag_article_html){
    //echo $gag_article_html;
    preg_match("#<img.*?>#is",$gag_article_html , $gag_image_html);
//    echo $gag_image_html[0];
    preg_match("#alt=\"(.*?)\"#is", $gag_image_html[0], $article_title_array);
    preg_match("#src=\"(.*?)\"#is", $gag_image_html[0], $article_image_source_array);
//    echo $article_title_array[1];
//    echo $article_image_source_array[1];
    $article_title = $article_title_array[1];
    $article_image_source = $article_image_source_array[1];
    $articles[] = [
        'title' => $article_title,
        'type' => 'image',
        'media_source' => $article_image_source
    ];
}
?>
<div class="container">
    <div class="row">
        <div class="col-sm-8" id="main_wrap">
            <div class="articles">
                <?php
                foreach ($articles as $article){
                    ?>
                    <article>
                        <h4><?php echo $article['title']; ?></h4>
                        <?php
                        if($article['type'] === 'image'){
                            ?>
                            <img src="<?php echo $article['media_source'] ?>" alt="">
                            <?php
                        }
                        ?>
                    </article>
                    <?php
                }
                ?>
            </div>
        </div>
        <div class="col-sm-4" id="sidebar_wrap">
            <div class="featured_items">
                <?php
                foreach ($articles as $article){
                    ?>
                    <div class="featured_item_wrap">
                        <?php echo "<div class='image_wrap'>
<img src='$article[media_source]'>
</div>"; ?>
                        <span class="title">
                            <?php echo "<a href='#'>$article[title]</a>"; ?>
                        </span>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>
