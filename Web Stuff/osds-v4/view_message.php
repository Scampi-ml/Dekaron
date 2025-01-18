<?php 
include "header.php";
?>
<script language="JavaScript">
	function delete_msg(){
		var answer=confirm("Are you sure you want to delete this message?")
		if(answer)
		window.location="view_message.php?id=<?php echo $_GET['id']; ?>&delete=<?php echo $_GET['id']; ?>"
	}
</script>
<?php

// -----------------------------------
// Get the message id
// ----------------------------------- 
$GET_MESSAGE_ID = $_GET['id'];

// -----------------------------------
// Do we have a message id ?
// -----------------------------------
if ($GET_MESSAGE_ID == "")
{
	echo '<div class="error msg">Error getting message id. Please try again.</div>';
	include "footer.php";
	die();
}

// -----------------------------------
// Delete message?
// -----------------------------------
if(isset($_GET['delete']))
{
	$delete_message = $db->query('DELETE FROM account.dbo.inbox WHERE id = ' . $GET_MESSAGE_ID . ' ');
	if(!delete_message)
	{
		echo '<div class="error msg">ERROR! Message is not deleted!</div>';
	} else {
		echo '<div class="success msg">Message deleted!<br><a href="inbox.php"> Go back to your inbox</a></div>';
		include "footer.php";
		die();
	}
}

// -----------------------------------
// Get all info
// -----------------------------------
$query = $db->query('SELECT * FROM account.dbo.inbox WHERE id = ' . $GET_MESSAGE_ID . ' ');
$getInboxData = $db->fetchArray($query);

if($getInboxData['viewed'] == 0)
{
	// user did read the message, set viewed to 1 => read
	$update = $db->query('UPDATE account.dbo.inbox SET viewed = 1 WHERE id = ' . $GET_MESSAGE_ID . ' ');
} else {
	// user has already read the message, do not update it again 
}

$query2 = $db->query('SELECT * FROM account.dbo.user_profile WHERE user_no = '.$getInboxData['from_user_no'].' ');
$getInboxDataName = $db->fetchArray($query2);

$query3 = $db->query('SELECT * FROM account.dbo.user_profile WHERE user_no = '.$getInboxData['user_no'].' ');
$getInboxDataName2 = $db->fetchArray($query3);

// -----------------------------------
// Start HTML
// -----------------------------------
echo '
<article>
	<h1>View Message</h1>
	<div style="float:right;">
		<a href="inbox.php"> Go back to your inbox</a>
	</div>
	<ul class="comments">
		<li>
			<div class="comment-body clearfix">
					<b>From:</b> ' . $getInboxDataName['user_id'] . '<br>
					<b>To:</b> ' . $getInboxDataName2['user_id'] . '<br>
					<b>Subject:</b> ' . $getInboxData['subject'] . '<br>
					<hr>
					' . $getInboxData['message'] . '
			</div>
			<div class="links">
				<span class="date">Send on ' . $getInboxData['inbox_time'] . '</span>
				<a class="delete" onclick="delete_msg()" href="#" >Delete Message</a>
			</div>
		</li>
	</ul>
	<br>
	<div class="information msg">
		At this time you cannot send a message back, but you can <a href="create_message.php">create a new one</a> if you want.
	</div>
			
	
</article>';

include "footer.php";
?>