<div class="modal fade" id="exampleFullScreenModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">CDN Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card border-top border-0 border-4 border-primary">
                            <div class="card-body p-3">
                                <form name="data-form" id="data-form" class="row g-2"        
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <input type="file" class="form-control" id="image" name="image">
                                            <label class="input-group-text" for="image">Image</label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="btn btn-primary" id="submitBtn"> <i
                                                class="fadeIn animated bx bx-check"></i> Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-5 row-cols-xxl-6 product-grid" id="imageData">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 row-cols-xxl-5">
					<div class="col">
						<div class="card">
							<img src="" width="200" id="modalImg" style="border: 1px solid #ededed;">
						</div>
					</div>
				</div>
                <div class="row">
                        <div class="col-md-12 ">
                        <div class="col-md-12">
                            <div class="input-group mb-3">
                                <span style="border: 1px solid #ced4da;padding: 5px;" id="imgLink"></span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="button" class="btn btn-secondary px-5 btnCopy">Copy URL</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                        
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
