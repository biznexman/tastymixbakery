@extends('layouts.dashboard')
@section('page_heading','Filters')
@section('section')
           

    <div class="row">
    	<form role="form" action="manageProjects" method="get" id="projectsFilter" name="projectsFilter">

		    <input type="hidden" name="_token" value="{{ csrf_token() }}">

		    <div class="col-sm-3">
				@section ('grid10_panel_body')
				<div class="text-center">
					<div class="form-group">
			            <label>Supplier ID</label>
			            <input id="supplierid" name="supplierid" class="form-control">
			        </div>
				</div>
				@endsection
				@include('widgets.panel', array('controls'=> true, 'as'=> 'grid10'))
			</div>


			<div class="col-sm-3">
				@section ('grid11_panel_body')
				<div class="text-center">
					<div class="form-group">
			            <label>Bill No.</label>
			            <input id="billno" name="billno" class="form-control">
			        </div>
				</div>
				@endsection
				@include('widgets.panel', array('controls'=> true, 'as'=> 'grid11'))
			</div>

			<div class="col-sm-3">
				@section ('grid9_panel_body')
				<div class="text-center">
					<div class="form-group">
			            <label>Date</label>
			            <input type="text" id="datepicker" name="datepicker" class="form-control" placeholder="yyyy-mm-dd">
			        </div>
				</div>
				@endsection
				@include('widgets.panel', array('controls'=> true, 'as'=> 'grid9'))
			</div>

			

			<div class="col-sm-3">
				<div class="text-center">
					<div class="form-group">
						<br><br><br><br>
			            <button id="sort" name="sort" type="button" class="btn btn-primary">Sort</button>
			        </div>
				</div>
			</div>

		</form>
    </div>
	
	<div class="row">
		<div class="col-sm-6">
			@section ('htable_panel_title','Bills')
			@section ('htable_panel_body')
			@include('widgets.table', array('class'=>'table-hover'))
			@endsection
			@include('widgets.panel', array('header'=>true, 'as'=>'htable'))
		</div>
	</div>
            
@stop
