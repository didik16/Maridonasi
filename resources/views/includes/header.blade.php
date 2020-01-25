<style>


#cari:hover{
    animation: hover-expand .2s linear 0s forwards;
    -moz-animation: hover-expand .2s linear 0s forwards;
    -ms-animation: hover-expand .2s linear 0s forwards;
    -o-animation: hover-expand .2s linear 0s forwards;
    -webkit-animation: hover-expand .2s linear 0s forwards;
}

</style>

<?php

function hari($h) {

    $ary_con = array("Sunday" => "Minggu", "Monday" => "Senin", "Tuesday" => "Selasa", "Wednesday" => "Rabu", "Thursday" => "Kamis", "Friday" => "Jumat", "Saturday" => "Sabtu");   

    foreach($ary_con as $key => $val){

        if($key==$h){
            $h = $val;
        }

    }

    $hari = $h;

    return $hari;

}

function bulan($b) {

    $ary_con = array("January" => "Januari", "February" => "Februari", "March" => "Maret", "April" => "April", "Mey" => "Mei", "June" => "Juni", "July" => "Juli", "August" => "Agustus", "September" => "September", "October" => "Oktober", "November" => "November", "December" => "Desember");   

    foreach($ary_con as $key => $val){

        if($key==$b){
            $b = $val;
        }

    }

    $bulan = $b;

    return $bulan;

}
    
?>



<div class="container-fluid" style="background: #23282c">
  <div class="container">
    <div class="row" >
      <div class="col-md-9">
        <ul class="nav-atas garis">
          <li><a href="#"><i class="far fa-calendar-alt"></i><?php echo ' '.hari(date('l')).', '.date('d').' '.bulan(date('F')).' '.date('Y'); ?></a></li>
          <li><a href="https://beritabali.com/aboutus/2/Tentang-Kami.html">Tentang Kami</a></li>
        </ul>
      </div>
      <div class="col-md-3">
        <ul class="nav-atas" style="float: right;">
          <li><p style="color: white;margin-bottom: 0">Ikuti Kami </p><li>
          <li><i class="fab fa-facebook-square"></i></li>
          <li><i class="fab fa-instagram"></i></li>
          <li><i class="fab fa-youtube"></i></li>
        </ul>
      </div>
    </div>
  </div>
</div>

<?php $parameters = \Request::segment(1);
  if($parameters==""){
   ?>
      <nav class="navbar navbar-expand-lg navbar-light bg-light " id="navbar" style="padding:8px 0;z-index: 9999">
   <?php }else{ ?>
      <nav class="navbar navbar-expand-lg navbar-light bg-light " id="navbar" style="padding:8px 0;z-index: 9999;background: linear-gradient(45deg,#ffa638 0%, #ff5656 100%)!important;border-bottom: 4px solid #9d363624">
  <?php } ?>

  <div class="container">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a  href="/">
        <img src="{{ asset('assets/img//icon/logopanjangputih.png') }}" alt="logo" id="logo_head" style="width:100%;">
    </a>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
      <ul class="navbar-nav mr-auto mt-2 mt-lg-0" style="padding: 0 10px">
        <li class="nav-item">
          <a class="nav-link" href="#" style="font-weight: bold;color: white"><i class="fas fa-child"></i> GALANG DANA</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#" id="" style="font-weight: bold;color: white"><i class="fas fa-hand-holding-heart"></i> CAMPAIGN</a>
        </li>
      </ul>
        <div style="display:unset;transition: all 500ms;position: absolute;right: 0;z-index:999999;width: 10%;opacity:0;right: 280px;" id="cari" class="input-head">
        <!-- Brand and toggle get grouped for better mobile display -->
              
              <form style="margin:0">
                  <input  type="text" name="search"  placeholder="Pencarian.." style="color:black">
            </form>
   
        </div>
      <img src="http://beritabali.tv/uploads/search.png" id="tombol_cari" width="16px" style="margin: 0 15px;">

      
        @if (Auth::check())
          @if ( Auth::user()->role == "user")
            <a href="/dashboard" class="tombol-n1">DASHBOARD</a>
          @else
            <a href="/dashboard_admin" class="tombol-n1">DASHBOARD</a>
          @endif
       @else
          <a href="/login" class="tombol-n1">MASUK/DAFTAR</a>
      @endif
    </div>
  </div>
</nav>

<script type="text/javascript">
// When the user scrolls the page, execute myFunction
window.onscroll = function() {myFunction()};

// Get the navbar
var navbar = document.getElementById("navbar");

// Get the offset position of the navbar
var sticky = navbar.offsetTop;

// Add the sticky class to the navbar when you reach its scroll position. Remove "sticky" when you leave the scroll position
function myFunction() {
  if (window.pageYOffset >= sticky) {
    navbar.classList.add("sticky")
   
  } else {
    navbar.classList.remove("sticky");

  }
}
</script>


<script>
$(document).ready(function(){
  $("#tombol_cari").hover(function(){
    $('#cari').css("width", "30%");
    $('#cari').css("opacity", "1");


    }, function(){
    $('#cari').css("width", "10%");
    $('#cari').css("opacity", "0");

  });
});
</script>


<script>
$(document).ready(function(){
  $("#cari").hover(function(){
    $('#cari').css("opacity", "1");
        $('#cari').css("width", "30%");
    }, function(){
    $('#cari').css("opacity", "0");
        $('#cari').css("width", "10%");
  });
});
</script>



