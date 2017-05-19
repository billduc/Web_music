<form name="form1" method="post" action="?a=tim">
	<br />
    <input name="tukhoa" type="text" id="tukhoa" size="40" value="<?php if(isset($_POST["tukhoa"])) echo  $_POST["tukhoa"];?>">
    <select name="luachon" id="luachon">
      <option value="tenbai" <?php if($_POST["luachon"]=="tenbai") echo "selected='selected'";?>>Tên Bài Hát</option>
      <option value="album" <?php if($_POST["luachon"]=="album") echo "selected='selected'";?>>Tên Album</option>
      <option value="casi" <?php if($_POST["luachon"]=="casi") echo "selected='selected'";?>>Tên ca sĩ</option>
      <option value="nhacsi" <?php if($_POST["luachon"]=="nhacsi") echo "selected='selected'";?>>Tên nhạc sĩ</option>
      <option value="nguoidang" <?php if($_POST["luachon"]=="nguoidang") echo "selected='selected'";?>>Tên người upload</option>
      <option value="video" <?php if($_POST["luachon"]=="video") echo "selected='selected'";?>>Video</option>
    </select>
    <input name="timkiem" type="submit" id="timkiem" value=" Tìm Kiếm ">
    <br/>
    <br />
</form>
