<?php
include ('header.php');
include ('sidebar.php');

$ticket_id = $_GET['id'];
$readed = $dekaron->SQLquery("UPDATE tickets.dbo.tickets SET read = 'On' WHERE ticket_id = '".$ticket_id."' And user_no = '".$_SESSION['USERNO']."' ");

$view = $dekaron->SQLquery("SELECT * FROM tickets.dbo.tickets WHERE	ticket_id = '".$ticket_id."' AND user_no = '".$_SESSION['USERNO']."' ");

?>
<!-- Main Section -->
<section class="main-section grid_7">
    <div class="main-content">
        <header>
            <ul class="action-buttons clearfix fr">
                <li><a href="documentation/index.html" class="button button-gray no-text help" rel="#overlay"><span class="help"></span></a></li>
            </ul>
            <h2>Support Tickets</h2>
        </header>
        <section class="container_6 clearfix">
            <div class="grid_6">
            
            <button class="button button-gray" onclick="window.location=\'edit_guild.php?guild_code='.$getGuildCode['guild_code'].'\'" >Submit Ticket</button><br /><br />
            <?php
			if($get_ban == '1')
			{
				$get_ban_reason = $dekaron->SQLfetchArray($query);
				echo '<br><div class="message error"><h3>Error!</h3>Tickets system has been disabled from your account<br><br><b>Reason:</b> '.$get_ban_reason['reason'].'</div>';
				echo '</div></section></div></section>';
				include ('footer.php');
				die();
			}
			else
			{
				$query1 = $dekaron->SQLquery("SELECT * FROM tickets.dbo.tickets WHERE user_no = '".$_SESSION['USERNO']."' ORDER BY last_post_date DESC");
				
			
			?>
                <table class="datatable full paginate sortable">
                    <thead>
                        <tr>
                            <th>Subject</th>
                            <th>Status</th>
                        	<th>Ticket</th>
                        	<th>Date Sent</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
					while($getTickets = $dekaron->SQLfetchArray($query1))
					{
						if($getTickets['ticket'] == 'Open')
						{
							$ticket = '<font color="green">Open</font>';
						}
						else
						{
							$ticket = '<font color="red">Closed</font>';
						}
						
						if($getTickets['status'] == 'Pending')
						{
							$status = '<font color="#BE8E48"><span class="pen"><img class="pen" src="images/ticket_images/ico_hourglass.jpg"></span> Pending</font>';
						}
						else
						{
							$status = '<font color="green">Replied</font>';
						}

					?>
					<tr>
							<td>&nbsp;<a href="view_ticket.php?ticket&id=<?php echo $getTickets['id']; ?>" id="view"><?php echo $dekaron->bbcode($Subjects); ?></a></td>
							<td><?php echo $Status; ?></td>
							<td><?php echo $ticket; ?></td>
							<td><?php echo $getTickets['date_sent']; ?></td>

					</tr>
			<?php
				}
				?>
                </tbody>
            </table>
			<?php
            }
			?>
            </div>
        </section>
    </div>
</section>
<!-- Main Section End -->
<?php include ('footer.php'); ?>