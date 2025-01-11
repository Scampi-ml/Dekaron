<?php
include ('header.php');
include ('sidebar.php');
?>  
<section class="main-section grid_7">
    <div class="main-content">
        <header>
            <h2>Postbox</h2>
        </header>
        <section class="container_6 clearfix">
            <div class="grid_6">
                <form action="postbox.php" method="get">
                    <select name="character">
                        <option value="">Select character</option>
                        <?php
                        foreach($_SESSION['CHARACTERS'] as $character)
                        {
                            $name_no = explode("-", $character);
                            if ($_GET['character'] == $name_no[0])
                            {
                                echo '<option value="'.$name_no[0].'" selected>'.$name_no[1].'</option>';
                            }
                            else
                            {
                                echo '<option value="'.$name_no[0].'">'.$name_no[1].'</option>';
                            }
                        }
                        ?>
                    </select>
                
                    <select name="where">
                        <option value="">Select where</option>
                            <?php
                                if ($_GET['where'] == 'inbox')
                                {
                                    echo '<option value="inbox" selected>Inbox</option>';
                                }
                                else
                                {
                                    echo '<option value="inbox">Inbox</option>';
                                }
                                if ($_GET['where'] == 'deleted')
                                {
                                    echo '<option value="deleted" selected>Deleted</option>';
                                }
                                else
                                {
                                    echo '<option value="deleted">Deleted</option>';
                                }
                            ?>
                    </select>	
                    <button type="submit" class="button button-gray" style="padding-top: 1px;">Get post</button>
                    
                </form>
                <br />
				<?php
                if(isset($_GET['where']) && isset($_GET['character']) && $dekaron->isValid($_GET['character']) == true && $dekaron->isValid($_GET['where']) == true && strlen($_GET['character']) == '18')
                {
                ?>
                    <table class="datatable paginate sortable full" align="center">
                        <thead>
                            <tr>
                                <th>From</th>
                                <th>Title</th>
                                <th>Message</th>
                                <th>Item</th>
                                <th>Dil</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                    <tbody>
                    <?php
                    if ($_GET['where'] == 'inbox')
                    {	
                        include 'items.php';
            
                        $query1 = $dekaron->SQLquery("SELECT * FROM character.dbo.user_postbox WHERE character_no = '".$_GET['character']."' ");
                        while($getPostbox = $dekaron->SQLfetchArray($query1))
                        {
                                echo "<tr>";
                                echo '<td>'.$getPostbox['from_char_nm'].'</td>';
                                echo '<td>'.$getPostbox['post_title'].'</td>';
                                echo '<td>'.$getPostbox['body_text'].'</td>';
                                echo '<td>'.$items[$getPostbox['wIndex']].'</td>';
                                echo '<td>'.$getPostbox['include_dil'].'</td>';
                                echo '<td>'.$getPostbox['ipt_time'].'</td>';
                                echo "</tr>";
                        }
                        echo '</tbody>';
                        echo '</table>';
                        
                    }
                    elseif ($_GET['where'] == 'deleted')
                    {
                        include 'items.php';
                    
                        $query2 = $dekaron->SQLquery("SELECT * FROM character.dbo.user_postbox_secede WHERE character_no = '".$_GET['character']."' ");
                        while($getPostbox = $dekaron->SQLfetchArray($query2))
                        {
                                echo "<tr>";
                                echo '<td>'.$getPostbox['from_char_nm'].'</td>';
                                echo '<td>'.$getPostbox['post_title'].'</td>';
                                echo '<td>'.$getPostbox['body_text'].'</td>';
                                echo '<td>'.$items[$getPostbox['wIndex']].'</td>';
                                echo '<td>'.$getPostbox['include_dil'].'</td>';
                                echo '<td>'.$getPostbox['ipt_time'].'</td>';
                                echo "</tr>";
                        }
                        echo '</tbody>';
                        echo '</table>';
                    }
                    else
                    {
                    }
                }
                ?>
            </div>
        </section>
    </div>
</section>
<?php include ('footer.php'); ?>