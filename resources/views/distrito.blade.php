<html>
<head>
  <meta charset="UTF-8">
  <title>Document</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
</head>
<body>

<div class="container-fluid">

    @foreach ($datas as $data)
   <div class="card" style="width: 18rem; float:left">
 <img class="card-img-top" src="https://png.icons8.com/ios/1600/donald-trump.png" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title">{{$data->TXNOMBRECOMPLETO}} - {{$data->TXCARGOELECCION}}</h5>
    <p class="card-text">{{$data->TXORGANIZACIONPOLITICA}}</p>
    <a href="#" class="btn btn-primary">Mas Detalles...</a>
  </div>
</div>


    @endforeach

</div>



</div>


</body>
</html>
