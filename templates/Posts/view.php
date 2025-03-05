	<?= $this->element("breadcrumbs") ?>

<?php if(isset($post) && count($post->toArray()) > 0){ ?>	
    <!-- ======= Blog Section ======= -->
    <section id="blog" class="blog">
      <div class="container" data-aos="fade-up">

        <div class="row">

          <div class="col-lg-8 entries">

            <article class="entry">

              <div class="entry-img">
                <img src="/img/blog/<?= $post->filename ?>" alt="" class="img-fluid w-100">
              </div>

              <h2 class="entry-title">
                <a href="/post/<?= $post->slug ?>"><?= $post->name ?></a>
              </h2>

<?php /*
              <div class="entry-meta">
                <ul>
                  <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="blog-single.html">John Doe</a></li>
                  <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="blog-single.html"><time datetime="2020-01-01">Jan 1, 2020</time></a></li>
                  <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a href="blog-single.html">12 Comments</a></li>
                </ul>
              </div>
*/ ?>

              <div class="entry-content" style="text-align: justify;">
                <p>
                  <?= $post->body ?>

                </p>
                <p>
                  <?= $post->more ?>

                </p>
<?php		if($post->more != ''){ ?>

                <!--div class="read-more">
                  <a href="/posts/view/<?= $post->slug ?>"><?= __('Read More') ?></a>
                </div-->
<?php		} ?>

              </div>

            </article><!-- End blog entry -->
<?php 	} ?>

          </div><!-- End blog entries list -->

		  <?= $this->element("sidebar") ?>

        </div>

      </div>
    </section><!-- End Blog Section -->
