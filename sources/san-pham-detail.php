<?php
$ctsp = $d->o_fet("select * from #_sanpham where hien_thi = 1 and alias_" . $_SESSION['lang'] . " = '" . $com . "'");
$property = explode('@1@', $ctsp[0]['property']);
if (count($ctsp) == 0) $d->location(URLPATH . "404.html");
$loai = $d->simple_fetch("select * from #_category where hien_thi = 1 and id = " . $ctsp[0]['id_loai'] . " ");
$sanpham = $d->o_fet("select * from #_sanpham where hien_thi = 1  and id <> '" . @$ctsp[0]['id'] . "' and id_loai = '" . @$ctsp[0]['id_loai'] . "' order by id desc limit 0,6");
$hinh_anh_sp = $d->o_fet("select * from #_sanpham_hinhanh where id_sp = '" . @$ctsp[0]['id'] . "' order by id desc");

$list_color = $d->o_fet("select * from #_sanpham_phienban where type = 0 and id_sanpham = '" . $ctsp[0]['id'] . "'");
$list_size = $d->o_fet("select * from #_sanpham_phienban where type = 1 and id_sanpham = '" . $ctsp[0]['id'] . "'");
if ($ctsp[0]['gia'] == '') {
    $gia = '<span class="p-price gia-center">' . _lienhe . '</span>';
} else {
    if ($item['khuyen_mai'] == '') {
        $gia = '<span class="p-price gia-center">' . $ctsp[0]['gia'] . ' VNĐ</span>';
    } else {
        $gia = ' 
        <span class="p-price">' . $ctsp[0]['khuyen_mai'] . ' VNĐ</span>
        <span class="p-oldprice">' . $ctsp[0]['gia'] . ' VNĐ</span>';
    }
}
if ($ctsp[0]['gia'] == '' || $ctsp[0]['gia'] == 0) {
    $gia1 = '<span class="p-price gia-center">' . _lienhe . '</span>';
} else {

    $gia1 = '<span class="p-price gia-center">' . number_format((float)$ctsp[0]['gia']) . ' Đ</span>';
}
if ($ctsp[0]['khuyen_mai'] != '' || $ctsp[0]['khuyen_mai'] != 0) {
    $gia2 = '<span class="p-price gia-center">' . number_format((float)$ctsp[0]['khuyen_mai']) . ' Đ</span>';
}

$active = ($ctsp[0]['khuyen_mai'] != '' || $ctsp[0]['khuyen_mai'] != 0) ? 'active' : '';
if (isset($_POST['lienhe'])) {
    $d->reset();
    $data['ho_ten'] = addslashes($_POST['ho_ten']);
    $data['email'] = addslashes($_POST['email']);
    $data['sdt'] = addslashes($_POST['phone']);
    $data['noi_dung'] = addslashes($_POST['noi_dung']);
    $data['ngay_hoi'] = date('d-m-Y H:i:s');
    $data['trang_thai'] = '0';
    $data['tieu_de'] = "Liên hệ của sản phẩm: <a href=\"" . $url_page . "\">" . $ctsp[0]['ten_vn'] . "</a>";
    $d->setTable('#_lienhe');
    print_r($data);
    if ($d->insert($data)) {
        $d->alert("Gửi thành công!");
        $d->location($url_page);
    } else {
        $d->alert("Gửi thất bại");
    }
}
?>
<link rel="stylesheet" href="<?= URLPATH ?>templates/module/owlcarousel/assets/owl.carousel.min.css">
<link rel="stylesheet" href="<?= URLPATH ?>templates/module/owlcarousel/assets/owl.theme.default.min.css">
<link href="<?= URLPATH ?>templates/module/magiczoomplus/magiczoomplus.css" rel="stylesheet" />
<script src="<?= URLPATH ?>templates/module/magiczoomplus/magiczoomplus.js"></script>

