@extends('layouts.app')

@section('content')
<div class="container" data-aos="fade-up">
    <h1>Añadir Moto</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">

            <form method="POST" action="{{ route('motopanel.store') }}">
                @csrf
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
                                <option value="{{ $marca }}">{{ $marca }}</option>
                            @endforeach
                        </select>
                        
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="modelo" class="col-md-4 col-form-label text-md-end">Modelo</label>
                    <div class="col-md-6">
                        <input id="modelo" type="text" class="form-control" name="modelo" required>                                                
                    </div>
                </div> 
                
                <div class="row mb-3">
                    <label for="cilindrada" class="col-md-4 col-form-label text-md-end">Cilindrada (cc)</label>
                    <div class="col-md-6">
                        <input id="cilindrada" type="number" class="form-control" name="cilindrada" required>                                                
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="potencia" class="col-md-4 col-form-label text-md-end">Potencia (cv)</label>
                    <div class="col-md-6">
                        <input id="potencia" type="number" class="form-control" name="potencia" required>                                                
                    </div>
                </div> 

                <div class="row mb-3">
                    <label for="fechaFabricacion" class="col-md-4 col-form-label text-md-end">Año de fabricación</label>
                    <div class="col-md-6">
                        <input id="fechaFabricacion" type="number" class="form-control" name="fechaFabricacion" required>                                                
                    </div>
                </div> 

                <div class="row mb-3">
                    <label for="imagen" class="col-md-4 col-form-label text-md-end">Imagen</label>
                    <div class="col-md-6">
                        <input id="imagen" type="text" class="form-control" name="imagen" required value="img.png">                                                
                    </div>
                </div> 

                <div class="row mb-3">
                    <label for="matricula" class="col-md-4 col-form-label text-md-end">Matricula</label>
                    <div class="col-md-6">
                        <input id="matricula" type="text" class="form-control" name="matricula" required>                                                
                    </div>
                </div>
                
                <div class="row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn text-white mr-4" style="background-color: #c65f20;">
                            Añadir moto
                        </button>
                        <a href="{{ route('clientes.clientPanel') }}" class="btn btn-secondary" >Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
</div>
@endsection