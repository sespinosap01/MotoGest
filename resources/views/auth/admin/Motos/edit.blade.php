@extends('layouts.app')

@section('content')

<script>
    /* este script se utiliza para validar que el input reciba una
    imagen que sea menor al tamaño establecido y mostrar la previsualización */
    function validarYMostrarImagen(input) {
        var file = input.files[0];
        var errorElement = document.getElementById('imagen-error');

        if (file) {
            var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
            if (!allowedExtensions.exec(file.name)) {
                errorElement.textContent = 'Selecciona una imagen con una extensión válida (jpg, jpeg o png).';
                input.value = ''; 
                return;
            }

            if (file.size > 2097152) {
                errorElement.textContent = 'La imagen es demasiado grande. El tamaño máximo permitido es de 2MB.';
                input.value = ''; 
                return;
            }
            errorElement.textContent = '';

            
            var imgElement = document.getElementById('pic');        
            if (input.files && input.files[0]) {
                var reader = new FileReader();
        
                reader.onload = function (e) {
                    imgElement.src = e.target.result;
                    imgElement.style.display = 'block';
                };
        
                reader.readAsDataURL(input.files[0]);
            } else {
                imgElement.style.display = 'none';
            }
        }
    }
</script>

<div class="container" data-aos="fade-up">

    @if(Auth::user()->rol->name == "User")
    <div class="alert alert-danger mt-3">
        <p>No tienes acceso a esta página</p>
        <a href="/home" class="btn btn-sm btn-dark">Volver</a>
    </div>
    @endif

    @if(Auth::user()->rol->name == "Admin")
    @if ($moto->imagen)
    <h3><img src="{{ asset($moto->imagen)}}" alt="imgFoto" style="width:50px; height:50px; border-radius:24px; object-fit: cover;"> Editando <b>{{$moto->marca}} {{$moto->modelo}}</b> </h3>
    @else
    <h3><img src="{{ asset("images/iconos/motoDefault.png")}}" alt="imgFoto" style="width:50px; height:50px; border-radius:24px; object-fit: cover;"> Editando <b>{{$moto->marca}} {{$moto->modelo}}</b> </h3>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="POST" action="{{ route('moto.update', $moto->idMoto) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <label for="idUsuario" class="col-md-4 col-form-label text-md-end">Propietario</label>
                    <div class="col-md-6">
                        <select name="idUsuario" id="idUsuario" class="form-control js-example-basic-single">
                            <option value="1">--Selecciona el propietario--</option>
                            @foreach ($users as $user)
                                <option value="{{$user->idUsuario}}" @if(isset($moto) && $moto->idUsuario == $user->idUsuario) selected @endif>
                                    {{$user->idUsuario}} || {{$user->email}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="marca" class="col-md-4 col-form-label text-md-end">Marca</label>
                    <div class="col-md-6">
                        <select name="marca" class="form-control js-example-basic-single">
                            <option value="No seleccionada">--Selecciona una marca--</option>
                            @foreach ([
                                '3Pluscoco', 'Aero', 'Aidea', 'Aiyumo', 'Alpina-Renania', 'Aprilia', 'Astor', 'Bajaj', 'Barossa', 'Beeline',
                                'Benda', 'Benelli', 'Bensom', 'Bereco', 'Beta', 'Bmw', 'Brammo', 'Brixton', 'Buell', 'Bultaco', 'Cagiva',
                                'Cake', 'Cannondale', 'Carnielli', 'Carsa', 'Chihui', 'Citycoco', 'Daelim', 'Daihatsu', 'Dayi-Motor',
                                'Derbi', 'Dongma', 'Ducati', 'Ducson', 'E-Atv-Racing', 'Eagle-Motor', 'Elecycle', 'Elektra', 'Erider',
                                'Fd-Motors', 'Fernhay', 'Fkm', 'Flex-Tech', 'Fullcheer', 'Garelli', 'Gas-Gas', 'Giantco', 'Gilera', 'Gran-Scooter',
                                'Hammel', 'Hanway', 'Harley-Davidson', 'Herald', 'Hercules', 'Honda', 'Horwin', 'Hs', 'Husqmoto', 'Husqvarna',
                                'Hyosung', 'Ifa', 'Imf', 'Iotostark', 'Italjet', 'Itteco', 'Iva', 'Jcadi', 'Jinpeng', 'Jokky-Worky', 'Kawasaki',
                                'Kayo', 'Keen', 'Keeway', 'Kinroad', 'Kmz', 'Kollter', 'Krc', 'Ktm', 'Kymco', 'Kyota', 'Kyoto', 'Lambretta',
                                'Lamuratti', 'Lanvertti', 'Laverda', 'Lima', 'Linze', 'Luma', 'Mac', 'Magnat-Debon', 'Mangosteen', 'Mash', 'Mbk',
                                'Milg', 'Mobylette', 'Mondial', 'Montesa', 'Monty', 'Moto-Gac', 'Moto-Guzzi', 'Motobic', 'Motorhispania',
                                'Motormania', 'Motostar', 'Motron', 'Moustache-Bike', 'Mv', 'Nito', 'Nitro', 'Nova-Motors', 'Nsu', 'Nuuk', 'Nwow',
                                'Orion', 'Oxygen', 'Panther', 'Paxster', 'Pegasus-Moto', 'Peugeot', 'Piaggio', 'Piaggio-Vespa', 'Polaris', 'Pony',
                                'Puch', 'Pulse', 'Pursang', 'Qroad', 'Renault', 'Rf', 'Rieju', 'Rolektro', 'Rotom', 'Royal-Classic', 'Royal-Enfield',
                                'Scoobic', 'Scott', 'Seat', 'Segway', 'Super', 'Super-Motor', 'Suzuki', 'Swincar', 'Sym', 'Tauris', 'Tekuon',
                                'Thumpstar', 'Tilgreen', 'Titan', 'Trakker', 'Trigger', 'Triketec', 'Trimak', 'Triumph', 'Tromox', 'Tron', 'Tuk-Tuk',
                                'Ubco', 'Urban', 'Urbet', 'Velca', 'Veleco', 'Velimotor', 'Velocifero', 'Vortex', 'Vyrus', 'Wayscral', 'Wellta',
                                'Winora-Staiger', 'Xiaomi', 'Yamaha', 'Yuhanzhen', 'Zhongyu', 'Zuap', 'Zxmco'
                            ] as $marca)
                    <option value="{{ $marca }}" @if(isset($moto) && $moto->marca == $marca) selected @endif>
                        {{ $marca }}
                    </option>
                    @endforeach
                    </select>
                        
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="modelo" class="col-md-4 col-form-label text-md-end">Modelo</label>
                    <div class="col-md-6">
                        <input id="modelo" type="text" class="form-control" @isset($moto) value="{{$moto->modelo}}" @endisset name="modelo" required>                                                
                    </div>
                </div>   
                
                <div class="row mb-3">
                    <label for="cilindrada" class="col-md-4 col-form-label text-md-end">Cilindrada</label>
                    <div class="col-md-6">
                        <input id="cilindrada" type="number" class="form-control" @isset($moto) value="{{$moto->cilindrada}}" @endisset name="cilindrada" required oninput="limitarLongitud(this, 4)">                                                
                    </div>
                </div> 

                <div class="row mb-3">
                    <label for="potencia" class="col-md-4 col-form-label text-md-end">Potencia</label>
                    <div class="col-md-6">
                        <input id="potencia" type="number" class="form-control" @isset($moto) value="{{$moto->potencia}}" @endisset name="potencia" required oninput="limitarLongitud(this, 3)">                                                
                    </div>
                </div> 

                <div class="row mb-3">
                    <label for="fechaFabricacion" class="col-md-4 col-form-label text-md-end">Año de fabricación</label>
                    <div class="col-md-6">
                        <input id="fechaFabricacion" type="number" class="form-control" @isset($moto) value="{{$moto->fechaFabricacion}}" @endisset name="fechaFabricacion" required oninput="limitarLongitud(this, 4)">                                                
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="imagen" class="col-md-4 col-form-label text-md-end">Imagen</label>
                    <div class="col-md-6">
                        <input id="imagen" class="form-control" name="imagen" type="file" onchange="validarYMostrarImagen(this)">
                        <p id="imagen-error" style="color: red;"></p>
                        <img style="width: auto; height: 100px; display: none;  object-fit: cover;" class="mt-3" id="pic">
                    </div>                                    
                </div> 

                <div class="row mb-3">
                    <label for="matricula" class="col-md-4 col-form-label text-md-end">Matricula</label>
                    <div class="col-md-6">
                        <input id="matricula" type="text" class="form-control" @isset($moto) value="{{$moto->matricula}}" @endisset name="matricula" required>                                                
                    </div>
                </div>
                
                <div class="row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn text-white btn-sm" style="background-color: #c65f20;">
                            Editar moto
                        </button>
                        <a href="{{ url()->previous() }}" class="btn btn-sm btn-secondary" >Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
        @endif
</div>

@endsection
