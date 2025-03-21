<?php
    $cta = get_field('cta', get_the_ID());
    $camping_banner = get_field('camping_banner', get_the_ID());
    $camping_info = get_field('camping_information', get_the_ID());
    $camping_gallery = get_field('camping_gallery', get_the_ID());
    $camping_memories = get_field('camping_memories', get_the_ID());
    $camping_current = get_field('camping_current', get_the_ID());
    $promo_top = get_field('promo_top', get_the_ID());
    $promo_bot = get_field('promo_bot', get_the_ID());
    $camping_flavor = get_field('camping_flavor', get_the_ID());
    $camping_contact = get_field('camping_contact', get_the_ID());
    $camping_registration = get_field('camping_registration', get_the_ID());
    $thanks = get_field('thanks', get_the_ID());
    $summer_camp_before = get_field('summer_camp_before', get_the_ID());
    $feedback = get_field('feedback', get_the_ID());
?>

<?php get_header();?>

    <section class="banner" style="background-image: url('<?php echo $camping_banner['banner_image'];?>');">
        <div class="container banner-wrap" data-aos="fade-down" data-aos-duration="2000">
            <h1 class="outline-text"><?= $cta['title']; ?></h1>
            <p class="outline-content"><?= $cta['description']; ?></p>
            <div class="register-btn">
                <a href="#register">Đăng ký ngay</a>
            </div>
        </div>
    </section>

    <section id="information" class="camping-info">
        <div class="container">
            <div class="camping-info-content">
                <div class="camping-info-left camping-title" data-aos="fade-right" data-aos-duration="2000">
                    <h5><?php echo $camping_info['subtitle'];?></h5>
                    <h1><?php echo $camping_info['title'];?></h1>
                </div>
                <div class="camping-info-right">
                    <div class="camping-info-description">
                        <p><?php echo $camping_info['description'];?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="camping-gallery">
        <div class="camping-horizontal-gallery">
            <div class="camping-image-list">
                <?php if ($camping_gallery):
                    foreach ($camping_gallery as $item): ?>
                        <img src="<?php echo $item['image'];?>" alt="Image 1">
                    <?php endforeach;
                endif;?>
            </div>
        </div>
    </section>


    <section class="camping-memories">
        <div class="container">
            <div class="camping-memories-top camping-title">
                <h5><?php echo $camping_memories['camping_memories_title']['subtitle'];?></h5>
                <h1><?php echo $camping_memories['camping_memories_title']['title'];?></h1>
                <p>
                    <?php echo $camping_memories['camping_memories_title']['description'];?>
                </p>
            </div>
            <?php if ($camping_memories['camping_memories_content']):
                foreach ($camping_memories['camping_memories_content'] as $layout):
                    switch ($layout['acf_fc_layout']):
                        case 'content_top':?>
                            <div class="camping-memories-center">
                                <div class="left my-auto" data-aos="fade-right" data-aos-duration="2000">
                                    <img src="<?php echo $layout['image_left'];?>">
                                </div>
                                <div class="right">
                                    <p>
                                        <?php echo $layout['text_right'];?>
                                    </p>
                                    <img class="image-position"
                                         src="<?php echo $layout['image_right'];?>">
                                </div>
                            </div>
                            <?php break;
                        case 'content_bot':?>
                            <div class="camping-memories-bot">
                                <div class="left">
                                    <p>
                                        <?php echo $layout['text_left'];?>
                                    </p>
                                </div>
                                <div class="right my-auto" data-aos="fade-left" data-aos-duration="2000">
                                    <img src="<?php echo $layout['image_right'];?>">
                                </div>
                            </div>
                            <?php break;?>
                    <?php endswitch;?>
                <?php endforeach;?>
            <?php endif; ?>
        </div>
    </section>

    <section class="promo-section background-scroll" style="background-image: url('<?php echo $promo_top['promo_image'];?>');">
        <div class="promo-title">
            <h1><?php echo $promo_top['promo_text']['text_1'];?></h1>
            <h2><?php echo $promo_top['promo_text']['text_2'];?></h2>
        </div>
    </section>

    <section class="camping-current" data-aos="fade-up" data-aos-duration="1000" data-aos-easing="ease">
        <div class="container">
            <div class="camping-current-title camping-title">
                <h5><?php echo $camping_current['camping_current_title']['subtitle'];?></h5>
                <h1><?php echo $camping_current['camping_current_title']['title'];?></h1>
            </div>
            <div class="camping-current-list">
                <?php if ($camping_current['camping_current_content']):
                    foreach ($camping_current['camping_current_content'] as $layout):
                        switch ($layout['acf_fc_layout']):
                            case 'content_image_left':?>
                                    <div class="camping-current-item">
                                        <div class="item-image">
                                            <img src="<?php echo $layout['image'];?>">
                                        </div>
                                        <div class="item-content">
                                            <div class="item-content-top">
                                                <h5><?php echo $layout['subtitle'];?></h5>
                                                <h3><?php echo $layout['title'];?></h3>
                                            </div>
                                            <div class="item-content-center">
                                                <p><?php echo $layout['text_content'];?></p>
                                            </div>
                                            <div class="line">
                                                <b></b>
                                            </div>
                                        </div>
                                    </div>
                                <?php break;
                            case 'content_image_right':?>
                                    <div class="camping-current-item">
                                        <div class="item-content">
                                            <div class="item-content-top">
                                                <h5><?php echo $layout['subtitle'];?></h5>
                                                <h3><?php echo $layout['title'];?></h3>
                                            </div>
                                            <div class="item-content-center">
                                                <p><?php echo $layout['text_content'];?></p>
                                            </div>
                                            <div class="line">
                                                <b></b>
                                            </div>
                                        </div>
                                        <div class="item-image">
                                            <img src="<?php echo $layout['image'];?>">
                                        </div>
                                    </div>
                                <?php break;?>
                        <?php endswitch;
                    endforeach;
                endif;?>
            </div>
        </div>
    </section>

    <section class="camping-flavor">
        <div class="container" data-aos="fade-up" data-aos-duration="1000" data-aos-easing="ease">
            <div class="camping-flavor-title camping-title">
                <h5><?php echo $camping_flavor['camping_flavor_title']['subtitle'];?></h5>
                <h1 class="title"><?php echo $camping_flavor['camping_flavor_title']['title'];?></h1>
                <p class="">
                    <?php echo $camping_flavor['camping_flavor_title']['description'];?>
                </p>
            </div>
            <div class="camping-flavor-content">
                <?php if ($camping_flavor['camping_flavor_content']):
                    foreach ($camping_flavor['camping_flavor_content'] as $item):?>
                        <div class="camping-flavor-item">
                            <img src="<?php echo $item['content_image'];?>" alt="<?php echo $item['content_title'];?>" class="flavor-image">
                            <div class="flavor-content mt-3">
                                <h2><?php echo $item['content_title'];?></h2>
                                <p><?php echo $item['content_description'];?></p>
                            </div>
                        </div>
                    <?php endforeach;
                endif;?>
            </div>
        </div>
    </section>

    <section class="promo-section background-scroll" style="background-image: url('<?php echo $promo_bot?>');">
    </section>

    <section id="contact" class="camping-contact">
        <div class="container">
            <div class="camping-contact-group p-3">
                <div class="contact-image">
                    <img class="image" src="<?php echo $camping_contact['image'];?>">
                </div>
                <div class="contact-content camping-title">
                    <h5 class="contact-subtitle"><?php echo $camping_contact['subtitle'];?></h5>
                    <h2 class="contact-title"><?php echo $camping_contact['title'];?></h2>
                    <p class="contact-description">
                        <?php echo $camping_contact['description'];?>
                    </p>
                    <div class="contact-info">
                        <p><a href="tel:0911866511"><i class="fa fa-phone text-white" aria-hidden="true"></i> <?php echo $camping_contact['phone'];?></a></p>
                        <p><a href="us@congcaphe.com"><i class="fa fa-envelope-o text-white" aria-hidden="true"></i> <?php echo $camping_contact['email'];?></a></p>
                    </div>
