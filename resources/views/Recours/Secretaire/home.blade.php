@extends('layouts.header')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper pb-0">
            <div class="page-header flex-wrap">
                <h3 class="mb-0"> Bonjour @if (Auth::user()->sexe == 'Femme')
                        Mme
                    @else
                        Mr
                    @endif {{ Auth::user()->nom }} {{ Auth::user()->prenoms }},Bon retour parmis nous!
                    <span class="pl-0 h6 pl-sm-2 text-muted d-inline-block"></span>
                </h3>
            </div>
        <div class="row">
            <div class="col">
    <div class="card bg-warning" style="    width: max-content;
">
                      <div class="card-body px-3 py-4">
                        <div class="d-flex justify-content-between align-items-start">
                          <div class="color-card">
                            <h2 class="text-white"> {{count($recours)}}<span class="h5"></span>
                            </h2>
                          </div>
                          <i class="mdi mdi-folder menu-icon"></i>
                        </div>
                        <h6 class="text-white">Nombre de recours </h6>
                      </div>
                    </div>            </div>

       </div>

 </div>
    </div>
    <!-- main-panel ends -->
@endsection
