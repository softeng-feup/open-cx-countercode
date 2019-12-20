<?php

include_once('database/talk_q.php');
$talks = try_get_all_talks();

?>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
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
            <th>
            Duration
            </th>
            <th>
            Status
            </th>
            <th>
            Go to talk
            </th>
        </tr>
        </thead>
        <?php
        foreach ($talks as $talk) {
            $talk_id = $talk['talkID']; 
            $talk_info = try_get_talk_info_by_id($talk_id);
            $rating = try_get_talk_avg_rating_by_id($talk_id);
            $rating = substr($rating, 0, 4);
        	$now = time();
            $talk_duration = ($talk_info['date_end'] - $talk_info['date_start'])/3600;
            $talk_duration = substr($talk_duration, 0, 5);
            ?>
            
            <tbody>
                <tr>
                    
                    <td>
                        <img src="faces/face1.jpg" class="mr-2" alt="image">
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
                    <td>
                        <?php echo $talk_duration,' h'; ?>
                    </td>
                    <td>
                        <?php if($talk_info['date_end'] < $now) {
                            echo 'Rating:  ',$rating;
                        } else {
                            echo 'Scheduled';
                        } ?>
                    </td>
                    <td>
                    <form method="POST" action="talk_charts.php">
                    <input type="submit" id="talk_redirect" name="talk_id" value="<?php echo $talk_id ?>">
                    <i id="arrow" class="fas fa-arrow-right"></i>
                    </form>
                    </td>
                </tr>
        <?php } ?>
        </form>
        </tbody>
    </table>
    </div>
</div>

