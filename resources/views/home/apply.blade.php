@extends('home.layouts.default')
@section('content')
<style type="text/css">
    .navs{
        height: 80px;
        background-color:#212121;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }

    .divs{
        margin-bottom: 15px;
    }
</style>
<nav class="navbar navbar-static-top" >
    <!-- Sidebar toggle button-->
    <div class="navs">
        <nav class="navbar navbar-static-top" role="navigation">
            <div class="navbar-left">
                <a href="/" class="logo">
                    <img src="{{ asset('/images/logo.png') }}" style="padding: 11px 20px;" alt="logo">
                </a>
            </div>
            <div class="navbar-right">
                <ul class="nav navbar-nav">
                </ul>
            </div>
        </nav>
    </div>
</nav>
<div class="row">
    <form action="{{url('iApply/insert')}}" method="post">
        {{csrf_field()}}
        <div class="col-md-12">
            <div class="col-md-12">
                <div class="panel panel-primary filterable" style="overflow:auto;">
                    <div class="panel-heading">
                        <h3 class="panel-title"><big>Personal Information</big></h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-6">
                            <div class="form-horizontal">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">First Name</label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" name="firstName">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">Middle Name</label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" name="middleName">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">last Name</label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" name="lastName">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">Gender</label>
                                        <div class="col-sm-7">
                                            <label class="radio-inline"><input type="radio" name="gender" value="M">Male</label>
                                            <label class="radio-inline"><input type="radio" name="gender" value="F">Female</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">Civil Status</label>
                                        <div class="col-sm-7">
                                            <select name="civilstatus_id" class="form-control">
                                            @foreach($cstatus as $cstatus)
                                                <option value="{{$cstatus->id}}">{{$cstatus->statusName}}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">Date of Birth</label>
                                        <div class="col-sm-7">
                                            <input type="date" class="form-control" name="dob">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-horizontal">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">Birth Place</label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" name="birthPlace">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">Street</label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" name="street">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">Barangay</label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" name="barangay">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">City</label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" name="city">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">Contact</label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" name="contact">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">Email</label>
                                        <div class="col-sm-7">
                                            <input type="email" class="form-control" name="email">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="col-md-6">
                <div class="panel panel-primary filterable" style="overflow:auto;">
                    <div class="panel-heading">
                        <h3 class="panel-title"><big>Educational Background</big></h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-horizontal">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Attainment</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" name="attainment">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">School</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" name="school">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Course</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" name="course">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-primary filterable" style="overflow:auto;">
                    <div class="panel-heading">
                        <h3 class="panel-title"><big>Sea Experience</big></h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-horizontal">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">No. of Years</label>
                                    <div class="col-sm-7">
                                        <input type="number" class="form-control" name="noYears">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Rank/Position</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" name="rank">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="col-md-6">
                <div class="panel panel-primary filterable" style="overflow:auto;">
                    <div class="panel-heading">
                        <h3 class="panel-title"><big>Contact Person in case of Emergency</big></h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-horizontal">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Name</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" name="name">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Relationship</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" name="relationship">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Address</label>
                                    <div class="col-sm-7">
                                        <textarea class="form-control" name="address"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Contact</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" name="address">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-primary filterable" style="overflow:auto;">
                    <div class="panel-heading">
                        <h3 class="panel-title"><big>Available Programs</big></h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-horizontal">
                            <label for="email">Choose desired program:</label>
                            <select class="form-control" name="sprog_id" >
                                @foreach($sprogram as $sprograms)
                                <option value="{{$sprograms->trainingclass->id}}">{{$sprograms->rate->program->programName.' ( '. $sprograms->rate->duration. ' ' .$sprograms->rate->unit->unitName .' )'}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="col-md-12">
                <div class="panel panel-primary filterable" style="overflow:auto;">
                    <div class="panel-heading">
                        <h3 class="panel-title"><big>Trainings Attended</big></h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-12 table-responded">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th width="35%">Training Title</th>
                                        <th width="35%">Training Center</th>
                                        <th width="20%">Date Taken</th>
                                        <th width="10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="dynamic_field">
                                    <tr>
                                        <td><input type="text" class="form-control" name="trainingTitle[]"></td>
                                        <td><input type="text" class="form-control" name="trainingCenter[]"></td>
                                        <td><input type="date" class="form-control" name="dateTaken[]"></td>
                                        <td><button type="button" class="btn btn-success" id="add">Add more</button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="divs col-md-12 text-center" >
            <div class="col-md-6 col-md-offset-3">
                <button type="submit" class="btn btn-primary btn-lg col-md-12" >Submit</button>
            </div>
        </div>
    </form>
</div>
<script src="{{ asset('/js/jquery.min.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function(){
        var i = 1;
        $('#add').click(function(){
            i++;
            $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" class="form-control" name="trainingTitle[]"></td><td><input type="text"class="form-control" name="trainingCenter[]"></td><td><input type="date" class="form-control" name="dateTaken[]"></td><td><button name="remove" type="button" id="'+i+'" class="btn btn-danger remove" >X</button></td></tr>');
        });
        $(document).on('click','.remove',function(){
            var btn_id = $(this).attr('id');
            $('#row'+btn_id+'').remove();
        });
    });
</script>
@endsection