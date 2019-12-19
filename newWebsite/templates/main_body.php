<?php include_once('database/connection.php'); ?>


<?php
    $talks = try_get_all_talks();
?>

<div class="card-body">
    <div class="table-responsive">
    <table id="table">
        <thead>
        <tr>
            <th>
            Speaker
            </th>
            <th>
            Subject
            </th>
            <th>
            Room
            </th>
            <th>
            Date
            </th>
        </tr>
        </thead>
        <?php
        foreach ($talks as $talk) {
            $talk_id = $talk['talkID']; 
            $talk_info = try_get_talk_info_by_id($talk_id); 
            ?>
            
            <tbody>
            <form method="get" action="templates/talk_charts.php">
                <tr>
                    <input type="submit" id="talk_redirect" name="talk_id" value="<?php echo $talk_id ?>">
                    <td class="py-1">
                    <img src="faces/nelson.jpg" class="mr-2" alt="image">
                    <?php echo $talk_info['name']; ?>
                    </td>
                    <td>
                    <?php echo $talk_info['title']; ?>
                    </td>
                    <td>
                        <?php echo $talk_info['roomID']; ?>
                    </td>
                    <td>
                        <?php echo date('d-m-Y',$talk_info['date_start']); ?>
                    </td>
                    </input>
                </tr>
        <?php } ?>
        </form>
        </tbody>
    </table>
    </div>
</div>

