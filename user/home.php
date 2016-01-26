<?php

	require_once("session.php");
	require_once("class.user.php");
	require_once("header.php");
?>
<nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="./">Emblem</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="home.php">Home</a></li>
						<li><a href="ticket.php">TicketList</a></li>
            <li><a href="store.php">Store</a></li>
            <li><a href="profile.php">Profile</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">

            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
			  <span class="glyphicon glyphicon-user"></span>&nbsp;Login: <?php echo $userRow['user_email']; ?>&nbsp;<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="profile.php"><span class="glyphicon glyphicon-user"></span>&nbsp;Profile</a></li>
                <li><a href="logout.php?logout=true"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Logout</a></li>
              </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>


    <div class="clearfix"></div>


<div class="container-fluid" style="margin-top:80px;">

    <div class="container">

    	<label class="h5">Hi!: <?php print($userRow['user_name']); ?></label>
        <hr />

        <p class="h4">Emblem</p>


    <p class="blockquote-reverse" style="margin-top:100px;">
    世界一身近なハンコ。<br /><br />

    </p>

    </div>

</div>

<script src="bootstrap/js/bootstrap.min.js"></script>

</body>
</html>