<!--                    <div class="register-btn">-->
<!--                        <a href="#register">Đăng ký ngay</a>-->
<!--                    </div>-->
                </div>
            </div>
        </div>
    </section>

    <section id="register" class="camping-registration">
        <div class="container">
            <div class="camping-registration-title camping-title">
                <h5><?php echo $camping_registration['camping_registration_title']['subtitle'];?></h5>
                <h1> <?php echo $camping_registration['camping_registration_title']['title'];?> </h1>
            </div>
            <div class="camping-registration-content">
                <div class="register-form">
                    <h2><?php echo $camping_registration['camping_registration_content']['form_title'];?></h2>
                    <?php echo do_shortcode('[custom_registration_form]'); ?>
                </div>
                <div class="register-image">
                    <img src="<?php echo $camping_registration['camping_registration_content']['form_image'];?>" alt="Group of children enjoying a class">
                </div>
            </div>
        </div>
    </section>
<section class="camping-part">
    <div class="container mt-5">
        <h2 class="camping-part-title text-center"><?= $summer_camp_before['title']?></h2>

        <div class="d-flex flex-column justify-content-center align-items-center">
            <!-- Tabs -->
            <ul class="nav nav-tabs mt-4" id="campTabs" role="tablist">
                <?php foreach ($summer_camp_before['summer_camp_before_item'] as $index => $item) { ?>
                    <li class="nav-item">
                        <button class="camping-part-nav-link nav-link <?= $index === 0 ? 'active' : '' ?>"
                                id="year<?= $index ?>-tab"
                                data-bs-toggle="tab"
                                data-bs-target="#year<?= $index ?>"
                                type="button" role="tab">
                            <?= $item['title']; ?>
                        </button>
                    </li>
                <?php } ?>
            </ul>
            <div class="tab-content mt-3" id="campTabsContent">
                <?php foreach ($summer_camp_before['summer_camp_before_item'] as $index => $item) { ?>
                    <div class="tab-pane fade <?= $index === 0 ? 'show active' : '' ?>" id="year<?= $index?>" role="tabpanel">
                        <div class="d-flex justify-content-center align-items-center mb-5">
                            <p><?= $item['description']; ?></p>
                        </div>
                        <div class="row">
                            <?php foreach ($item['gallery'] as $img): ?>
                                <div class="col-md-4 mb-5">
                                    <img src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_attr($img['alt']); ?>">
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>

<section class="feedback">
    <div class="container my-5">
        <h2 class="feedback-title text-center mb-4"><?= $feedback['title']?></h2>
        <p class="feedback-description text-center text-muted mb-5">
            <?= $feedback['description']?>
        </p>

        <div id="feedbackCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <?php foreach ($feedback['item'] as $index => $item){?>
                    <div class="carousel-item <?= $index == 0 ? 'active' : '' ?>">
                    <div class="card shadow p-4">
                        <h5 class="fw-bold feedback-content"><?= $item['title']; ?></h5>
                        <p class="text-muted feedback-content"><?= $item['parent']; ?>:</p>
                        <p class="feedback-content">
                            <?= $item['content']; ?>
                        </p>
                    </div>
                </div>
                <?php } ?>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#feedbackCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Trước</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#feedbackCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Tiếp theo</span>
            </button>

            <div class="carousel-indicators">
                <button type="button" data-bs-target="#feedbackCarousel" data-bs-slide-to="0" class="active" aria-current="true"></button>
                <button type="button" data-bs-target="#feedbackCarousel" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#feedbackCarousel" data-bs-slide-to="2"></button>
                <button type="button" data-bs-target="#feedbackCarousel" data-bs-slide-to="3"></button>
                <button type="button" data-bs-target="#feedbackCarousel" data-bs-slide-to="4"></button>
            </div>
        </div>
    </div>
</section>


    <section class="thanks">
        <div class="thanks-img" style="background-image: url('<?php echo $thanks['bg_image'];?>');">
            <div class="container">
                <div class="thanks-content camping-title">
                    <div data-aos="fade-up"
                    data-aos-duration="1000"">
                    <h5><?php echo $thanks['subtitle'];?></h5>
                    <h1><?php echo $thanks['title'];?></h1>
                    <p>
                        <?php echo $thanks['description'];?>
                    </p>
                </div>

                </div>
            </div>
        </div>
    </section>

<?php get_footer();?>
