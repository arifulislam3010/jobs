<!DOCTYPE html>
<html>
<body>

<h2>HTML Forms</h2>

<form action="{{ route('upload-excel') }}" method="post" enctype="multipart/form-data">
  <label for="fname">File:</label><br>
  <input type="file" name="excel_file" >
  <br>
  <br>
  <input type="submit" value="Submit">
</form> 

<p>If you click the "Submit" button, the form-data will be sent to a page called "/action_page.php".</p>

District Wise
<form action="{{ route('upload-excel-area') }}" method="post" enctype="multipart/form-data">
  <label for="fname">File:</label><br>
  <input type="file" name="excel_file" >
  <br>
  <br>
  <input type="submit" value="Submit">
</form> 

</body>
</html>