<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>自动验签</title>
</head>
<body>
      
    <form action="{{url('keys/signcre')}}" method="post">
        @csrf
            字段名1：<input type="text" name="k[]" id="">字段值1：<input type="text" name="v[]" id=""><br>
            字段名2：<input type="text" name="k[]" id="">字段值2：<input type="text" name="v[]" id=""><br>
            字段名3：<input type="text" name="k[]" id="">字段值3：<input type="text" name="v[]" id=""><br>
            字段名4：<input type="text" name="k[]" id="">字段值4：<input type="text" name="v[]" id=""><br>
            字段名5：<input type="text" name="k[]" id="">字段值5：<input type="text" name="v[]" id=""><br>
            <textarea name="sign" id="" cols="30" rows="10"></textarea>
            <input type="submit" value="dianji">

        </form>
</body>
</html>