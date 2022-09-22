<?php
$time_cur = time();

if ($com == 'tags') {
    $tags = addslashes($_REQUEST['alias']);
    $query = $d->simple_fetch("select * from #_tags where alias = '$tags'");
    $tintuc = $d->o_fet("select  * from #_tintuc where hien_thi = 1 and tags_hienthi like '%" . $query['ten_vn'] . "%' order by so_thu_tu asc, id desc");
} else {
    $loai = $d->simple_fetch("select * from #_category where hien_thi = 1 and alias_{$lang} = '$com'");

    if (count($loai) == 0) $d->location(URLPATH . "404.html");
    $id_sub = substr($d->findIdSub($loai['id'], 1), 1);

    $id_loai = $loai['id'] . $d->findIdSub($loai['id']);
    $tintuc = $d->o_fet("select * from #_tintuc where hien_thi = 1 and id_loai = " . $loai["id"] . " order by so_thu_tu asc, id desc");
}
if (isset($_GET['page']) && !is_numeric(@$_GET['page'])) $d->location(URLPATH . "404.html");

$curPage = isset($_GET['page']) ? addslashes($_GET['page']) : 1;
$url = $d->fullAddress();
$maxR = 25;
$maxP = 5;
$phantrang = $d->phantrang($tintuc, $url, $curPage, $maxR, $maxP, 'classunlink', 'classlink', 'page');
$tintuc2 = $phantrang['source'];
//$loaisub = $d->o_fet("select * from #_category where hien_thi = 1 and (id_loai = ".$loai['id']." or id_loai = ".$loai['id_loai']." or id = ".$loai['id_loai'].") and id_loai <>0");
//$id_loai2='1026'.$d->findIdSub(1026);
//$news_home = $d->o_fet("select * from #_tintuc where hien_thi = 1 and noi_bat = 1 and FIND_IN_SET(id_loai,'$id_loai2') <> 0 order by id desc limit 0,10");
$bg = $d->getTemplates(60);
?>

<div class="bradcum-news">
    <div class="brea2">
        <div class="container__item">
            <div class="bregroup" style="background: url(<?= URLPATH . 'img_data/images/' . $bg['hinh_anh'] ?>);">
                <h1 class="title-home"><span><?= $loai['ten_' . $lang] ?></span></h1>
                <?= $d->breadcrumbList($loai['id'], $lang, URLPATH) ?>
            </div>
        </div>
    </div>
