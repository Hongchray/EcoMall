<style>
	#aizUploaderModal .modal-content {
		border: 0;
		border-radius: 18px;
		box-shadow: 0 24px 70px rgba(15, 23, 42, .24);
		overflow: hidden;
	}

	#aizUploaderModal .modal-header {
		background: #f8fbfe !important;
		border-bottom: 1px solid #e3f3fb;
		padding: 18px 22px 0;
	}

	#aizUploaderModal .uppy-modal-nav .nav-tabs {
		gap: 8px;
	}

	#aizUploaderModal .uppy-modal-nav .nav-link {
		border: 0;
		border-radius: 10px 10px 0 0;
		color: #64748b !important;
		font-size: 13px;
		font-weight: 800 !important;
		padding: 12px 16px;
	}

	#aizUploaderModal .uppy-modal-nav .nav-link.active {
		background: #fff;
		color: #3d98d1 !important;
		box-shadow: 0 -1px 0 #e3f3fb inset;
	}

	#aizUploaderModal .close {
		align-items: center;
		background: #fff;
		border: 1px solid #e3f3fb;
		border-radius: 50%;
		display: inline-flex;
		height: 34px;
		justify-content: center;
		opacity: 1;
		padding: 0;
		position: relative;
		width: 34px;
	}

	#aizUploaderModal .close span:before,
	#aizUploaderModal .close span:after {
		background: #64748b;
		content: "";
		height: 2px;
		left: 9px;
		position: absolute;
		top: 16px;
		width: 14px;
	}

	#aizUploaderModal .close span:before {
		transform: rotate(45deg);
	}

	#aizUploaderModal .close span:after {
		transform: rotate(-45deg);
	}

	#aizUploaderModal .modal-body {
		padding: 22px;
	}

	#aizUploaderModal .aiz-uploader-filter {
		background: #f8fbfe;
		border: 1px solid #e3f3fb !important;
		border-radius: 14px;
		margin-bottom: 18px !important;
		padding: 14px !important;
	}

	#aizUploaderModal .form-control,
	#aizUploaderModal .bootstrap-select > .dropdown-toggle {
		border: 1px solid #e2e8f0;
		border-radius: 8px !important;
		min-height: 38px;
	}

	#aizUploaderModal .aiz-uploader-all {
		background: #fff;
		border: 1px solid #edf2f7;
		border-radius: 14px;
	}

	#aizUploaderModal .modal-footer {
		background: #f8fbfe !important;
		border-top: 1px solid #e3f3fb;
		padding: 16px 22px;
	}

	#aizUploaderModal .aiz-uploader-selected {
		color: #1e293b;
		font-size: 13px;
		font-weight: 800;
	}

	#aizUploaderModal .aiz-uploader-selected-clear {
		color: #dc2626;
		font-size: 12px;
		font-weight: 800;
	}

	#aizUploaderModal .btn-primary {
		background: #3d98d1;
		border-color: #3d98d1;
		border-radius: 5px;
		font-size: 13px;
		font-weight: 800;
		min-height: 36px;
		padding-left: 14px;
		padding-right: 14px;
	}

	#aizUploaderModal .custom-control-label {
		color: #334155;
		font-size: 13px;
		font-weight: 700;
	}
</style>

<div class="modal fade" id="aizUploaderModal" data-backdrop="static" role="dialog" aria-hidden="true" >
	<div class="modal-dialog modal-adaptive" role="document">
		<div class="modal-content h-100">
			<div class="modal-header pb-0 bg-light">
				<div class="uppy-modal-nav">
					<ul class="nav nav-tabs border-0">
						<li class="nav-item">
							<a class="nav-link active font-weight-medium text-dark" data-toggle="tab" href="#aiz-select-file">{{ translate('Select File') }}</a>
						</li>
						<li class="nav-item">
							<a class="nav-link font-weight-medium text-dark" data-toggle="tab" href="#aiz-upload-new">{{ translate('Upload New') }}</a>
						</li>
					</ul>
				</div>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true"></span>
				</button>
			</div>
			<div class="modal-body">
				<div class="tab-content h-100">
					<div class="tab-pane active h-100" id="aiz-select-file">
						<div class="aiz-uploader-filter pt-1 pb-3 border-bottom mb-4">
							<div class="row align-items-center gutters-5 gutters-md-10 position-relative">
								<div class="col-xl-2 col-md-3 col-5">
									<div class="">
										<!-- Input -->
										<select class="form-control form-control-xs aiz-selectpicker" name="aiz-uploader-sort">
											<option value="newest" selected>{{ translate('Sort by newest') }}</option>
											<option value="oldest">{{ translate('Sort by oldest') }}</option>
											<option value="smallest">{{ translate('Sort by smallest') }}</option>
											<option value="largest">{{ translate('Sort by largest') }}</option>
										</select>
										<!-- End Input -->
									</div>
								</div>
								<div class="col-md-3 col-5">
									<div class="custom-control custom-radio">
										<input type="checkbox" class="custom-control-input" name="aiz-show-selected" id="aiz-show-selected" name="stylishRadio">
										<label class="custom-control-label" for="aiz-show-selected">
										{{ translate('Selected Only') }}
										</label>
									</div>
								</div>
								<div class="col-md-4 col-xl-3 ml-auto mr-0 col-2 position-static">
									<div class="aiz-uploader-search text-right">
										<input type="text" class="form-control form-control-xs" name="aiz-uploader-search" placeholder="{{ translate('Search your files') }}">
										<i class="search-icon d-md-none"><span></span></i>
									</div>
								</div>
							</div>
						</div>
						<div class="aiz-uploader-all clearfix c-scrollbar-light">
							<div class="align-items-center d-flex h-100 justify-content-center w-100">
								<div class="text-center">
									<h3>{{ translate('No files found') }}</h3>
								</div>
							</div>
						</div>
					</div>

					<div class="tab-pane h-100" id="aiz-upload-new">
						<div id="aiz-upload-files" class="h-100">
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer justify-content-between bg-light">
				<div class="flex-grow-1 overflow-hidden d-flex">
					<div class="">
						<div class="aiz-uploader-selected">{{ translate('0 File selected') }}</div>
						<button type="button" class="btn-link btn btn-sm p-0 aiz-uploader-selected-clear">{{ translate('Clear') }}</button>
					</div>
					<div class="mb-0 ml-3">
						<button type="button" class="btn btn-sm btn-primary" id="uploader_prev_btn">{{ translate('Prev') }}</button>
						<button type="button" class="btn btn-sm btn-primary" id="uploader_next_btn">{{ translate('Next') }}</button>
					</div>
				</div>
				<button type="button" class="btn btn-sm btn-primary" data-toggle="aizUploaderAddSelected">{{ translate('Add Files') }}</button>
			</div>
		</div>
	</div>
</div>
