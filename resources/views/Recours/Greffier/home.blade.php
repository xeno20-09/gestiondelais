@extends('layouts.header')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper pb-0">
            <div class="page-header flex-wrap">
                <h3 class="mb-0"> Bonjour @if (Auth::user()->sexe == 'Femme')
                        Mme
                    @else
                        Mr
                    @endif {{ Auth::user()->nom }} {{ Auth::user()->prenoms }},Bon retour parmis nous! <span
                        class="pl-0 h6 pl-sm-2 text-muted d-inline-block"></span>
                </h3>

            </div>

        </div>
    </div>
    <!-- main-panel ends -->
@endsection
