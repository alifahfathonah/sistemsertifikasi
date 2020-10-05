 <!-- breadcrumb start-->
 <section class="breadcrumb breadcrumb_bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb_iner text-center">
                    <div class="breadcrumb_iner_item">
                        <h2><?php echo $seminar->smr_acara ?></h2>
                        <p>Home<span>/</span><?php echo $seminar->smr_acara ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- breadcrumb start-->

<!--================ Start Course Details Area =================-->
<section class="course_details_area section_padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 course_details_left mt-0">
                <div class="content_wrapper">
                    <div class="content">
                        <?php echo $seminar->smr_keterangan ?>
                    </div>
                </div>
            </div>


            <div class="col-lg-4 right-contents">
                <div class="sidebar_top">
                    <ul>
                        <li>
                            <a class="justify-content-between d-flex">
                                <?php 
                                    foreach($narasumber as $n)
                                    {
                                ?>
                                    <p>Nama Narasumber</p>

                                    <span class="color"><?php echo $n->ns_narasumber ?></span>

                                <?php 
                                    }
                                ?>
                            </a>
                        </li>
                        <li>
                            <a class="justify-content-between d-flex">
                                <p>Tanggal Pelaksanaan </p>
                                <span><?php echo date('d M Y', strtotime($seminar->smr_tanggal)) ?></span>
                            </a>
                        </li>
                        <li>
                            <a class="justify-content-between d-flex">
                                <p>Waktu Pelaksanaan </p>
                                <span><?php echo $seminar->smr_jam_mulai .' - '. $seminar->smr_jam_selesai ?></span>
                            </a>
                        </li>

                    </ul>


                    <?php 
                        if(!$this->session->userdata('npm') && !$this->session->userdata('email'))
                        { 
                    ?>

                        <a href="#" class="btn_1 d-block">Daftar Mahasiswa</a>
                        <a href="#" class="btn_1 d-block">Daftar Umum</a>

                    <?php 
                        }
                    ?>

                    <?php 
                        if($this->session->userdata('npm'))
                        { 
                    ?>

                        <a href="#" class="btn_1 d-block">Daftar Mahasiswa</a>

                    <?php 
                        }
                    ?>


                    <?php 
                        if($this->session->userdata('email'))
                        { 
                    ?>

                        <a href="#" class="btn_1 d-block">Daftar Umum</a>

                    <?php 
                        }
                    ?>
                    
                </div>
            </div>
        </div>
    </div>
</section>
    <!--================ End Course Details Area =================-->