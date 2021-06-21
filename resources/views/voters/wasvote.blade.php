@extends('voters.layout.app')

@section('style')
<style>
    .formcreate{
        margin-top: 90px;
        text-align: center;
    }
</style>
@endsection

@section('content')

<div class="container-fluid">

    <div class="row">

        <div class="col-xl-4">
        </div>
        <div class="col-xl-4">
            <div class="card formcreate">
                <div class="card-body">
                    <h4>You has been vote {{ $candidatedata->candidate_name }}</h4>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
        </div>
    </div>
    <!-- end row -->

</div>

@endsection