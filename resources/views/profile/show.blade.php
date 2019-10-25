<section class="content">
    <div class="row">
        <div class="col-md-4 snp-profile">
            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile snp-box-profile">
                    <div class="row snp-profile-top">
                        <div class="col-lg-5 change-picture">
                            <img class="profile-user-img img-responsive img-circle js-avatar" src="/public/upload/avatar-default.png" alt="User profile picture">
                            <a class="btn-change-picture" data-toggle="modal" data-target="#change-picture">
						<i class="fa fa-camera"></i>
					</a>
                        </div>
                        <div class="col-lg-7 snp-user-top-right">
                            <h3 class="profile-username snp-profile-username text-left">Hung Vo</h3>
                            <p class="text-muted">Member since: <span class="snp-created-at">2019-05-21 06:42:11</span></p>
                        </div>
                    </div>

                    <div class="snp-profile-header">
                        <span>General</span>
                    </div>
                    <table class="snp-profile-content">
                        <tbody>
                            <tr>
                                <td class="text-muted snp-profile-model">Gender</td>
                                <td class="text-muted">Male</td>
                            </tr>
                            <tr>
                                <td class="text-muted snp-profile-model">Date of birth</td>
                                <td class="text-muted">1988-06-25 00:00:00</td>
                            </tr>
                            <tr>
                                <td class="text-muted snp-profile-model" valign="top">Location</td>
                                <td class="text-muted">Viet Nam Da Nang Lien Chieu Hoa Khanh Nam K55/H1/35 Nam Cao</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="snp-profile-header">
                        <span>Contact Infomation</span>
                    </div>
                    <table class="snp-profile-content">
                        <tbody>
                            <tr>
                                <td class="text-muted snp-profile-model">Email</td>
                                <td class="text-muted">hungvt.itdng@gmail.com</td>
                            </tr>
                            <tr>
                                <td class="text-muted snp-profile-model">Phone</td>
                                <td class="text-muted">+84905747606</td>
                            </tr>
                        </tbody>
                    </table>
                    <a href="/user/change-password">Change password</a>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>

        <!-- Modal -->
        <div id="change-picture" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">×</button>
                        <h4 class="modal-title">Update Profile Picture</h4>
                    </div>
                    <div class="modal-body upload-form">
                        <div class="btn-upload">
                            <span><i class="fa fa-plus"></i> Upload Photo</span>
                            <input type="file" id="upload" title="Choose a file to upload" accept="image/*">
                        </div>
                        <div id="preview-upload" class="hide"></div>
                    </div>
                    <div class="modal-footer hide">
                        <button type="button" class="btn btn-default btn-cancal">Cancel</button>
                        <button type="button" class="btn btn-primary btn-save" data-dismiss="modal">Save</button>
                    </div>
                </div>
            </div>
        </div>

        <script src="/public/assets/js/croppie.js"></script>
        <script type="text/javascript">
            $(function(){
            		$uploadCrop = $('#preview-upload').croppie({
            			enableExif: true,
            			viewport: {
            				width: 300,
            				height: 300,
            				type: 'circle'
            			},
            			boundary: {
            				width: 400,
            				height: 400
            			}
            		});

            		$('#upload').on('change', function () {
            			var reader = new FileReader();
            			reader.onload = function (e) {
            				$('#preview-upload').toggleClass('hide');
            				$('.btn-upload').toggleClass('hide');
            				$('.modal-footer').toggleClass('hide');
            				$uploadCrop.croppie('bind', {
            					url: e.target.result
            				}).then(function(){
            					console.log('jQuery bind complete');
            				});
            			}
            			reader.readAsDataURL(this.files[0]);
            		});

            		$('.btn-cancal').on('click', function() {
            			closePopup();
            		});

            		$("#change-picture").on("hidden.bs.modal", function () {
            			closePopup();
            		});

            		$('.btn-save').on('click', function (ev) {
            			$uploadCrop.croppie('result', {
            				type: 'canvas',
            				size: 'viewport',
            				circle: false
            			}).then(function (res) {
            				$.ajax({
            					url: "/user/change-avatar",
            					type: "POST",
            					data: {"image":res},
            					success: function (response) {
            						if (response.error) {
            							alert(response.message);
            						} else {
            							$('.js-avatar').attr('src', response.data.path);
            						}
            					}
            				});
            			});
            		});

            		function closePopup() {
            			$('#preview-upload').toggleClass('hide');
            			$('.btn-upload').toggleClass('hide');
            			$('.modal-footer').toggleClass('hide');
            			$('#upload').val(null);
            		}
            	});
        </script>
        <!-- /.col -->
        <div class="col-md-8">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Setting</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="tab-pane" id="settings">
                        <form id="update-user-form" class="form-horizontal snp-profile-form" action="/user/profile" method="post">
                            <input type="hidden" name="_csrf" value="eyDz5fjAxYnlgkNE7ipq-D3l5Oh1nYF_uIDEfDnWD3oYTL7djpW88ZTPGym_TyGWS4SGvhL-7zKL76MtDuBGSA==">
                            <fieldset>
                                <div class="form-group field-firstname required">
                                    <label class="col-lg-2 control-label" for="firstname">First Name</label>
                                    <div class="col-lg-10"><input type="text" id="firstname" class="form-control" name="firstname" value="Hung" autocomplete="off" placeholder="Firstname" aria-required="true"></div>
                                    <div class="col-lg-10 snp-fr">
                                        <p class="help-block help-block-error"></p>
                                    </div>
                                </div>
                                <div class="form-group field-lastname">
                                    <label class="col-lg-2 control-label" for="lastname">Last Name</label>
                                    <div class="col-lg-10"><input type="text" id="lastname" class="form-control" name="lastname" value="Vo" autocomplete="off" placeholder="Lastname"></div>
                                    <div class="col-lg-10 snp-fr">
                                        <p class="help-block help-block-error"></p>
                                    </div>
                                </div>
                                <div class="form-group field-gender">
                                    <label class="col-lg-2 control-label" for="gender">Gender</label>
                                    <div class="col-lg-10"><select id="gender" class="form-control" name="gender" autocomplete="off">
