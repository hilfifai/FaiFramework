Route::get('/<?=$page['route']?>/{page}/{id}', [App\Http\Controllers\<?php echo $fai->nama_controller($page,$page['title']);?>::class, 'index'])->name('<?=$page['route']?>');
Route::post('/post_<?=$page['route']?>/{page}/{id}', [App\Http\Controllers\<?php echo $fai->nama_controller($page,$page['title']);?>::class, 'index_post'])->name('<?=$page['route']?>_post');

