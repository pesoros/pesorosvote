@extends('admin.layout.app')

@section('pagetitle')
    <div class="page-title-box">
        <div class="container-fluid">
            <div class="page-title-content">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4>Create Event</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')

<div class="container-fluid">

    <div class="row">

        <div class="col-xl-4">
        </div>
        <div class="col-xl-4">
            <form method="post" action="{{ url('dashboard/event/create') }}">
                @csrf
                <div class="card formcreate">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Event Detail</h4>
                        <div class="mb-0 row">
                            <div class="col-sm-12">
                                <label for="eventname" class="col-sm-12 col-form-label">Event Name</label>
                                <input class="form-control" type="text" value="" id="eventname" name="eventname">
                            </div>
                        </div>
                        <div class="mb-0 row">
                            <div class="col-sm-12">
                                <label for="eventslug" class="col-sm-12 col-form-label">Slug / End URL</label>
                                <input class="form-control" type="text" value="" id="eventslug" name="eventslug" readonly>
                            </div>
                        </div>
                        <div class="mb-0 row">
                            <div class="col-sm-12">
                                <label for="eventdescription" class="col-sm-12 col-form-label">Description</label>
                                <input class="form-control" type="text" value="" id="eventdescription" name="eventdescription">
                            </div>
                        </div>
                        <br>
                        <div class="mb-0 row">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-outline-secondary waves-effect">Create</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-xl-4">
        </div>

    </div>
    <!-- end row -->

</div>

@section('scripts')

<script>
    let source = $('#eventname');
    let target = $('#eventslug');

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

</script>
            
@stop

@endsection