<div class="container">
    <div class="row">

        <div class="col-md-12 col-sm-12">
            <!-- <h1 class="title-home-2-tt"><span><?= $ctsp[0]['ten_vn'] ?></span></h1> -->

            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-6 plr10">
                    <div class="owl-pro-slick spdetail">
                        <a id="Zoomer" href="<?= URLPATH ?>img_data/images/<?= $ctsp[0]['hinh_anh'] ?>" title="<?= $ctsp[0]['ten_' . $_SESSION['lang']] ?>" class="MagicZoomPlus" rel="zoom-width:300px; zoom-height:300px;selectors-effect-speed: 600; selectors-class: Active;">
                            <img onerror="this.src='<?= URLPATH ?>templates/error/error.jpg';" src="<?= URLPATH ?>thumb.php?src=<?= URLPATH ?>img_data/images/<?= $ctsp[0]['hinh_anh'] ?>&w=600&h=450&zc=2">
                        </a>
                    </div>
                    <div class="clearfix mb10"></div>
                    <?php if (!empty($hinh_anh_sp)) { ?>
                        <div id="sub_img_detail">
                            <div class="list_sub_img_detail list_pro_2">
                                <div class="owl_img_detail ">
                                    <div class=" item_owl_sub">
                                        <a href="<?= URLPATH ?>img_data/images/<?= $ctsp[0]['hinh_anh'] ?>" rel="zoom-id: Zoomer" rev="<?= URLPATH ?>thumb.php?src=<?= URLPATH ?>img_data/images/<?= $ctsp[0]['hinh_anh'] ?>&w=600&h=450&zc=2">
                                            <img src="<?= URLPATH ?>img_data/images/<?= $ctsp[0]['hinh_anh'] ?>" class="w100" />
                                        </a>
                                    </div>
                                    <?php foreach ($hinh_anh_sp as $key => $item) { ?>
                                        <div class=" item_owl_sub">
                                            <a href="<?= URLPATH ?>img_data/images/<?= $item['hinh_anh'] ?>" rel="zoom-id: Zoomer" rev="<?= URLPATH ?>thumb.php?src=<?= URLPATH ?>img_data/images/<?= $item['hinh_anh'] ?>&w=600&h=450&zc=2">
                                                <img src="<?= URLPATH ?>img_data/images/<?= $item['hinh_anh'] ?>" class="w100" />
                                            </a>
                                        </div>
                                    <?php } ?>
                                </div>
                                <!--owl img detail-->
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="col-md-6 col-sm-12">
                    <h1 class="title-sp"><?= $ctsp[0]['ten_' . $lang] ?></h1>
                    <div class="is-divider small"></div>
                    <div class="woocommerce-product-rating">
                        <a href="javascript:void(0)" class="woocommerce-review-link" rel="nofollow">
                            <div class="star-rating" role="img" aria-label="Rated 5.00 out of 5"><span style="width:100%">Rated <strong class="rating">5.00</strong> out of 5 based on <span class="rating">65</span> customer ratings</span></div>
                        </a>
                    </div>

                    <?php
                    $pricedown = $d->o_fet("select * from #_custom where idproduct = " . $ctsp[0]['id'] . " order by price asc");
                    $priceup = $d->o_fet("select * from #_custom where idproduct = " . $ctsp[0]['id'] . " order by price desc");

                    ?>
                    <div class="price_group">
                        <div class="price-begin">$<?= number_format($pricedown[0]['price'], 2, '.', '') ?> - $<?= number_format($priceup[0]['price'], 2, '.', '') ?></div>
                        <div class="price-end"></div>
                    </div>

                    <div>
                        <?= $ctsp[0]['mo_ta_' . $lang] ?>
                    </div>

                    

                    
                    <div>*SIZE (IN INCHES)</div>
                    <div class="size__group">
                        <?php 
                             $string = ltrim(rtrim($ctsp[0]['size'],','),',');
                             $listSizeSelect = $d->o_fet("select * from #_size where id in ($string)");
                             foreach($listSizeSelect as $key => $item) { 
                        ?>
                            <div class="item__size">
                            <input <?=$key == 0 ? 'checked':''?> onchange="getListNumber()"  name="size" type="radio" id="<?=$item['id'] ?>" value="<?=$item['id'] ?>">
				                <label for="<?=$item['id'] ?>"><?=$item['ten_vn'] ?></label>
                                </div>
                        <?php } ?>
                       
                    </div>

                    <div>*NUMBER OF CHARACTER(S) or PERSON(S)</div>
                    <div class="number__group">
                    
                    </div>
                    <hr>
                    <div id="id__price">
                        <!-- repon ajax getPrice() -->

                    </div>
                    <script>
                        var findSelected = (el) => {
                            var lists = document.querySelectorAll(el);
                            
                            for(var i = 0;i<lists.length;i++){
                                if(lists[i].checked){
                                    var id = lists[i].value;
                                    return id;
                                }
                            }
                        }
                        var getPrice = () => {
                            var idSize = findSelected('.item__size input');
                            var idPeople = findSelected('.number__group .item input');
                            $.ajax({
                                url:'sources/ajax.php',
                                method:'post',
                                dataType:'json',
                                data:{
                                    do:'getPrice',
                                    idSize:idSize,
                                    idPeople:idPeople,
                                    idProduct:'<?=$ctsp[0]['id']?>',
                                },
                                success:function(res){
                                   
                                    document.getElementById('id__price').innerHTML = res.price__format;
                                    document.getElementById('price__form').value = res.price;
                                }
                            });
                        }
                        // var getListSize = () => {
                        //     var id = findSelected('.number__group .item input');
                           
                        //     $.ajax({
                        //         url:'sources/ajax.php',
                        //         method:'post',
                        //         data:{
                        //             do:'getListSize',
                        //             people:id,
                        //             product:'<?=$ctsp[0]['id']?>',
                        //             size:'<?=$ctsp[0]['size']?>',
                        //         },
                        //         success:function(res){
                        //             document.querySelector('.size__group').innerHTML = res;
                        //             document.getElementById('id__price').innerHTML = "";
                        //             document.getElementById('price__form').value = "";
                        //         },
                        //     })  
                        // }
                        var getListNumber = () => {
                            var id = findSelected('.item__size input');
                           
                            $.ajax({
                                url:'sources/ajax.php',
                                method:'post',
                                data:{
                                    do:'getListNumber',
                                    size:id,
                                    product:'<?=$ctsp[0]['id']?>',
                                    
                                },
                                success:function(res){
                                    document.querySelector('.number__group').innerHTML = res;
                                    document.getElementById('id__price').innerHTML = "";
                                    document.getElementById('price__form').value = "";
                                },
                            })  
                        }
                        getListNumber();
                       
                    </script>

                    <div class="lienhe-sp">
                        <form method="post" action="<?= URLPATH . "order.html?step=1" ?>" enctype="multipart/form-data">

                            <input type="hidden" name="id" value="<?= $ctsp[0]['id'] ?>">
                            <!-- repon ajax getPrice() -->
                            <input type="hidden" name="price" id="price__form" value="">
                            <!-- end -->
                            <input required type="file" id="fileUpLoad" name="fileUpLoad[]" multiple>
                            <br>
                            <div class="row m-5">
                                <div class="col-sm-3 box-sl p5">
                                    <input type="number" value="1" name="soluong" class="soluong" />
                                    <div class="clearfix"></div>
                                </div>
                                <div class="col-sm-9 p5">
                                    <button type="submit" name="addOrder" class="btn btn-block btn-lienhe"><i class="fa fa-shopping-cart" aria-hidden="true"></i> ADD TO CART</button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
            <ul class="nav nav-tabs tab-sp">
                <li class="active"><a data-toggle="tab" href="#home"><?= ($lang == 'vn') ? 'DESCRIPTION' : 'Details'; ?></a></li>
                <li><a data-toggle="tab" href="#menu2">Information</a></li>
                <li><a data-toggle="tab" href="#menu3"><?= ($lang == 'vn') ? 'COMMENT' : 'Evaluate'; ?></a></li>
            </ul>
            <div class="tab-content">
                <div id="home" class="tab-pane fade in active">
                    <div class="chitiettin">
                        <?= $ctsp[0]['thong_tin_' . $lang] ?>
                    </div>
                </div>
                <div id="menu2" class="tab-pane fade">
                    <div class="chitiettin">
                        <?= $ctsp[0]['thong_so_' . $lang] ?>
                    </div>
                </div>
                <div id="menu3" class="tab-pane fade">
                    <div id="fb-root"></div>
                    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v8.0" nonce="hApgk4fp"></script>
                    <div style="width: 100%;" class="fb-comments" data-href="<?= URLPATH . $ctsp[0]['alias_' . $lang] ?>" data-numposts="5" data-width="1140"></div>
                </div>
            </div>

          
            
        </div>

    </div>
</div>

<script>
    jQuery('.thumb-item').on('click touch', function() {
        var img = $(this).attr('data-image');
        $('#Zoom-v').attr('href', img);
        $('#Zoom-v img').attr('src', img);
    });

    var mzOptions = {
        zoomMode: "magnifier"
    };
</script>
<script src="<?= URLPATH ?>templates/module/owlcarousel/owl.carousel.min.js"></script>
<script>
    $('.slide-sp').owlCarousel({
        loop: true,
        margin: 5,
        nav: true,
        dots: false,
        //autoplay:true,
        autoplayTimeout: 3000,
        responsive: {
            0: {
                items: 2
            },
            600: {
                items: 3
            },
            1000: {
                items: 4
            }
        }
    })
</script>