@extends('layouts.app')
@section('title','Dashboard')
@section('content')

<section id='dashboard'>
    <div class="container py-5">
        <div class="row">
            <div class="col-4">
                <div class="news-info b-border p-3">
                    <div>
                        <h1 class="text-center p-blu t-shadow mb-4">Buongiorno </h1>
                    </div>
                    <div class="b-border p-5">

                        <div>Hai <strong>{{$messages ?? '0'}}</strong> messaggi non letti</div>
                        <div>Hai <strong>{{$reviews ?? '0'}}</strong> recensioni non lette</div>
                    </div>
                </div>
            </div>
            <div class="col-8">
                <h1 class="agend-title t-shadow b-border">Agenda del: {{date('d/m/Y',strtotime("now"))}}</h1>
                <table class="table table-light">
                    <thead>
                        <tr>
                            <th scope="col">Ora</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Tipo visita</th>
                            <th scope="col">Telefono</th>
                            <th scope="col">Mail</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr id="cazzo">
                            <th scope="row">8:00</th>
                            <td>Marco Calabretta</td>
                            <td>Broncoscopia</td>
                            <td>3568978564</td>
                            <td>mc@gmail.com</td>
                        </tr>
                        <tr>
                            <th scope="row">8:30</th>
                            <td>Daniele Tuttolani</td>
                            <td>Colonscopia</td>
                            <td>3542255888</td>
                            <td>dt77@gmail.com</td>
                        </tr>
                        <tr>
                            <th scope="row">9:00</th>
                            <td>Pino mcri</td>
                            <td>Rx torace</td>
                            <td>3542253344</td>
                            <td>pino@gmail.com</td>
                        </tr>
                        <tr>
                            <th scope="row">9:30</th>
                            <td>Marco Calabretta</td>
                            <td>Broncoscopia</td>
                            <td>3568978564</td>
                            <td>mc@gmail.com</td>
                        </tr>
                        <tr>
                            <th scope="row">10:00</th>
                            <td>Daniele Tuttolani</td>
                            <td>Colonscopia</td>
                            <td>3542255888</td>
                            <td>dt77@gmail.com</td>
                        </tr>
                        <tr>
                            <th scope="row">10:30</th>
                            <td>Pino mcri</td>
                            <td>Rx torace</td>
                            <td>3542253344</td>
                            <td>pino@gmail.com</td>
                        </tr>
                        <tr>
                            <th scope="row">11:00</th>
                            <td>Marco Calabretta</td>
                            <td>Broncoscopia</td>
                            <td>3568978564</td>
                            <td>mc@gmail.com</td>
                        </tr>
                        <tr>
                            <th scope="row">11:30</th>
                            <td>Daniele Tuttolani</td>
                            <td>Colonscopia</td>
                            <td>3542255888</td>
                            <td>dt77@gmail.com</td>
                        </tr>
                        <tr>
                            <th scope="row">12:00</th>
                            <td>Pino mcri</td>
                            <td>Rx torace</td>
                            <td>3542253344</td>
                            <td>pino@gmail.com</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</section>
@endsection
