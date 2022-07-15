<?= view("dashboard/partials/_form-error")?>
<form action="create" method="POST" enctype="multipart/form-data">
<?= view("dashboard/movie/_form",['textButton'=>lang('Form.save'),'created'=>true])?>
</form>