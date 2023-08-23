<header id="header" class="fixed-top">
  <div class="container d-flex align-items-center">

    <h1 class="logo mr-auto"><a href="./index.php?page=home">DRIVER  PANEL</a></h1>

    <nav class="nav-menu d-none d-lg-block" id='top-nav'>
      <ul>
        <li class="nav-dashboard"><a href="./index.php?page=dashboard">DASHBOARD</a></li>
        <li class="nav-driver_booked"><a href="./index.php?page=driver_booked">Booked customers</a></li>
        <li class="nav-driver_earnings"><a href="./index.php?page=driver_earnings">EARNINGS</a></li>
        <!-- <li class="nav-booked"><a href="./index.php?page=book/booked">Vehicle Information</a></li> -->
      
        <!-- <li><a href="./index.php?page=bus/bus">Bus List</a></li> -->
         <!-- <li><a href="./index.php?page=location/location">Location List</a></li> -->
        <li><a href="./logout.php">Logout</a></li>
      </ul>
    </nav><!-- .nav-menu -->


  </div>
</header>
<script>
  $(document).ready(function () {
    var page = '<?php echo isset($_GET['page']) ? $_GET['page'] : '' ?>';
    if (page != '') {
      $('#top-nav li').removeClass('active')
      $('#top-nav li.nav-' + page).addClass('active')
    }
    $('#manage_account').click(function () {
      uni_modal('Manage Account', 'user/manage_account.php')
    })
  })

</script>