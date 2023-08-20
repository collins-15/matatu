<header id="header" class="fixed-top">
  <div class="container d-flex align-items-center">

    <h1 class="logo mr-auto"><a href="./index.php?page=home">SUPER METRO</a></h1>

    <nav class="nav-menu d-none d-lg-block" id='top-nav'>
      <ul>
        <li class="nav-home"><a href="./index.php?page=home">Home</a></li>
        <li class="nav-about"><a href="./index.php?page=about">About us</a></li>
        <li class="nav-contact"><a href="./index.php?page=contact">Contact us</a></li>
        <li class="nav-schedule"><a href="./index.php?page=schedule/schedule">Our Schedule</a></li>
        <li class="nav-checkbook"><a href="./index.php?page=book/checkbook">check Booked</a></li>
        <li class="nav-admin"><a href="./index.php?page=admin">Admin (Login)</a></li>
      </ul>
    </nav>


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
      uni_modal('Manage Account', 'manage_account.php')
    })
  })

</script>