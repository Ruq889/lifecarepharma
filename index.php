<?php 

include_once('includes/conn.php');

$stmt=$connection->prepare("SELECT u.*,s.name AS speciality FROM users u
INNER JOIN specialities s ON s.id = u.speciality_id
WHERE u.is_active = 1 AND u.is_deleted = 0 AND u.role = 'doctor' ORDER BY rand() LIMIT 3");
$stmt->execute();
$result=$stmt->get_result();


?>
<!DOCTYPE html>
<html lang="en">
<?php include_once('includes/head.php'); ?>

<body>
    <?php include_once('includes/header.php'); ?>
    <section class="home-1">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="banner-heading">
                        <h1>Your One-Stop Solution for Medicines and Convenient Appointments</h1>
                        <p>At Lifecare Pharma Elite, we strive to provide exceptional healthcare services to our valued
                            patients. As a reputable pharmacy, we offer a wide range of high-quality medicines to meet
                            your healthcare needs. Whether you require prescription medications, over-the-counter drugs,
                            or specialized pharmaceutical products, our extensive inventory has got you covered.</p>
                        <a href="#" class="btn">Shop Now!</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="doctor_list">
                <div class="container">
                    <div class="heading">
                    </div>
                    <div class="doctor_wrap">
                        <div class="row">
                            <?php while($row=$result->fetch_assoc()){ ?>
                            <div class="col-md-4">
                                <div class="doctor_box">
                                    <div class="img">
                                        <img src="backend/img/doctors/<?php echo $row['image']; ?>" alt="image" title="image">
                                    </div>
                                    <div class="doctor_info">
                                        <h3>Dr. <?php echo $row['name']; ?></h3>
                                        <span><?php echo $row['speciality'] ?></span>
                                        <p><?php echo $row['description']; ?></p>
                                        <a href="book-appointment.php?id=<?php echo base64_encode($row['id']); ?>" class="btn">Book Appointment</a>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </section>
    <!-- <section class="home2">
        <div class="container">
            <div class="medicine-wrap">

                <div class="row">
                    <div class="col-md-4">
                        <div class="medicine-box">
                            <div class="medicine-img">
                                <img src="images/product1.jpg" alt="medicine" title="medicine">
                            </div>
                            <div class="medicine-info">
                                <a href="medicine-detail.html">
                                    <h3>Acetaminophen (paracetamol)</h3>
                                </a>
                                <h4>$20</h4>
                                <div class="cart-btn">
                                    <a href="#" class="btn">Add to Cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="medicine-box">
                            <div class="medicine-img">
                                <img src="images/product1.jpg" alt="medicine" title="medicine">
                            </div>
                            <div class="medicine-info">
                                <a href="medicine-detail.html">
                                    <h3>Acetaminophen (paracetamol)</h3>
                                </a>
                                <h4>$20</h4>
                                <div class="cart-btn">
                                    <a href="#" class="btn">Add to Cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="medicine-box">
                            <div class="medicine-img">
                                <img src="images/product1.jpg" alt="medicine" title="medicine">
                            </div>
                            <div class="medicine-info">
                                <a href="medicine-detail.html">
                                    <h3>Acetaminophen (paracetamol)</h3>
                                </a>
                                <h4>$20</h4>
                                <div class="cart-btn">
                                    <a href="#" class="btn">Add to Cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="medicine-box">
                            <div class="medicine-img">
                                <img src="images/product1.jpg" alt="medicine" title="medicine">
                            </div>
                            <div class="medicine-info">
                                <a href="medicine-detail.html">
                                    <h3>Acetaminophen (paracetamol)</h3>
                                </a>
                                <h4>$20</h4>
                                <div class="cart-btn">
                                    <a href="#" class="btn">Add to Cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="medicine-box">
                            <div class="medicine-img">
                                <img src="images/product1.jpg" alt="medicine" title="medicine">
                            </div>
                            <div class="medicine-info">
                                <a href="medicine-detail.html">
                                    <h3>Acetaminophen (paracetamol)</h3>
                                </a>
                                <h4>$20</h4>
                                <div class="cart-btn">
                                    <a href="#" class="btn">Add to Cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="medicine-box">
                            <div class="medicine-img">
                                <img src="images/product1.jpg" alt="medicine" title="medicine">
                            </div>
                            <div class="medicine-info">
                                <a href="medicine-detail.html">
                                    <h3>Acetaminophen (paracetamol)</h3>
                                </a>
                                <h4>$20</h4>
                                <div class="cart-btn">
                                    <a href="#" class="btn">Add to Cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <section class="home3">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="heading">
                        <h2>
                            Shop Medicines at Lifecare Pharma Elite </h2>
                        <a href="#" class="btn">Shop Now!</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="home4">
        <div class="container">
            <div class="heading">
                <h2>Latest News</h2>
            </div>
            <div class="news-wrap">
                <div class="row">
                    <div class="col-md-4">
                        <div class="news-box">
                            <div class="news-img">
                                <img src="images/news1.jpg" alt="news" title="news">
                            </div>

                            <div class="date">
                                <span>25 Jan 2024</span>
                            </div>
                            <div class="news-info">
                                <h3>Stay Informed for a Healthier Life</h3>
                                <p>Insights on various health topics to help you make informed decisions for a healthier
                                    life.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="news-box">
                            <div class="news-img">
                                <img src="images/news1.jpg" alt="news" title="news">
                            </div>

                            <div class="date">
                                <span>27 Jan 2024</span>
                            </div>
                            <div class="news-info">
                                <h3> Discover Breakthroughs in Healthcare</h3>
                                <p>Committed to keeping you informed about the latest advancements in healthcare.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="news-box">
                            <div class="news-img">
                                <img src="images/news1.jpg" alt="news" title="news">
                            </div>

                            <div class="date">
                                <span>31 Jan 2024</span>
                            </div>
                            <div class="news-info">
                                <h3>Stay Current with the Evolving Landscape</h3>
                                <p>As the healthcare industry evolves, staying informed about the latest trends and
                                    developments is crucial.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include_once('includes/footer.php'); ?>
</body>

</html>