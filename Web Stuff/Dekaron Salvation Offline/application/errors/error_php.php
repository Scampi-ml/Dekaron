<style>
.error2 {
border: 1px solid;
margin: 10px 0px;
padding:15px 10px 15px 50px;
background-repeat: no-repeat;
background-position: 10px center;
background-color: #FFBABA;
color:#000000;
text-shadow:none;
font-family:Arial;

}
</style>

<div class="error2">
<h1>PHP Error!</h1>
<p><b>Severity:</b> <?php echo $severity; ?></p>
<p><b>Message:</b>  <?php echo $message; ?></p>
<p><b>Filename:</b> <?php echo $filepath; ?></p>
<p><b>Line Number:</b> <?php echo $line; ?></p>
</div>