<?php
$textslide = $d->getImg(1130);
$product__nb = $d->getImg(1302);
$product__title = $d->simple_fetch("select * from #_category where id = 1302");
$product__link = $d->simple_fetch("select * from #_category where id = 1291");
$project__title = $d->simple_fetch("select * from #_category where id = 1303");
$video__item = $d->simple_fetch("select * from #_category where id = 1304");
$project__list = $d->o_fet("select * from #_tintuc where id_loai = 1303 and noi_bat = 1 order by so_thu_tu asc, id desc limit 0,4");
?>

<div class="uk-section-default uk-section uk-padding-remove-vertical uk-flex uk-flex-middle" uk-height-viewport="offset-top: true;" style="min-height: calc(100vh - 145.594px);">
    <div class="uk-width-1-1">
        <div class="tm-grid-expand uk-child-width-1-1 uk-margin-remove-vertical uk-grid uk-grid-stack" uk-grid>
            <div class="uk-width-1-1@m uk-first-column" uk-height-viewport="offset-top: true;" style="min-height: calc(100vh - 145.594px);">
                <div uk-slideshow="ratio: false; animation: fade; autoplay: 1;" class="mascoat-main-trans uk-margin uk-slideshow">
                    <div class="uk-position-relative" >

                        <ul class="uk-slideshow-items" uk-height-viewport="offset-top: true; minHeight: 300;" style="min-height: calc(100vh - 145.594px);">
                            <?php foreach ($textslide as $key => $item) { ?>
                                <li class="el-item">
                                    <a class="uk-position-cover uk-animation-kenburns uk-animation-reverse uk-transform-origin-top-left" href="<?= $item['link'] ?>">
                                        <img class="el-image" alt="Industrial Pipelin" uk-img="target: !.uk-slideshow-items" uk-cover="" data-src="<?= URLPATH . 'img_data/images/' . $item['picture'] ?>" data-srcset="<?= URLPATH . 'img_data/images/' . $item['picture'] ?>" data-sizes="(max-aspect-ratio: 2000/980) 204vh" data-width="2000" data-height="980" sizes="(max-aspect-ratio: 2000/980) 204vh" src="<?= URLPATH . 'img_data/images/' . $item['picture'] ?>" style="height: 898px; width: 1832px;">
                                    </a>
                                    <div class="uk-position-cover uk-flex uk-flex-left uk-flex-middle uk-padding">
                                        <div class="el-overlay uk-panel uk-margin-remove-first-child">
                                            <div class="el-content uk-panel uk-margin-top">
                                                <div class="uk-card uk-width-1-1 uk-card-default uk-text-center">
                                                    <div class="uk-padding">
                                                        <div class="uk-heading-2xlarge uk-text-secondary uk-margin-small"><?=$item['title_'.$lang]?></div>
                                                        <div class="uk-text-secondary uk-margin-remove" style="font-size:2rem; line-height:2.5rem;"><strong><?=$item['body_'.$lang]?></strong></div>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>

                        <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slideshow-item="previous"></a>
                        <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slideshow-item="next"></a>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="prouduct__nb">
    <div class="container__item__2" style="background-image: url(<?= URLPATH . 'templates/images/whitebouncyarrows.svg' ?>);">
        <div class="h2__title__t"><?= $product__title['ten_' . $lang] ?></div>
        <div class="product__nb__group">
            <?php foreach ($product__nb as $key => $item) { ?>
                <div class="product__nb__item">
                    <img src="<?= URLPATH . 'img_data/images/' . $item['picture'] ?>" alt="<?= $item['title_' . $lang] ?>">
                    <h1><?= $item['title_' . $lang] ?></h1>
                </div>
            <?php } ?>
        </div>
        <div class="view__product">
            <a href="<?= URLPATH . $product__link['alias_' . $lang] . '.html' ?>"> <?=_product_discovery?></a>
        </div>
    </div>
</section>

<section class="project">
    <div class="project__side__left">
        <div class="content">
            <h3><?= $project__title['ten_' . $lang] ?></h3>
        </div>
    </div>
    <div class="project__side__right">
        <div class="content">
            <?php foreach ($project__list as $key => $item) { ?>
                <div class="item">
                    <h1><a href="<?= URLPATH . $item['alias_' . $lang] . '.html' ?>"><?= $item['ten_' . $lang] ?></a></h1>
                    <img src="<?= URLPATH . 'img_data/images/' . $item['hinh_anh'] ?>" alt="<?= $item['ten_' . $lang] ?>">
                </div>
            <?php } ?>
        </div>
    </div>
</section>

<section class="video__home">
    <div class="des__video">
        <img style="width: 200px" src="<?= URLPATH . 'img_data/images/' . $video__item['hinh_anh'] ?>" alt="">
        <div class="h2__title__t"><?= $video__item['ten_' . $lang] ?></div>
        <h3><?= $video__item['mo_ta_' . $lang] ?></h3>
        <a href="<?= URLPATH . $video__item['alias_' . $lang] . '.html' ?>"><?=_xemthem?></a>
    </div>
    <div class="mascoat-success-video-overlay-top">
        <img src="<?= URLPATH . 'templates/images/blue_curve_top_2000.png' ?>" alt="n">
    </div>
    <div class="mascoat-success-video-overlay-bottom">
        <img src="<?= URLPATH . 'templates/images/blue_curve_bottom_2000.png' ?>" alt="n">
    </div>
    <iframe src="https://www.youtube.com/embed/<?= $video__item['video'] ?>?autoplay=0&amp;showinfo=0&amp;rel=0&amp;modestbranding=1&amp;playsinline=1" width="1920" height="1080" allowfullscreen uk-responsive uk-video="automute: true"></iframe>
    <!-- <video src="https://www.youtube.com/watch?v=XiZI5L9jIo4" width="1800" height="1200" loop muted playsinline uk-video="autoplay: inview"></video> -->
</section>