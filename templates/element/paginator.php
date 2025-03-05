<?php
use Cake\Core\Configure;

$this->Paginator->setTemplates(Configure::read('Templates.paginator'));
//dd($this->Paginator->numbers());
?>
<?php if($this->Paginator->numbers()) { ?>
									<div class="blog-pagination mb-5">
									<!--nav aria-label="Page navigation"-->
									  <ul class="pagination justify-content-center" style="margin-top: 4px; margin-bottom: 0;">
<?php
											if($this->Paginator->hasPrev()){
												echo $this->Paginator->first('<i class="bi bi-chevron-double-left" title="' . __d('jeff_admin5', 'First page') . '"></i>', ['escape' => false]);
											}
											//if($this->Paginator->hasPrev()){
												echo $this->Paginator->prev('<i class="bi bi-chevron-left" title="' . __d('jeff_admin5', 'Previous page') . '"></i>', ['escape' => false]);
											//}
											//echo $this->Paginator->numbers(['modulus' => 10]);	//Aktívon kívüli oldalak száma
											echo $this->Paginator->numbers(    
												[
													//'ellipsis' => '.-.-.',
													//'ellipsis' => '<i class="fa fa-ellipsis-h" title="' . __d('jeff_admin5', 'Lots of page') . '"></i>',
													//'separator' => ' ',
													'modulus' => 7,
													'first' => 1,
													'last' => 1
												]
											);
											//if($this->Paginator->hasNext()){
												echo $this->Paginator->next('<i class="bi bi-chevron-right"></i>',['escape' => false]);
											//}
											echo $this->Paginator->last('<i class="bi bi-chevron-double-right" title="' . __d('jeff_admin5', 'Last page') . '"></i>', ['escape' => false]);
?>
									  </ul>
									</div>


<?php //<i class="icon-angle-right" title="' . __d('jeff_admin5', 'Next page') . '"></i>  ?>

<?php } ?>
