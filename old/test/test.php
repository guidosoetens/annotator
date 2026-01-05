<!DOCTYPE html>
<html>
<head>
<title>Quiz Test Page</title>
<script type="module" src="./test.js?v=<?php echo filemtime('test.js'); ?>"></script>
</head>
<body id="body">
<h1>Test Page</h1>
<select id="idUsers">
    <option value="3737213a">Mathijs</option>
    <option value="36342d37">Annelies</option>
    <option value="30322730">Bob</option>
    <option value="3337203b">Ferenc</option>
    <option value="32342c34">Guido</option>
    <option value="3c322631">Hans</option>
    <option value="3f372338">Ies</option>
    <option value="3732223838">Jan-Jaap</option>
    <option value="373024363b">Mattia</option>
    <option value="3737213a3e">Tom</option>
  </select>
<button id="btnUpload">UPLOAD</button>
</br></br>
<img id="divPlaatje" width="200" height="200" src="https://loremflickr.com/200/200?random=1" crossorigin="anonymous"/>
<div id="divItems">ITEMS:</div>
<div id="divOutput">
    Output
</div>

</body>
</html>