    <!-- banner part start-->
    <section class="banner_part">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-xl-6">
                    <div class="banner_text">
                        <div class="banner_text_iner">
                            <h1>Welcome to</h1>
                            <h2>Universitas Internasional Batam</h2>
                            <p>University with international quality standard that produces graduates, science, technology and arts that can meet global dynamic changes.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--::review_part start::-->
    <section class="special_cource padding_top" id="sertifikasi">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-5">
                    <div class="section_tittle text-center">
                        <p>Batch Sertifikasi</p>
                        <h2>Sertifikasi</h2>
                    </div>
                </div>
            </div>

            <!-- Sertififkasi -->
            <?php  

            foreach($batch as $b)
            {
                ?>
                <div class="row justify-content-center">
                    <div class="col-sm-6 col-lg-4">
                        <div class="single_special_cource">
                            <img src="<?php echo base_url('assets/banner_batchsertifikasi/' . $b->bs_banner) ?>" class="special_img" alt="">
                            <div class="special_cource_text">
                                <a href="<?php echo base_url('home/detail/' . $b->bs_id) ?>" class="btn_4"><?php echo $b->cert_sertifikasi ?></a>
                                <a href="<?php echo base_url('home/detail/' . $b->bs_id) ?>"><h3><?php echo $b->cert_sertifikasi .' - '. $b->scert_subsertifikasi ?></h3></a>

                                <p style="margin-bottom: 0px;" class="text-dark">Biaya:</p>

                                <p class="text-dark" style="margin-bottom: 0px;">Mahasiswa : <?php echo 'Rp.' . number_format($b->bs_biaya_mhs, 2, ',','.') ?></p>
                                
                                <p class="text-dark">Umum : <?php echo 'Rp.' . number_format($b->bs_biaya_umum, 2, ',','.') ?></p>
                                
                                <hr>
                                
                                <p class="text-dark"><b>Tanggal Pendaftaran : <?php echo date('d M Y',strtotime($b->bs_mulai_daftar)) .' s.d. ' . date('d M Y',strtotime($b->bs_terakhir_daftar)) ?></b></p>
                                
                                <p><i class="fas fa-clock"></i> <b>Jadwal Ujian : <?php echo date('d M Y', strtotime($b->js_tanggal)) . ' <br>'  . $b->js_mulai .' - '. $b->js_selesai ?></b></p>
                                
                                <p><i class="fa fa-map-marker"></i> <b> Lokasi : <?php echo $b->js_tempat ?></b></p>
                            </div>
                        </div>
                    </div>
                </div>

                <?php 
            }
            ?>

            <!-- End Sertifikasi -->
        </div>
    </section>

    <!--::blog_part start::-->
    <section class="blog_part section_padding" id="seminar">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-5">
                    <div class="section_tittle text-center">
                        <p>Batch Seminar</p>
                        <h2>Seminar</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-lg-4 col-xl-4">
                    <div class="single-home-blog">
                        <div class="card">
                            <img src="<?php echo base_url() ?>/assets/frontend/img/blog/blog_1.png" class="card-img-top" alt="blog">
                            <div class="card-body">
                                <a href="#" class="btn_4">Design</a>
                                <a href="blog.html">
                                    <h5 class="card-title">Dry beginning sea over tree</h5>
                                </a>
                                <p>Which whose darkness saying were life unto fish wherein all fish of together called</p>
                                <ul>
                                    <li> <span class="ti-comments"></span>2 Comments</li>
                                    <li> <span class="ti-heart"></span>2k Like</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4 col-xl-4">
                    <div class="single-home-blog">
                        <div class="card">
                            <img src="<?php echo base_url() ?>/assets/frontend/img/blog/blog_2.png" class="card-img-top" alt="blog">
                            <div class="card-body">
                                <a href="#" class="btn_4">Developing</a>
                                <a href="blog.html">
                                    <h5 class="card-title">All beginning air two likeness</h5>
                                </a>
                                <p>Which whose darkness saying were life unto fish wherein all fish of together called</p>
                                <ul>
                                    <li> <span class="ti-comments"></span>2 Comments</li>
                                    <li> <span class="ti-heart"></span>2k Like</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4 col-xl-4">
                    <div class="single-home-blog">
                        <div class="card">
                            <img src="<?php echo base_url() ?>/assets/frontend/img/blog/blog_3.png" class="card-img-top" alt="blog">
                            <div class="card-body">
                                <a href="#" class="btn_4">Design</a>
                                <a href="blog.html">
                                    <h5 class="card-title">Form day seasons sea hand</h5>
                                </a>
                                <p>Which whose darkness saying were life unto fish wherein all fish of together called</p>
                                <ul>
                                    <li> <span class="ti-comments"></span>2 Comments</li>
                                    <li> <span class="ti-heart"></span>2k Like</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--::blog_part end::-->