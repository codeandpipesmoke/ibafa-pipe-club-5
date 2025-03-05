<?php 
	use Cake\Utility\Text;
?>
	<?= $this->element("breadcrumbs") ?>

    <!-- ======= About Us Section ======= -->
    <section id="about-us" class="about-us">
      <div class="container">

        <div class="row no-gutters">
          <div class="image col-xl-5 d-flex align-items-stretch justify-content-center justify-content-lg-start" data-aos="fade-right"></div>
          <div class="col-xl-7 ps-0 ps-lg-5 pe-lg-1 d-flex align-items-stretch">
            <div class="content d-flex flex-column justify-content-center">
              <h3 data-aos="fade-up"><?= $about->title ?></h3>
              <p data-aos="fade-up">
                <?= $about->subtitle ?>
              </p>
              <div class="row">
                <div class="col-md-6 icon-box" data-aos="fade-up">
                  <i class="bx bx-receipt"></i>
                  <h4><?= $about->title_1 ?></h4>
                  <p><?= $about->text_1 ?></p>
                </div>
                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="100">
                  <i class="bx bx-cube-alt"></i>
                  <h4><?= $about->title_2 ?></h4>
                  <p><?= $about->text_2 ?></p>
                </div>
                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="200">
                  <i class="bx bx-images"></i>
                  <h4><?= $about->title_3 ?></h4>
                  <p><?= $about->text_3 ?></p>
                </div>
                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="300">
                  <i class="bx bx-shield"></i>
                  <h4><?= $about->title_4 ?></h4>
                  <p><?= $about->text_4 ?></p>
                </div>
              </div>
            </div><!-- End .content-->
          </div>
        </div>

      </div>
    </section><!-- End About Us Section -->




    <!-- ======= Our Team Section ======= -->
    <section id="team" class="team section-bg">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>A Pipaklub <strong>alapító tagjai</strong></h2>
          <p>A klub tagjai egy olyan közösséget alkotnak, ahol mindenki szenvedéllyel és tisztelettel osztja meg pipázással kapcsolatos tapasztalatait. Akár kezdő, akár tapasztalt pipás, mindenki megtalálja a helyét nálunk. A tagok különböző ízeket próbálnak ki, tanulnak egymástól, és egy olyan baráti légkört építenek, ahol a pipázás valódi élmény. Csatlakozz, és válj te is részévé ennek a különleges közösségnek!</p>
        </div>

        <div class="row">

<?php foreach($members as $member){ ?>
<?php 
		$filename 	= (string) $member->id . '_' . strtolower(Text::slug($member->name, '_')) . '.jpg';
		$thumbnailFileName = (string) $member->id . '_' . strtolower(Text::slug($member->name, '_')) . '_thumbnail.jpg';
?>

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
            <div class="member" data-aos="fade-up">
              <div class="member-img">
                <img src="/img/members/<?= $thumbnailFileName ?>" class="img-fluid" alt="<?= ($member->name) ?>">
                <div class="social">
<?php if($member->link_twitter != ''){ ?>
                  <a href="<?= $member->link_twitter ?>" target="_new"><i class="bi bi-twitter"></i></a>
<?php } ?>
<?php if($member->link_twitter != ''){ ?>
                  <a href="<?= $member->link_facebook ?>" target="_new"><i class="bi bi-facebook"></i></a>
<?php } ?>
<?php if($member->link_instagram != ''){ ?>
                  <a href="<?= $member->link_instagram ?>" target="_new"><i class="bi bi-instagram"></i></a>
<?php } ?>
<?php if($member->link_linkedin != ''){ ?>
                  <a href="<?= $member->link_linkedin ?>" target="_new"><i class="bi bi-linkedin"></i></a>
<?php } ?>
                </div>
              </div>
              <div class="member-info">
                <h4><?= $member->name ?></h4>
                <span><?= $member->about_title ?></span>
              </div>
            </div>
          </div>
<?php } ?>

        </div>

      </div>
    </section><!-- End Our Team Section -->



    <!-- ======= Our Skills Section ======= -->
<?php /*
    <section id="skills" class="skills">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Our <strong>Skills</strong></h2>
          <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
        </div>

        <div class="row skills-content">

          <div class="col-lg-6" data-aos="fade-up">

            <div class="progress">
              <span class="skill">HTML <i class="val">100%</i></span>
              <div class="progress-bar-wrap">
                <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>

            <div class="progress">
              <span class="skill">CSS <i class="val">90%</i></span>
              <div class="progress-bar-wrap">
                <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>

            <div class="progress">
              <span class="skill">JavaScript <i class="val">75%</i></span>
              <div class="progress-bar-wrap">
                <div class="progress-bar" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>

          </div>

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">

            <div class="progress">
              <span class="skill">PHP <i class="val">80%</i></span>
              <div class="progress-bar-wrap">
                <div class="progress-bar" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>

            <div class="progress">
              <span class="skill">WordPress/CMS <i class="val">90%</i></span>
              <div class="progress-bar-wrap">
                <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>

            <div class="progress">
              <span class="skill">Photoshop <i class="val">55%</i></span>
              <div class="progress-bar-wrap">
                <div class="progress-bar" role="progressbar" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>

          </div>

        </div>

      </div>
    </section><!-- End Our Skills Section -->

*/ ?>