</div>
<br><br>
<div class="container">
    <div class="row">

        <div class="col-md-12 col-sm-12">

            <div class="clearfix"></div>
            <?php if (!$loai['menu']) { ?>
                <?php if (count($tintuc) == "") { ?>
                    <div class="chitiettin">
                        <?= $loai['noi_dung_' . $lang] ?>
                    </div>
                <?php } elseif (count($tintuc) == 1) { ?>
                    <div class="chitiettin">
                        <?= $tintuc[0]['noi_dung_' . $lang] ?>
                    </div>
                <?php } else {

                ?>
                    <div class="item__cs__a">
                        <div class="container__item__3">
                            <?php foreach ($tintuc2  as $i => $item) {
                            ?>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="content2ll">
                                        <div class="row itemdetailnew3">
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <div class="img-tintuc">
                                                    <a href="<?= URLPATH . $item['alias_' . $lang] ?>.html?lan=<?= $lang ?>" title="<?= $item['ten_' . $lang] ?>">
                                                        <img src="<?= URLPATH ?>thumb.php?src=<?= URLPATH ?>img_data/images/<?= $item['hinh_anh'] ?>&w=730&h=400" alt="<?= $item['ten_' . $lang] ?>" onerror="this.src='<?= URLPATH ?>templates/error/error.jpg';">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <div class="noidung-tt">
                                                    <h3><a href="<?= URLPATH . $item['alias_' . $lang] ?>.html?lan=<?= $lang ?>" title="$item['ten_'.$lang] ?>"><?= $item['ten_' . $lang] ?></a></h3>
                                                    <div class="mota">
                                                        <?= $d->catchuoi_new(strip_tags($item['mo_ta_' . $lang]), 350) ?>
                                                    </div>
                                                    <div class="text-right">
                                                        <a href="<?= URLPATH . $item['alias_' . $lang] ?>.html"><?= _viewmore ?></a>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                            <?php } ?>
                        </div>
                    </div>

                    <div class="pagination-page">
                        <?php echo @$phantrang['paging'] ?>
                    </div>
                <?php }
            } else {
                $loai2 = $d->o_fet("select * from #_category where  id_loai = " . $loai["id"] . " order by so_thu_tu asc, id desc");
                ?>
                <?php if (count($loai2)) { ?>
                    <div class="container__item">
                        <div class="title_menu_priod row">
                            <div class="tilo">
                                <?php foreach ($loai2 as $key => $item) { ?>
                                    <div onclick="changeMenu(this)" data-id="<?= $item['id'] ?>" class="item-menu-prm2 <?= !$key ? "active" : "" ?>"><?= $item['ten_' . $lang] ?></div>
                                <?php } ?>
                            </div>
                        </div>

                        <?php foreach ($loai2 as $k => $value) {
                            $tintuc2 = $d->o_fet("select * from #_tintuc where hien_thi = 1 and id_loai = " . $value["id"] . " order by so_thu_tu asc, id desc");
                        ?>
                            <div class="lo test <?= !$k ? "active" : "" ?>" data-id="<?= $value['id'] ?>">
                                <div class="item__cs__ba">
                                    <div class="container__item__4">
                                        <?php foreach ($tintuc2  as $i => $item) {
                                        ?>
                                            <div class="col-item_0">
                                                <div class="content2l2l">
                                                    <div class=" itemdetailnew5">
                                                        <div class="col-12">
                                                            <div class="img-tintuc_2">
                                                                <a href="<?= URLPATH . $item['alias_' . $lang] ?>.html?lan=<?= $lang ?>" title="<?= $item['ten_' . $lang] ?>">
                                                                    <img src="<?= URLPATH ?>thumb.php?src=<?= URLPATH ?>img_data/images/<?= $item['hinh_anh'] ?>&w=730&h=400" alt="<?= $item['ten_' . $lang] ?>" onerror="this.src='<?= URLPATH ?>templates/error/error.jpg';">
                                                                </a>
                                                                <div class="mota__ctv3">
                                                                    <div class="groupvxa">
                                                                        <h3 style="margin: 0;color:orange"><a style="color: orange;" href="<?= URLPATH . $item['alias_' . $lang] ?>.html?lan=<?= $lang ?>" title="$item['ten_'.$lang] ?>"><?= $item['ten_' . $lang] ?></a></h3>

                                                                        <img src="<?= URLPATH . 'templates/images/proj-line.png' ?>" alt="line">


                                                                    </div>

                                                                </div>

                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                        <?php } ?>
                                    </div>
                                </div>
                            </div>

                        <?php } ?>

                    </div>



                <?php  } else { ?>
                    <div class="item__cs__ba">
                        <div class="container__item__4">
                            <?php foreach ($tintuc2  as $i => $item) {
                            ?>
                                <div class="col-item_0">
                                    <div class="content2l2l">
                                        <div class=" itemdetailnew5">
                                            <div class="col-12">
                                                <div class="img-tintuc_2">
                                                    <a href="<?= URLPATH . $item['alias_' . $lang] ?>.html?lan=<?= $lang ?>" title="<?= $item['ten_' . $lang] ?>">
                                                        <img src="<?= URLPATH ?>thumb.php?src=<?= URLPATH ?>img_data/images/<?= $item['hinh_anh'] ?>&w=730&h=400" alt="<?= $item['ten_' . $lang] ?>" onerror="this.src='<?= URLPATH ?>templates/error/error.jpg';">
                                                    </a>
                                                    <div class="mota__ctv3">
                                                        <div class="groupvxa">
                                                            <h3 style="margin: 0;color:orange"><a style="color: orange;" href="<?= URLPATH . $item['alias_' . $lang] ?>.html?lan=<?= $lang ?>" title="$item['ten_'.$lang] ?>"><?= $item['ten_' . $lang] ?></a></h3>

                                                            <img src="<?= URLPATH . 'templates/images/proj-line.png' ?>" alt="line">


                                                        </div>

                                                    </div>

                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                </div>

                            <?php } ?>
                        </div>
                    </div>

                    <div class="pagination-page">
                        <?php echo @$phantrang['paging'] ?>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>

    </div>
</div>

<script>
    const changeMenu = (el) => {
        const id = el.getAttribute("data-id");
        document.querySelector(".item-menu-prm2.active").classList.remove("active");
        el.classList.add("active");
        let listContent = document.querySelectorAll(".lo.test");

        listContent.forEach(item => {
            const idMenu = item.getAttribute("data-id");
            if (id === idMenu) {
                item.classList.add("active")
            } else {
                item.classList.remove("active");
            }
        })
    }
</script>