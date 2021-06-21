@extends('admin.layout.app')

@section('style')
    <style>
        .listname {
            min-width: 550px;
        }
        .scrollbarfeed {
            height:224px;
            overflow:auto;
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
<div class="header-bg">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 pt-5 mt-4">
                <div id="morris-bar-example" class="morris-charts morris-chart-height"></div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">

    <div class="row">
        <div class="col-md-6 col-xl-6">
            <div class="card text-center">
                <div class="mb-2 card-body text-muted">
                    <h3 class="text-info mt-2">{{ count($votedatachart) }}</h3> Candidate
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-6">
            <div class="card text-center">
                <div class="mb-2 card-body text-muted">
                    <h3 class="text-purple mt-2">{{ count($votedata) }}</h3> Voters
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->

    <div class="row">
        <div class="col-xl-8">
            <div class="card">
                <form method="post" enctype="multipart/form-data" action="{{ url('dashboard/event/addcandidate') }}">
                    @csrf
                    <div class="card-body row">
                        <h4 class="card-title mb-4">Add Candidate</h4>
                        <div class="col-sm-5">
                            <label for="candidatename" class="col-sm-12 col-form-label">Candidate Name</label>
                            <input class="form-control" type="text" placeholder="Candidate Name" id="candidatename" name="candidatename">
                        </div>
                        <div class="col-sm-4">
                            <label for="candidatepict" class="col-sm-12 col-form-label">Picture</label>
                            <input class="form-control" type="file" id="candidatepict" name="candidatepict">
                        </div>
                        <div class="col-sm-2">
                            <label for="candidatestatus" class="col-sm-12 col-form-label">Status</label>
                            <select id="candidatestatus" name="candidatestatus" class="form-select">
                                <option value="1">Active</option>
                                <option value="0">Non Active</option>
                            </select>
                        </div>
                        <div class="col-sm-1">
                            <label for="addcandidate" class="col-sm-12 col-form-label" style="visibility: hidden">-</label>
                            <button type="submit" class="btn btn-outline-secondary waves-effect"> + </button>
                        </div>
                    </div>
                </form>
            </div>
            <div id="editModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title mt-0" id="editModalLabel">Modif Candidate
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="card-body">
                                <input class="form-control" type="text" value="" id="candidateidedit" name="candidateidedit">
                                <div class="col-sm-12">
                                    <label for="candidatenameedit" class="col-sm-12 col-form-label">Candidate Name</label>
                                    <input class="form-control" type="text" value="Candidate Name" id="candidatenameedit" name="candidatenameedit">
                                </div>
                                <div class="col-sm-12">
                                    <label for="candidatepictedit" class="col-sm-12 col-form-label">Picture</label>
                                    <input class="form-control" type="file" id="candidatepictedit" name="candidatepictedit">
                                </div>
                                <div class="col-sm-12">
                                    <label for="candidatestatusedit" class="col-sm-12 col-form-label">Status</label>
                                    <select id="candidatestatusedit" name="candidatestatusedit" class="form-select">
                                        <option value="1">Active</option>
                                        <option value="0">Non Active</option>
                                    </select>
                                </div>
                                <div class="col-sm-12">
                                    <label for="editcandidate" class="col-sm-12 col-form-label" style="visibility: hidden">-</label>
                                    <button type="submit" class="btn btn-outline-secondary waves-effect"> Update </button>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary waves-effect"
                                data-bs-dismiss="modal">Close</button>
                            <button type="button"
                                class="btn btn-primary waves-effect waves-light">Save
                                changes</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">List Candidate</h4>

                    <div class="table-responsive">
                        <table class="table mt-4 mb-0 table-centered  table-vertical">

                            <tbody>
                                @foreach ($candidatedata as $item)
                                    @php
                                    $candidatelist[$item->id] = $item->candidate_name;
                                    @endphp
                                    <tr>
                                        <td class="listname">
                                            <img src="{{ asset('storage/images/candidate/'.$item->image.'') }}" alt="user-image"
                                                class="avatar-sm rounded-circle me-2" /> {{ $item->candidate_name }}
                                        </td>
                                        <td>
                                            @if ($item->status == '1')
                                                <a href="event/statuscandidate/{{ $item->id }}/0" class="" id="inactivedcandidate-{{ $item->id }}">
                                                    <i class="mdi mdi-checkbox-blank-circle text-success"></i>
                                                    Active
                                                </a>
                                            @else
                                                <a href="event/statuscandidate/{{ $item->id }}/1" class="" id="activedcandidate-{{ $item->id }}">
                                                    <i class="mdi mdi-checkbox-blank-circle text-danger"></i>
                                                    Inactive
                                                </a>
                                            @endif
                                            
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-secondary btn-sm waves-effect modalbut" id="editModal-1"
                                                    data-bs-toggle="modal" data-bs-target="#editModal">Edit</button>
                                        </td>
                                        <td>
                                            <a href="event/deletecandidate/{{ $item->id }}" class="btn btn-secondary btn-sm waves-effect" id="deletecandidate-{{ $item->id }}"
                                                    >Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-3">Vote Url</h4>
                    <div class="mb-0 row">
                        <div class="col-sm-12">
                            <a href="{{ url($eventdata->slug) }}" id="urlvote" name="urlvote">{{ url($eventdata->slug) }}</a>
                        </div>
                        <br>
                        <br>
                        <div class="col-sm-12">
                            <button type="button" class="btn btn-outline-secondary waves-effect" id="copybut">Copy Url</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{ url('dashboard/event/update') }}">
                        @csrf
                        <h4 class="card-title mb-3">Event Detail</h4>
                        <div class="mb-0 row">
                            <div class="col-sm-12">
                                <label for="eventname" class="col-sm-12 col-form-label">Event Name</label>
                                <input class="form-control" type="text" value="{{ $eventdata->event_name }}" id="eventname" name="eventname">
                            </div>
                        </div>
                        <div class="mb-0 row">
                            <div class="col-sm-12">
                                <label for="eventslug" class="col-sm-12 col-form-label">Slug</label>
                                <input class="form-control" type="text" value="{{ $eventdata->slug }}" id="eventslug" name="eventslug" readonly>
                            </div>
                        </div>
                        <div class="mb-0 row">
                            <div class="col-sm-12">
                                <label for="eventdescription" class="col-sm-12 col-form-label">Description</label>
                                <input class="form-control" type="text" value="{{ $eventdata->description }}" id="eventdescription" name="eventdescription">
                            </div>
                        </div>
                        <br>
                        <div class="mb-0 row">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-outline-secondary waves-effect">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-3">Recent Activity Feed</h4>
                    <div class="scrollbarfeed">
                        <ol class="activity-feed mb-0">
                            @foreach ($votedata as $item)
                                <li class="feed-item">
                                    <span class="date">{{ date('d F Y H:i:s', strtotime($item->created_at)) }}</span>
                                    <span class="activity-text">{{ $item->voters_name }} vote 
                                        "{{ isset($candidatelist[$item->candidate_id]) ? $candidatelist[$item->candidate_id] : "-" }}"
                                    </span>
                                </li> 
                            @endforeach
                        </ol>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- end row -->