<option value="0">Female</option>
<option value="1" selected="">Male</option>
</select></div>
                                    <div class="col-lg-10 snp-fr">
                                        <p class="help-block help-block-error"></p>
                                    </div>
                                </div>
                                <div class="form-group field-birthday">
                                    <label class="col-lg-2 control-label" for="birthday">Date of birth</label>
                                    <div class="col-lg-10"><input type="text" id="birthday" class="form-control" name="birthday" value="1988-06-25 00:00:00" autocomplete="off" placeholder="dd/mm/yyyy"></div>
                                    <div class="col-lg-10 snp-fr">
                                        <p class="help-block help-block-error"></p>
                                    </div>
                                </div>
                                <div class="form-group field-phone">
                                    <label class="col-lg-2 control-label" for="phone">Phone</label>
                                    <div class="col-lg-10"><input type="text" id="phone" class="form-control" name="phone" value="+84905747606" autocomplete="off" placeholder="Phone"></div>
                                    <div class="col-lg-10 snp-fr">
                                        <p class="help-block help-block-error"></p>
                                    </div>
                                </div>
                                <div class="form-group field-country">
                                    <label class="col-lg-2 control-label" for="country">Country</label>
                                    <div class="col-lg-10"><input type="text" id="country" class="form-control" name="country" value="Viet Nam" autocomplete="off" placeholder="Country"></div>
                                    <div class="col-lg-10 snp-fr">
                                        <p class="help-block help-block-error"></p>
                                    </div>
                                </div>
                                <div class="form-group field-city">
                                    <label class="col-lg-2 control-label" for="city">City</label>
                                    <div class="col-lg-10"><input type="text" id="city" class="form-control" name="city" value="Da Nang" autocomplete="off" placeholder="City"></div>
                                    <div class="col-lg-10 snp-fr">
                                        <p class="help-block help-block-error"></p>
                                    </div>
                                </div>
                                <div class="form-group field-district">
                                    <label class="col-lg-2 control-label" for="district">District</label>
                                    <div class="col-lg-10"><input type="text" id="district" class="form-control" name="district" value="Lien Chieu" autocomplete="off" placeholder="District"></div>
                                    <div class="col-lg-10 snp-fr">
                                        <p class="help-block help-block-error"></p>
                                    </div>
                                </div>
                                <div class="form-group field-wards">
                                    <label class="col-lg-2 control-label" for="wards">Wards</label>
                                    <div class="col-lg-10"><input type="text" id="wards" class="form-control" name="wards" value="Hoa Khanh Nam" autocomplete="off" placeholder="Wards"></div>
                                    <div class="col-lg-10 snp-fr">
                                        <p class="help-block help-block-error"></p>
                                    </div>
                                </div>
                                <div class="form-group field-street">
                                    <label class="col-lg-2 control-label" for="street">Street</label>
                                    <div class="col-lg-10"><input type="text" id="street" class="form-control" name="street" value="K55/H1/35 Nam Cao" autocomplete="off" placeholder="Street"></div>
                                    <div class="col-lg-10 snp-fr">
                                        <p class="help-block help-block-error"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-2 snp-fl">
                                        <button type="submit" class="btn btn-danger btn-block btn-flat" name="profile-button">Update</button> </div>
                                </div>
                                <fieldset>
                                </fieldset>
                            </fieldset>
                        </form>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
