<?php include "../connection/connect.php" ?>

<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active" style="background-color: gray;">
        </li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1" style="background-color: gray;"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2" style="background-color: gray;"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <div class="slider-item">
                <div class="slide-item-content">
                    <p>
                    Welcome to your pet's favorite store! From nutritious meals to playful accessories, we’ve got
                    everything your furry friend needs.
                    </p>
                    <button class="btn btn-lg">get started</button>
                </div>
                <img src="../images/pet.png" alt="First slide">
            </div>
        </div>
        <div class="carousel-item">
            <div class="slider-item">
                <div class="slide-item-content">
                    <p>
                    Nourish your pet with love! Explore our selection of wholesome and delicious food tailored to
                    keep your pet healthy and happy.
                    </p>
                    <button class="btn btn-lg">get started</button>
                </div>
                <img src="../images/pngwing.com.png" alt="supplies image">
            </div>
        </div>
        <div class="carousel-item">
            <div class="slider-item">
                <div class="slide-item-content">
                    <p>
                    From cozy beds to fun toys, find all the essentials to pamper your pet with the best. Quality products with various prices.
                    </p>
                    <button class="btn btn-lg">get started</button>
                </div>
                <img src="../images/tools2.png" alt="Third slide" class="card-img-top imgSlide">
            </div>
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="chevron"><i class="fas fa-chevron-left"></i></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="chevron"><i class="fas fa-chevron-right"></i></span>
        <span class="sr-only">Next</span>
    </a>
</div>


<!-- zaid (start category)  -->
<?php include "landingPageSection/categorySection.php" ?>
<!-- zaid (end category)  -->



<!-- Services  -->
<section id="services_n">
    <div class="services show">
        <h2>Our Services</h2>
        <div class="cen"></div>
        <div class="contaner-services">
            <div class="servicee">
                <i class="fas fa-clinic-medical"></i>
                <h3>Health and Veterinary Care</h3>
                <p>Some stores offer health care services such as check-ups, vaccinations, and parasite preventative
                    treatment. </p>
            </div>
            <div class="servicee">
                <i class="fas fa-dog"></i>
                <h3>Pet Training</h3>
                <p>Some stores offer training services that include obedience training, potty training, and behavior
                    correction.</p>
            </div>
            <div class="servicee">
                <i class="fas fa-cat"></i>
                <h3>Boarding and Day Care</h3>
                <p>This service provides temporary accommodation for pets during periods of absence for their owners.
                </p>
            </div>
            <div class="servicee">
                <i class="fas fa-paw"></i>
                <h3>pet supplies</h3>
                <p>The stores offer a variety of supplies such as toys, beds, cages, bowls, and training collars.</p>
            </div>
            <div class="servicee">
                <i class="fas fa-bone"></i>
                <h3>Grooming and grooming services</h3>
                <p>These services include haircuts, ear cleaning, nail trimming, and bathing.</p>
            </div>
            <div class="servicee">
                <i class="fa-solid fa-route"></i>
                <h3>Pet Nutrition</h3>
                <p>The stores offer a wide range of foods for cats and dogs, natural foods and nutritional supplements.
                </p>
            </div>
        </div>
    </div>
</section>
<!-- Services end -->