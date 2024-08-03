<!-- rasha -->
<?php
$stmt_feed = $conn->prepare("SELECT feedbacks.comment,feedbacks.feedback_date, users.user_fname, users.user_lname
FROM feedbacks
JOIN users ON feedbacks.user_id = users.user_id");

$stmt_feed->execute();

$feedbacks = $stmt_feed->fetchAll(PDO::FETCH_ASSOC);

?>

<section>
  <h3 class="title_feedback"><b>What people think about us</b></h3>
  <swiper-container class="mySwiper" navigation="true">
  <?php foreach($feedbacks as $feedback):?>
    <swiper-slide>
      <div class="feedback_dives">
        <p class="p"><b><?php echo htmlspecialchars($feedback['user_fname'] ." ". $feedback['user_lname']); ?></b></p>
        <p><?php echo htmlspecialchars($feedback['comment']); ?></p>
        <p><?php echo $feedback['feedback_date']; ?></p>
      </div>
    </swiper-slide>
    <?php endforeach?>
  </swiper-container>
</section>