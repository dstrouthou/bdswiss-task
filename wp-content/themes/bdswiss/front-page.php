<?php
get_header();
?>
<div class="full-width-layout">
    <div class="container mb-5">
        <div class="bdswiss-video">
            <?php if (!empty(get_field('home_banner_link'))): ?>
            <div class="video-container">
                <iframe src="<?php echo get_field('home_banner_link'); ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"></iframe>
            </div>
            <?php endif; ?>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="feeds-block">
                    <?php
                        $feeds = get_field('home_feeds_list');
                        if (!empty($feeds)) {
                            foreach ($feeds as $item) {
                                printf('<div class="feed-block__item">
                                    <div class="feed-block__item-title">
                                        <img src="%s" alt="">
                                        <div class="feed-description">%s</div>
                                    </div>
                                    <div class="feed-block__item-content">%s</div>
                                </div>', $item['feed_image'], $item['feed_description'], do_shortcode($item['feed_shortcode']));
                            }
                        }
                    ?>
                </div>
            </div>
        </div>

        <div class="register-block">
            <hr>
            <div class="row">
                <div class="col-10 offset-1">
                    <h2><?php echo get_field('start_trading_heading'); ?></h2>
                    <p><?php echo get_field('start_trading_subheading'); ?></p>
                </div>
            </div>
            <div class="row">
                <div class="col-12 mt-5">
                    <div class="row">
                        <?php
                        $sti = get_field('start_trading_items');
                        if (!empty($sti)) {
                            foreach ($sti as $item) {
                                printf('<div class="col-lg-3 col-sm-6 col-xs-12">
                                        <div class="registration-block__item">
                                            <img src="%s" alt="">
                                            <div class="title">%s</div>
                                            <div class="subtitle">%s</div>
                                        </div>
                                    </div>', $item['item_image'], $item['item_heading'], $item['item_content']);
                            }
                        }
                        ?>
                    </div>
                    <div class="btn-block text-center">
                        <a href="#" class="mb-2">OPEN AN ACCOUNT</a>
                        <small>Your capital is at risk</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="footer-block">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <p><strong>*Risk Warning: </strong> CFDs are complex instruments and come with a high risk of losing money rapidly due to leverage. <strong>79.5 % of retail investor accounts lose money when trading CFDs with this provider.</strong> You should consider whether you understand how CFDs work and whether you can afford to take the high risk of losing your money.</p>
                    <p>Swiss Markets and BDSwiss are registered trademarks of BDSwiss Holding Plc. BDSwiss Holding PLC is authorized and regulated by the Cyprus Securities and Exchange Commission (the "<a href="">CySEC</a>", license no. 199/13 and registration no. HE 300153). The address of BDSwiss Holding PLC is Apostolou Andrea Street 11, Hyper Tower, 5th Floor, 4007 Mesa Yeitonia, Limassol, Cyprus. Please review the company policies regarding the regulation <a href=""><u>here</u></a>.</p>
                    <p>Registered address: Ioanni Stylianou 6, 2nd floor, Office 202, 2003 Nicosia, Cyprus. For complaints please email us at <a href="">complaints@bdswiss.com</a></p>
                    <p>German address (for postal letters): Mainzer Landstrasse 41, 60329-Frankfurt, Germany</p>
                </div>
            </div>
        </div>
    </div>

</div>
<?php
get_footer();
?>