<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Text $text
 */
?>
<?php
		if('/' !== $this->request->getUri()->getPath()){
			echo $this->element("breadcrumbs");
		}
?>

		<!-- ======= Blog Single Section ======= -->
		<section id="blog" class="blog entry entry-single">

			<h2 class="entry-title text-center pb-4" style="border-bottom: 1px dashed gray;"><?= $text->name ?></h2>

			<div class="entry-content">
				<?= $text->body ?>
			</div>

		</section><!-- End Blog Single Section -->
