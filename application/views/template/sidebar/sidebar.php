<div id="menu-main" class="menu menu-box-right menu-box-detached rounded-m" data-menu-width="260" data-menu-load="menu-main.html" data-menu-active="nav-welcome" data-menu-effect="menu-over" style="display: block; width: 260px;"><div class="menu-header">
    <a href="#" data-toggle-theme="" class="border-right-0"><i class="fa font-12 color-yellow2-dark fa-lightbulb"></i></a>
    <a href="#" data-menu="menu-highlights" class="border-right-0"><i class="fa font-12 color-gree2n-dark fa-brush"></i></a>
    <a href="#" data-menu="menu-share" class="border-right-0"><i class="fa font-12 color-red2-dark fa-share-alt"></i></a>
    <a href="index-settings.html" class="border-right-0"><i class="fa font-12 color-blue2-dark fa-cog"></i></a>
    <a href="#" class="close-menu border-right-0"><i class="fa font-12 color-red2-dark fa-times"></i></a>
</div>

<div class="menu-logo text-center">
    <a href="#"><img class="rounded-circle bg-highlight" width="80" src="<?= base_url('assets/images/logo/app.png') ?>"></a>
    <h1 class="pt-3 font-800 font-28 text-uppercase">Al-Fath</h1>
    <p class="font-11 mt-n2">Admin<span class="color-highlight">color</span> in your life.</p>
</div>

<div class="menu-items mb-4">
    <h5 class="text-uppercase opacity-20 font-12 ps-3">Menu</h5>
    <a id="nav-welcome" href="<?php echo base_url() ?>" class="nav-item-active">
        <i data-feather="home" data-feather-line="1" data-feather-size="16" data-feather-color="blue2-dark" data-feather-bg="blue2-fade-dark"></i>
        <span>Dashboard</span>
        <em class="badge bg-highlight color-white">HOT</em>
        <i class="fa fa-circle"></i>
    </a>

    <a href="#" data-submenu="sub-kelas">
        <i data-feather="grid" data-feather-line="1" data-feather-size="16" data-feather-color="green2-dark" data-feather-bg="green2-fade-dark"></i>
        <span>Kelas</span>
        <strong class="badge bg-highlight color-white">3</strong>
        <i class="fa fa-circle"></i>
    </a>
    <div id="sub-kelas" class="submenu">
        <a href="<?php echo base_url('kelas') ?>"><i class="fa fa-magic color-blue2-dark font-16 opacity-30"></i><span>Nama Kelas</span><i class="fa fa-circle"></i></a>
    </div>

     <a href="#" data-submenu="sub-setting">
        <i data-feather="settings" data-feather-line="1" data-feather-size="16" data-feather-color="red2-dark" data-feather-bg="red2-fade-dark"></i>
        <span>Setting</span>
        <strong class="badge bg-highlight color-white">3</strong>
        <i class="fa fa-circle"></i>
    </a>
    <div id="sub-setting" class="submenu">
        <a href="<?php echo base_url('datakelas') ?>"><i class="fa fa-sitemap color-blue2-dark font-16 opacity-30"></i><span>Kelas</span><i class="fa fa-circle"></i></a>
        <a href="<?php echo base_url('dataguru') ?>"><i class="fa fa-user color-green2-dark font-16 opacity-30"></i><span>Guru</span><i class="fa fa-circle"></i></a>
        <a href="<?php echo base_url('datatahfidz') ?>"><i class="fa fa-bookmark color-magenta2-dark font-16 opacity-30"></i><span>Tahfidz</span><i class="fa fa-circle"></i></a>
         <a href="<?php echo base_url('datasantri') ?>"><i class="fa fa-address-card color-red2-dark font-16 opacity-30"></i><span>Santri</span><i class="fa fa-circle"></i></a>
    </div>

    <a href="#" class="close-menu">
        <i data-feather="x" data-feather-line="1" data-feather-size="16" data-feather-color="red2-dark" data-feather-bg="red2-fade-dark"></i>
        <span>Close</span>
        <i class="fa fa-circle"></i>
    </a>
</div>

</div>