</div>

@section('scripts')

<script>

    let source = $('#eventname');
    let target = $('#eventslug');
    let chartData = @json($votedatachart);

    //When the user is typing in the name field.
    source.keyup( function(){
        transformStringToSlug(source , target)
    });

    //When the user is typing in the target field
    target.keyup( function(){
        transformStringToSlug(target , target)
    });

    //Actually perform the sluggify
    function transformStringToSlug(the_source , the_target){

        string = the_source.val();

        //Remove any special chars, ignoring any spaces or hyphens
        var slug = string.replace(/[^a-zA-Z0-9\ \-]/g, "");

        //Replace any spaces with hyphens
        slug = slug.split(' ').join('-');

        //Chuck it back into lowercase
        slug = slug.toLowerCase();

        //Valiate out any double hyphens
        slug = slug.split('--').join('-');

        var lastChar = slug.substring(slug.length -1, slug.length);
        if ( lastChar == '-'){
            slug = slug.substring(0 , slug.length -1 );
        }

        //Dump it back to the destination input
        the_target.val( slug );
    }

    var $arrColors = ['#20639B','#3CAEA3','#F6D55C','#E0E0E0','#ED553B'];
    Morris.Bar({
        element: 'morris-bar-example',
        data: chartData,
        xkey: 'y',
        ykeys: ['x'],
        labels: ['Votes'],
        gridTextSize: 12,
        resize: true,
        barColors: function (row, series, type) {
            mod = row.x % $arrColors.length
            return $arrColors[mod];
        }, 
        hideHover: true
    });

    $( ".modalbut" ).click(function(e) {
        let thisId = event.target.id;
        let res =  thisId.split("-");
        let id = res[1];
        $( "#candidateidedit" ).val(id);
    });

    document.getElementById("copybut").addEventListener("click", function() {
        copyToClipboard(document.getElementById("urlvote"));
    });

    function copyToClipboard(elem) {
        // create hidden text element, if it doesn't already exist
        var targetId = "_hiddenCopyText_";
        var isInput = elem.tagName === "INPUT" || elem.tagName === "TEXTAREA";
        var origSelectionStart, origSelectionEnd;
        if (isInput) {
            // can just use the original source element for the selection and copy
            target = elem;
            origSelectionStart = elem.selectionStart;
            origSelectionEnd = elem.selectionEnd;
        } else {
            // must use a temporary form element for the selection and copy
            target = document.getElementById(targetId);
            if (!target) {
                var target = document.createElement("textarea");
                target.style.position = "absolute";
                target.style.left = "-9999px";
                target.style.top = "0";
                target.id = targetId;
                document.body.appendChild(target);
            }
            target.textContent = elem.textContent;
        }
        // select the content
        var currentFocus = document.activeElement;
        target.focus();
        target.setSelectionRange(0, target.value.length);
        
        // copy the selection
        var succeed;
        try {
            succeed = document.execCommand("copy");
        } catch(e) {
            succeed = false;
        }
        // restore original focus
        if (currentFocus && typeof currentFocus.focus === "function") {
            currentFocus.focus();
        }
        
        if (isInput) {
            // restore prior selection
            elem.setSelectionRange(origSelectionStart, origSelectionEnd);
        } else {
            // clear temporary content
            target.textContent = "";
        }
        return succeed;
    }

</script>
            
@stop

@endsection