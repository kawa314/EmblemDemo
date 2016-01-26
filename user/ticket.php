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
            <li><a href="home.php">Home</a></li>
						<li class="active"><a href="ticket.php">TicketList</a></li>
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

    	<label class="h5">Hi! : <?php print($userRow['user_name']); ?></label>
        <hr />

<?php
	if(!isset($_GET['tid'])){
		?>
        <p class="h4">TicketInventory</p><hr />

<table class="table table-striped">
<tr><td>TicketID</td><td>IssuedDate</td><td>Quantity</td></tr>
<?php
	$sale = new SALE();
	$stmt = $sale->runQuery("SELECT * FROM sale WHERE user_id=:user_id");
	$stmt->bindparam(":user_id", $user_id);
	$stmt->execute();
	while($saleRow = $stmt->fetch(PDO::FETCH_OBJ)){
		?>
		<tr><td><?php echo $saleRow->ticket_id; ?></td><td><a href="?tid=<?php echo $saleRow->ticket_id; ?>"><?php echo $saleRow->date; ?></a></td><td><?php echo $saleRow->quantity; ?></td></tr>
<?php
	}
} else {
	$ticket_detail = new TICKET();
	$stmt = $ticket_detail->runQuery("SELECT * FROM ticket WHERE ticket_id ='" . $_GET['tid'] . "'");
	$stmt->execute();
	$ticketRow = $stmt->fetch(PDO::FETCH_OBJ);
?>
<p class="h4">TicketDetail | <?php echo $ticketRow->name; ?></p><hr />
<p>TicketID: <?php echo $ticketRow->ticket_id; ?></p>
<p>TicketName: <?php echo $ticketRow->name; ?></p>
<p>Price: <?php echo $ticketRow->price; ?>円</p>
<p>Detail: <?php echo $ticketRow->detail; ?></p>
<?php
}
?>



</table>

    </div>

</div>

<script src="bootstrap/js/bootstrap.min.js"></script>

</body>
</html>
