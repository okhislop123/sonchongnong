<?php
$query = $d->simple_fetch("select id,ten_vn,alias_vn,mo_ta_vn from #_category where alias_{$_SESSION['lang']}='$com'");
$id_loai = $query['id'];
$all_id = $id_loai . $d->findIdSub($id_loai);

if ($id_loai == '') {
    $d->location(URLPATH . "404.html");
}
$loai = $d->simple_fetch("select * from #_category where hien_thi = 1 and alias_{$lang} = '$com'");
$loai1 = $d->o_fet("select * from #_category where hien_thi = 1 and id_loai = {$id_loai} order by so_thu_tu asc, id desc");


$sanpham = $d->o_fet("select * from #_sanpham where hien_thi = 1  and id_loai in ( $all_id ) and style=0 order by so_thu_tu asc, id desc");



if (isset($_GET['page']) && !is_numeric(@$_GET['page'])) {
    $d->location(URLPATH . "404.html");
}
$curPage = isset($_GET['page']) ? addslashes($_GET['page']) : 1;
$url = $d->fullAddress();
$maxR = 5;
$maxP = 3;
$phantrang = $d->phantrang($sanpham, $url, $curPage, $maxR, $maxP, 'classunlink', 'classlink', 'page');
$sanpham = $phantrang['source'];
$loaisub = $d->o_fet("select * from #_category where hien_thi = 1 and (id_loai = " . $loai['id'] . " or id_loai = " . $loai['id_loai'] . " or id = " . $loai['id_loai'] . ") and id_loai <>0");
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

<?php if ($loai['menu'] != 1) { ?>

    <?php if (count($loai1)) { ?>
        <div class="container__item__3">
            <div class="row">
                <?php foreach ($loai1 as $key => $item) { ?>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="item__cate_pro">
                            <div class="img">
                                <a href="<?= URLPATH . $item['alias_' . $lang] . '.html' ?>">
                                    <img src="<?= URLPATH . 'img_data/images/' . $item['hinh_anh'] ?>" alt="<?= $item['ten_' . $lang] ?>">
                                </a>
                            </div>
                            <div class="des">
                                <h3 class="prodcut-name"> <a href="<?= URLPATH . $item['alias_' . $lang] . '.html' ?>"><?= $item['ten_' . $lang] ?></a></h3>
                                <div class="des2">
                                    <?= $item['mo_ta_' . $lang] ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        </div>
    <?php } else { ?>
        <div class="container__item__3">
            <div class="conten_pr2">
                <?= $loai['noi_dung_' . $lang] ?>
            </div>
        </div>
        <!-- <div class="container__item">
        <div class="row">
            <div class="col-md-12 col-sm-12">

                <div class="clearfix"></div>
                <?php if (count($sanpham) > 0) { ?>
                    <div class="row list-product ">
                        <?php include 'ct_product.php'; ?>
                    </div>
                    <div class="pagination-page">
                        <?php echo @$phantrang['paging'] ?>
                    </div>
                <?php } else { ?>
                    <div class="content__product">
                        <?= $loai['noi_dung_' . $lang] ?>
                    </div>

                <?php } ?>
            </div>

        </div>
    </div> -->
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


                <?php foreach ($loai2 as $k => $value) {
                    $sanpham = $d->o_fet("select * from #_sanpham where hien_thi = 1  and id_loai = " . $value["id"] . " and style=0 order by so_thu_tu asc, id desc");


                ?>
                    <div class="lo test <?= !$k ? "active" : "" ?>" data-id="<?= $value['id'] ?>">
                        <div class="row " style="margin:10px 0">
                            <div class="item-content-prm2 <?= !$k ? "active" : "" ?>">
                                <?php foreach ($sanpham as $key => $item) {
                                    $more = "";
                                    $link = "";
                                    if ($item['video']) {
                                        $more .= "video-l";
                                    }
                                    if ($item["doc"]) {
                                        $more .= "doc-l";
                                    }

                                    if ($item["video"]) {
                                        $link = $item["video"];
                                    } else {
                                        $link = $item["doc"];
                                    }

                                ?>
                                    <div class="col-md-3 col-sm-4 col-xs-12">
                                        <div class="item__prodoc1 <?= $more ?>">
                                            <a target="blank" href="<?= $link ?>">
                                                <img src="<?= URLPATH . 'img_data/images/' . $item['hinh_anh'] ?>" alt="<?= $item['ten_' . $lang] ?>">
                                                <br>
                                                <h3><?= $item['ten_' . $lang] ?></h3>
                                                <hr>
                                                <h5><?= $item['mo_ta_' . $lang] ?></h5>
                                            </a>
                                        </div>
                                    </div>
                                <?php  } ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>

            </div>
        </div>
        <br><br>
    <?php } ?>
<?php } ?>

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