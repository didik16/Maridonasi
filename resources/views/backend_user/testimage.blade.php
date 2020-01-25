<!DOCTYPE html>
<html>
<head>
	<title>aaa</title>
</head>
<body>
	<form class="form-horizontal" enctype="multipart/form-data" method="post" action="/gambar_post">
		@csrf
		<input required type="file" class="form-control" name="images[]" placeholder="address" multiple>
		<button type="submit">Upload</button>
	</form>
</body>
</html>

