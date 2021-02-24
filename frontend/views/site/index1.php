<?php
use yii\widgets\Pjax;
use yii\widgets\ListView;

/* @var $this yii\web\View */
setViewParam('liActive', 'home');
$this->title = t(Yii::$app->params['title']);
?>

<!--<img class="img-fluid" src="--><?//= imageURL('ipad.png') ?><!--"  alt="">-->


<header class="masthead" style=" ; background-size: cover; background: linear-gradient((to bottom, rgba(0, 0, 0, 0.3) 0%, rgba(0, 0, 0, 0.7) 75%, #000000 100%) ; background-color: gray ">
<!--    <img class="img-fluid" src="--><?//= imageURL('bg-masthead.jpg') ?><!--"  alt="">-->

    <div class="container d-flex h-100 align-items-center">
        <div class="mx-auto text-center">
            <h1 class="mx-auto my-0 text-uppercase">PAINTER</h1>
            <h2 class="text-white-50 mx-auto mt-2 mb-5">SLOGAN</h2>
            <a class="btn btn-primary js-scroll-trigger" href="#about">Get Started</a>
        </div>
    </div>
</header>
<!-- About-->
<section class="about-section text-center" id="about">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <h2 class="text-white mb-4">ABOUT PAINTER</h2>
                <p class="text-white-50">
                    الشرح التعريفي الخاص بالمركز
                </p>
                <p class="text-white-50">
                    التعريف عن الرسام أنور
                </p>
            </div>
        </div>
        <img class="img-fluid" src="<?= imageURL('ipad.png') ?>"  alt="">
    </div>
</section>
<!-- Projects-->
<section class="projects-section bg-light" id="projects">
    <div class="container">
        <!-- Project One Row-->
        <div class="row justify-content-center no-gutters mb-5 mb-lg-0">
            <div class="col-lg-6"><img class="img-fluid" src="<?= imageURL('demo-image-01.jpg') ?>"  alt=""></div>
            <div class="col-lg-6">
                <div class="bg-black text-center h-100 project">
                    <div class="d-flex h-100">
                        <div class="project-text w-100 my-auto text-center text-lg-left">
                            <h4 class="text-white">
                                <a href="<?= Yii::$app->urlManager->createUrl("/paintings/index") ?>">ART WORKS</a>
                            </h4>
                            <p class="mb-0 text-white-50">An example of where you can put an image of a project, or anything else, along with a description.</p>
                            <hr class="d-none d-lg-block mb-0 ml-0" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Project Two Row-->
        <div class="row justify-content-center no-gutters">
            <div class="col-lg-6"><img class="img-fluid" src="<?= imageURL('demo-image-02.jpg') ?>" alt="" /></div>
            <div class="col-lg-6 order-lg-first">
                <div class="bg-black text-center h-100 project">
                    <div class="d-flex h-100">
                        <div class="project-text w-100 my-auto text-center text-lg-right">
                            <h4 class="text-white">
                                <a href="<?= Yii::$app->urlManager->createUrl("/tools/index") ?>">ART TOOLS</a>
                            </h4>
                            <p class="mb-0 text-white-50">Another example of a project with its respective description. These sections work well responsively as well, try this theme on a small screen!</p>
                            <hr class="d-none d-lg-block mb-0 mr-0" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Project One Row-->
        <div class="row justify-content-center no-gutters mb-5 mb-lg-0">
            <div class="col-lg-6"><img class="img-fluid" src="<?= imageURL('demo-image-01.jpg') ?>"  alt="" /></div>
            <div class="col-lg-6">
                <div class="bg-black text-center h-100 project">
                    <div class="d-flex h-100">
                        <div class="project-text w-100 my-auto text-center text-lg-left">
                            <h4 class="text-white">
                                <a href="<?= Yii::$app->urlManager->createUrl("/courses/index") ?>">ART TRAINING</a>


                            </h4>
                            <p class="mb-0 text-white-50">An example of where you can put an image of a project, or anything else, along with a description.</p>
                            <hr class="d-none d-lg-block mb-0 ml-0" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Project Two Row-->
        <div class="row justify-content-center no-gutters">
            <div class="col-lg-6"><img class="img-fluid" src="<?= imageURL('demo-image-02.jpg') ?>"  alt="" /></div>
            <div class="col-lg-6 order-lg-first">
                <div class="bg-black text-center h-100 project">
                    <div class="d-flex h-100">
                        <div class="project-text w-100 my-auto text-center text-lg-right">
                            <h4 class="text-white">
                                <a href="<?= Yii::$app->urlManager->createUrl("/halls/index") ?>">ART TABLE</a>


                            </h4>
                            <p class="mb-0 text-white-50">Another example of a project with its respective description. These sections work well responsively as well, try this theme on a small screen!</p>
                            <hr class="d-none d-lg-block mb-0 mr-0" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Project One Row-->
        <div class="row justify-content-center no-gutters mb-5 mb-lg-0">
            <div class="col-lg-6"><img class="img-fluid" src="<?= imageURL('demo-image-01.jpg') ?>" alt="" /></div>
            <div class="col-lg-6">
                <div class="bg-black text-center h-100 project">
                    <div class="d-flex h-100">
                        <div class="project-text w-100 my-auto text-center text-lg-left">
                            <h4 class="text-white">
                                <a href="<?= Yii::$app->urlManager->createUrl("/packages/index") ?>">ART CLASS</a>


                            </h4>
                            <p class="mb-0 text-white-50">An example of where you can put an image of a project, or anything else, along with a description.</p>
                            <hr class="d-none d-lg-block mb-0 ml-0" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Contact-->
<section class="contact-section bg-black">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-3 mb-md-0">
                <div class="card py-4 h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-map-marked-alt text-primary mb-2"></i>
                        <h4 class="text-uppercase m-0">Address</h4>
                        <hr class="my-4" />
                        <div class="small text-black-50">4923 Market Street, Orlando FL</div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3 mb-md-0">
                <div class="card py-4 h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-envelope text-primary mb-2"></i>
                        <h4 class="text-uppercase m-0">Email</h4>
                        <hr class="my-4" />
                        <div class="small text-black-50"><a href="#">info@artzona.com</a></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3 mb-md-0">
                <div class="card py-4 h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-mobile-alt text-primary mb-2"></i>
                        <h4 class="text-uppercase m-0">Phone</h4>
                        <hr class="my-4" />
                        <div class="small text-black-50">+1 (555) 902-8832</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="social d-flex justify-content-center">
            <a class="mx-2" href="#"><i class="fab fa-twitter"></i></a>
            <a class="mx-2" href="#"><i class="fab fa-facebook-f"></i></a>
            <a class="mx-2" href="#"><i class="fab fa-instagram"></i></a>
            <a class="mx-2" href="#"><i class="fab fa-whatsapp"></i></a>
        </div>
    </div>
</section>
 