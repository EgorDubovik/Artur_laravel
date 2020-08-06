@extends('layout.main')

@section('content')

<div class="container mt-n10" style="padding-top: 150px;">
	<div class="row">
		<div class="col-lg-9">
			<!-- Basic Card-->
			<div id="basic">
				<div class="card mb-4">
					<div class="card-header">Create new FBA</div>
					<div class="card-body">
						<form>
							
							<p>Инфрмация о размерах</p>
							<div class="form-row">
								<div class="form-group col-md-4">
									<label for="box-width">Width</label>
									<input type="text" class="form-control" id="box-width"  name="box-width">
								</div>
								<div class="form-group col-md-4">
									<label for="box-length">Length</label>
									<input type="text" class="form-control" id="box-length"  name="box-length">
								</div>
								<div class="form-group col-md-4">
									<label for="box-height">Height</label>
									<input type="text" class="form-control" id="box-height"  name="box-height">
								</div>
							</div>
							<div class="form-row">
								<div class="form form-group col-md-6">
									<label for="box-weight">Weight</label>
									<input type="text" class="form-control" id="box-weight" name="box-weight">
								</div>
								<div class="form form-group col-md-6">
									<label for="box-count">Count</label>
									<input type="text" class="form-control" id="box-count" name="box-count">
								</div>
							</div>
							<hr>
							<div style="padding: 10px;">
								<p class="text-center">Дополнительно услуги над каждым придметом</p>
								<div class="form-row">
									<div class="form-group col-md-4">
										<label for="item-width">Width</label>
										<input type="text" class="form-control form-control-solid" id="item-width"  name="item-width">

										<label for="item-length">Length</label>
										<input type="text" class="form-control form-control-solid" id="item-length"  name="item-length">

										<label for="item-height">Height</label>
										<input type="text" class="form-control form-control-solid" id="item-height"  name="item-height">

										<label for="item-count">Count</label>
										<input type="text" class="form-control form-control-solid" id="item-count"  name="item-count">
									</div>
									<div class="form-group col-md-2"></div>
									<div class="form-group col-md-6">
										<div class="custom-control custom-checkbox custom-control-solid">
										    <input class="custom-control-input" id="customCheckSolid1" type="checkbox">
										    <label class="custom-control-label" for="customCheckSolid1">FNSKU Labeling <small class="text-muted ml-2">($0.10 per unit)</small></label>
										</div>
										<div class="custom-control custom-checkbox custom-control-solid">
										    <input class="custom-control-input" id="customCheckSolid2" type="checkbox">
										    <label class="custom-control-label" for="customCheckSolid2">Custom Labeling <small class="text-muted ml-2">($0.10 per unit)</small></label>
										</div>
										<div class="custom-control custom-checkbox custom-control-solid">
										    <input class="custom-control-input" id="customCheckSolid3" type="checkbox">
										    <label class="custom-control-label" for="customCheckSolid3">Expiration Labels <small class="text-muted ml-2">($0.10 per unit)</small></label>
										</div>
										<div class="custom-control custom-checkbox custom-control-solid">
										    <input class="custom-control-input" id="customCheckSolid4" type="checkbox">
										    <label class="custom-control-label" for="customCheckSolid4">Suffocation Warning Labels <small class="text-muted ml-2">($0.10 per unit)</small></label>
										</div>
										<div class="custom-control custom-checkbox custom-control-solid">
										    <input class="custom-control-input" id="customCheckSolid5" type="checkbox">
										    <label class="custom-control-label" for="customCheckSolid5">Inspection <small class="text-muted ml-2">($0.10 per unit)</small></label>
										</div>
										<div class="custom-control custom-checkbox custom-control-solid">
										    <input class="custom-control-input" id="customCheckSolid6" type="checkbox">
										    <label class="custom-control-label" for="customCheckSolid6">Marketing inserts <small class="text-muted ml-2">($0.10 per unit)</small></label>
										</div>
										<div class="custom-control custom-checkbox custom-control-solid">
										    <input class="custom-control-input" id="customCheckSolid6" type="checkbox">
										    <label class="custom-control-label" for="customCheckSolid6">Polybags <small class="text-muted ml-2">($0.10 per unit)</small></label>
										</div>
										<div class="custom-control custom-checkbox custom-control-solid">
										    <input class="custom-control-input" id="customCheckSolid6" type="checkbox">
										    <label class="custom-control-label" for="customCheckSolid6">Boxes <small class="text-muted ml-2">($0.10 per unit)</small></label>
										</div>
										<div class="custom-control custom-checkbox custom-control-solid">
										    <input class="custom-control-input" id="customCheckSolid6" type="checkbox">
										    <label class="custom-control-label" for="customCheckSolid6">Bubble wrap <small class="text-muted ml-2">($0.10 per unit)</small></label>
										</div>
										<div class="custom-control custom-checkbox custom-control-solid">
										    <input class="custom-control-input" id="customCheckSolid6" type="checkbox">
										    <label class="custom-control-label" for="customCheckSolid6">Wrap Paper <small class="text-muted ml-2">($0.10 per unit)</small></label>
										</div>
									</div>
								</div>
								<hr>
								<div class="form-row mt-3">
									<button class="btn btn-success btn-block" type="submit">Create</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
			<div class="col-lg-3">
				<div class="nav-sticky">
						<div class="card">
								<div class="card-body">
									Finaly Price:
									<h1 class="text-center mt-3" style="font-size: 40px;">$20.00</h1>
									<div class="form-row mt-3">
										<button class="btn btn-success btn-block" type="submit">Create</button>
									</div>
								</div>
						</div>
				</div>
			</div>
	</div>
</div>                        

@stop