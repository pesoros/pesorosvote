@extends('voters.layout.app')

@section('style')
<style>
    .showimage {
        height: 250px;
        object-fit: cover;
    }
    .votebutwrap {
        text-align: center;
    }
    .votebutwrap button {
        width: 100%;
        margin-top: 10px;
    }
</style>
@endsection

@section('pagetitle')
    <div class="page-title-box">
        <div class="container-fluid">
            <div class="page-title-content">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4>{{ $eventdata->event_name }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')

<div class="container-fluid">

    <div id="voteModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="voteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="voteModalLabel">Vote Form
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="col-sm-12">
                            <label for="push-candidatename" class="col-sm-12 col-form-label">Candidate</label>
                            <input class="form-control" type="text" id="push-candidateid" name="push-candidateid" style="display: none">
                            <input class="form-control" type="text" id="push-candidatename" name="push-candidatename" readonly>
                        </div>
                        <div class="col-sm-12">
                            <label for="push-votersname" class="col-sm-12 col-form-label">Your Name</label>
                            <input class="form-control" type="text" id="push-votersname" name="push-votersname">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect"
                        data-bs-dismiss="modal">Close</button>
                    <button type="button"
                        class="btn btn-primary waves-effect waves-light" id="sendvote">Send Vote</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="row">
        @foreach ($candidatedata as $item)
            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <img class="card-img-top img-fluid showimage" src="{{ asset('assets/images/candidate/'.$item->image.'') }}" alt="Card image cap">
                    <div class="card-body">
                        <h4 class="card-title">{{ $item->candidate_name }}</h4>
                        <div class="col-md-12 votebutwrap">
                            <button type="button" class="btn btn-outline-secondary waves-effect votebutton" id="{{ $item->id }}-{{ $item->candidate_name }}"
                                                    data-bs-toggle="modal" data-bs-target="#voteModal">Vote</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <!-- end row -->

</div>

@section('scripts')

<script>

    $(".votebutton").click(function(e) {
        let splitter = e.target.id.split("-")
        let id = splitter[0]
        let name = splitter[1]
        $("#push-candidateid").val(id)
        $("#push-candidatename").val(name)
    });
    $("#sendvote").click(function(e) {
        let votersname = $("#push-votersname").val()
        if (votersname.trim() == "") {
            alertify.delay(1e4).log("Please input your name")            
        } else {
            let pushlink = {{ $eventdata->id }} + '/' + $("#push-candidateid").val() + '/' + $("#push-votersname").val()
            // console.log(pushlink)
            location.replace('event/pushvote/'+pushlink)
        }
    });

</script>
            
@stop

@endsection