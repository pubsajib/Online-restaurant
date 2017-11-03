<?php require_once "view/base/admin/header.php";?>


	<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="common-parent">
							<h4 class="text-bold">Hours</h4>

							<!--warning-->
							<div class="alert alert-success alert-dismissible" role="alert" style="display: none;">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							</div>
							<div class="alert alert-danger alert-dismissible" role="alert" style="display: none;">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							</div>
							<!--warning end-->
							<form id="update_opening_hour" method="post" action="">

								<div class="day_item" data-name="sun">
									<div class="pull-left">
										<ul class="time-list">
											<li>
												<b>Sunday</b>
											</li>

											<li class="switch-li">
												<span class="pull-left">
													<div class="material-switch">
														<input class="swicth-check" id="Sunday" name="switch[]" type="checkbox" <?php if(is_open($deliveryTime, 'sunday')==1){echo "checked";} ?>/>
														<label for="Sunday" class="label-default"></label>
													</div>
														<input id="Sunday_switch" name="switch_check[]" type="hidden" value="<?php echo is_open($deliveryTime, 'sunday')?>"/>
														<input id="" name="day_name[]" type="hidden" value="sunday"/>
												</span>
												<span class="margin-left-10 open-status"><?php if(is_open($deliveryTime, 'sunday')==1){echo "Open";} else{echo "Closed";} ?></span>
											</li>
										</ul>
									</div>

									<div class="all_time_section pull-left"  style="<?php if(is_open($deliveryTime, 'sunday')==0){ echo "display: none;";}?>">
										<?php
										$times = get_times($deliveryTime, 'sunday');
										$count = 1;
										foreach($times as $time){
											if($count==1){ ?>
												<div class="static_time_section pull-left dynamic_multi_section">
													<ul class="time-range time-list pull-left no-padding">
														<li>
															<!-- <input id="startTime" class="time-picker" name="start_time[]" value="<?php echo get_start_time($deliveryTime, 'sunday')?>" placeholder="12:00 AM"/> -->
															<select id="sun" class="form-control openCloseHour" name="sun_start_time[]">
																<option value="24 hours" <?php if($time->start_time=='24 hours'){echo "selected";}?>>24 hours</option>
																<option value="12:00 am" <?php if($time->start_time=='12:00 am'){echo "selected=''";}?>>12:00 am</option>
																<option value="12:30 am" <?php if($time->start_time=='12:30 am'){echo "selected=''";}?>>12:30 am</option>
																<option value="1:00 am" <?php if($time->start_time=='1:00 am'){echo "selected=''";}?>>1:00 am</option>
																<option value="1:30 am" <?php if($time->start_time=='1:30 am'){echo "selected=''";}?>>1:30 am</option>
																<option value="2:00 am" <?php if($time->start_time=='2:00 am'){echo "selected=''";}?>>2:00 am</option>
																<option value="2:30 am" <?php if($time->start_time=='2:30 am'){echo "selected=''";}?>>2:30 am</option>
																<option value="3:00 am" <?php if($time->start_time=='3:00 am'){echo "selected=''";}?>>3:00 am</option>
																<option value="3:30 am" <?php if($time->start_time=='3:30 am'){echo "selected=''";}?>>3:30 am</option>
																<option value="4:00 am" <?php if($time->start_time=='4:00 am'){echo "selected=''";}?>>4:00 am</option>
																<option value="4:30 am" <?php if($time->start_time=='4:30 am'){echo "selected=''";}?>>4:30 am</option>
																<option value="5:00 am" <?php if($time->start_time=='5:00 am'){echo "selected=''";}?>>5:00 am</option>
																<option value="5:30 am" <?php if($time->start_time=='5:30 am'){echo "selected=''";}?>>5:30 am</option>
																<option value="6:00 am" <?php if($time->start_time=='6:00 am'){echo "selected=''";}?>>6:00 am</option>
																<option value="6:30 am" <?php if($time->start_time=='6:30 am'){echo "selected=''";}?>>6:30 am</option>
																<option value="7:00 am" <?php if($time->start_time=='7:00 am'){echo "selected=''";}?>>7:00 am</option>
																<option value="7:30 am" <?php if($time->start_time=='7:30 am'){echo "selected=''";}?>>7:30 am</option>
																<option value="8:00 am" <?php if($time->start_time=='8:00 am'){echo "selected=''";}?>>8:00 am</option>
																<option value="8:30 am" <?php if($time->start_time=='8:30 am'){echo "selected=''";}?>>8:30 am</option>
																<option value="9:00 am" <?php if($time->start_time=='9:00 am'){echo "selected=''";}?>>9:00 am</option>
																<option value="9:30 am" <?php if($time->start_time=='9:30 am'){echo "selected=''";}?>>9:30 am</option>
																<option value="10:00 am" <?php if($time->start_time=='10:00 am'){echo "selected=''";}?>>10:00 am</option>
																<option value="10:30 am" <?php if($time->start_time=='10:30 am'){echo "selected=''";}?>>10:30 am</option>
																<option value="11:00 am" <?php if($time->start_time=='11:00 am'){echo "selected=''";}?>>11:00 am</option>
																<option value="11:30 am" <?php if($time->start_time=='11:30 am'){echo "selected=''";}?>>11:30 am</option>
																<option value="12:00 pm" <?php if($time->start_time=='12:00 pm'){echo "selected=''";}?>>12:00 pm</option>
																<option value="12:30 pm <?php if($time->start_time=='12:30 pm'){echo "selected=''";}?>">12:30 pm</option>
																<option value="1:00 pm" <?php if($time->start_time=='1:00 pm'){echo "selected=''";}?>>1:00 pm</option>
																<option value="1:30 pm" <?php if($time->start_time=='1:30 pm'){echo "selected=''";}?>>1:30 pm</option>
																<option value="2:00 pm" <?php if($time->start_time=='2:00 pm'){echo "selected=''";}?>>2:00 pm</option>
																<option value="2:30 pm" <?php if($time->start_time=='2:30 pm'){echo "selected=''";}?>>2:30 pm</option>
																<option value="3:00 pm" <?php if($time->start_time=='3:00 pm'){echo "selected=''";}?>>3:00 pm</option>
																<option value="3:30 pm" <?php if($time->start_time=='3:30 pm'){echo "selected=''";}?>>3:30 pm</option>
																<option value="4:00 pm" <?php if($time->start_time=='4:00 pm'){echo "selected=''";}?>>4:00 pm</option>
																<option value="4:30 pm" <?php if($time->start_time=='4:30 pm'){echo "selected=''";}?>>4:30 pm</option>
																<option value="5:00 pm" <?php if($time->start_time=='5:00 pm'){echo "selected=''";}?>>5:00 pm</option>
																<option value="5:30 pm" <?php if($time->start_time=='5:30 pm'){echo "selected=''";}?>>5:30 pm</option>
																<option value="6:00 pm" <?php if($time->start_time=='6:00 pm'){echo "selected=''";}?>>6:00 pm</option>
																<option value="6:30 pm" <?php if($time->start_time=='6:30 pm'){echo "selected=''";}?>>6:30 pm</option>
																<option value="7:00 pm" <?php if($time->start_time=='7:00 pm'){echo "selected=''";}?>>7:00 pm</option>
																<option value="7:30 pm" <?php if($time->start_time=='7:30 pm'){echo "selected=''";}?>>7:30 pm</option>
																<option value="8:00 pm" <?php if($time->start_time=='8:00 pm'){echo "selected=''";}?>>8:00 pm</option>
																<option value="8:30 pm" <?php if($time->start_time=='8:30 pm'){echo "selected=''";}?>>8:30 pm</option>
																<option value="9:00 pm" <?php if($time->start_time=='9:00 pm'){echo "selected=''";}?>>9:00 pm</option>
																<option value="9:30 pm" <?php if($time->start_time=='9:30 pm'){echo "selected=''";}?>>9:30 pm</option>
																<option value="10:00 pm" <?php if($time->start_time=='10:00 pm'){echo "selected=''";}?>>10:00 pm</option>
																<option value="10:30 pm" <?php if($time->start_time=='10:30 pm'){echo "selected=''";}?>>10:30 pm</option>
																<option value="11:00 pm" <?php if($time->start_time=='11:00 pm'){echo "selected=''";}?>>11:00 pm</option>
																<option value="11:30 pm" <?php if($time->start_time=='11:30 pm'){echo "selected=''";}?>>11:30 pm</option>
															</select>
														</li>

														<li style="width:20px;">
															<span>-</span>
														</li>

														<li>
															<!--input id="endTime" class="time-picker" name="end_time[]" value="<?php echo get_end_time($deliveryTime, 'sunday')?>" placeholder="11:30 AM"/-->
															<select id="sun_close" class="form-control openCloseHour" name="sun_end_time[]" >
																<option value="12:00 am" <?php if($time->end_time=='12:00 am'){echo "selected=''";}?>>12:00 am</option>
																<option value="12:30 am" <?php if($time->end_time=='12:30 am'){echo "selected=''";}?>>12:30 am</option>
																<option value="1:00 am" <?php if($time->end_time=='1:00 am'){echo "selected=''";}?>>1:00 am</option>
																<option value="1:30 am" <?php if($time->end_time=='1:30 am'){echo "selected=''";}?>>1:30 am</option>
																<option value="2:00 am" <?php if($time->end_time=='2:00 am'){echo "selected=''";}?>>2:00 am</option>
																<option value="2:30 am" <?php if($time->end_time=='2:30 am'){echo "selected=''";}?>>2:30 am</option>
																<option value="3:00 am" <?php if($time->end_time=='3:00 am'){echo "selected=''";}?>>3:00 am</option>
																<option value="3:30 am" <?php if($time->end_time=='3:30 am'){echo "selected=''";}?>>3:30 am</option>
																<option value="4:00 am" <?php if($time->end_time=='4:00 am'){echo "selected=''";}?>>4:00 am</option>
																<option value="4:30 am" <?php if($time->end_time=='4:30 am'){echo "selected=''";}?>>4:30 am</option>
																<option value="5:00 am" <?php if($time->end_time=='5:00 am'){echo "selected=''";}?>>5:00 am</option>
																<option value="5:30 am" <?php if($time->end_time=='5:30 am'){echo "selected=''";}?>>5:30 am</option>
																<option value="6:00 am" <?php if($time->end_time=='6:00 am'){echo "selected=''";}?>>6:00 am</option>
																<option value="6:30 am" <?php if($time->end_time=='6:30 am'){echo "selected=''";}?>>6:30 am</option>
																<option value="7:00 am" <?php if($time->end_time=='7:00 am'){echo "selected=''";}?>>7:00 am</option>
																<option value="7:30 am" <?php if($time->end_time=='7:30 am'){echo "selected=''";}?>>7:30 am</option>
																<option value="8:00 am" <?php if($time->end_time=='8:00 am'){echo "selected=''";}?>>8:00 am</option>
																<option value="8:30 am" <?php if($time->end_time=='8:30 am'){echo "selected=''";}?>>8:30 am</option>
																<option value="9:00 am" <?php if($time->end_time=='9:00 am'){echo "selected=''";}?>>9:00 am</option>
																<option value="9:30 am" <?php if($time->end_time=='9:30 am'){echo "selected=''";}?>>9:30 am</option>
																<option value="10:00 am" <?php if($time->end_time=='10:00 am'){echo "selected=''";}?>>10:00 am</option>
																<option value="10:30 am" <?php if($time->end_time=='10:30 am'){echo "selected=''";}?>>10:30 am</option>
																<option value="11:00 am" <?php if($time->end_time=='11:00 am'){echo "selected=''";}?>>11:00 am</option>
																<option value="11:30 am" <?php if($time->end_time=='11:30 am'){echo "selected=''";}?>>11:30 am</option>
																<option value="12:00 pm" <?php if($time->end_time=='12:00 pm'){echo "selected=''";}?>>12:00 pm</option>
																<option value="12:30 pm <?php if($time->end_time=='12:30 pm'){echo "selected=''";}?>">12:30 pm</option>
																<option value="1:00 pm" <?php if($time->end_time=='1:00 pm'){echo "selected=''";}?>>1:00 pm</option>
																<option value="1:30 pm" <?php if($time->end_time=='1:30 pm'){echo "selected=''";}?>>1:30 pm</option>
																<option value="2:00 pm" <?php if($time->end_time=='2:00 pm'){echo "selected=''";}?>>2:00 pm</option>
																<option value="2:30 pm" <?php if($time->end_time=='2:30 pm'){echo "selected=''";}?>>2:30 pm</option>
																<option value="3:00 pm" <?php if($time->end_time=='3:00 pm'){echo "selected=''";}?>>3:00 pm</option>
																<option value="3:30 pm" <?php if($time->end_time=='3:30 pm'){echo "selected=''";}?>>3:30 pm</option>
																<option value="4:00 pm" <?php if($time->end_time=='4:00 pm'){echo "selected=''";}?>>4:00 pm</option>
																<option value="4:30 pm" <?php if($time->end_time=='4:30 pm'){echo "selected=''";}?>>4:30 pm</option>
																<option value="5:00 pm" <?php if($time->end_time=='5:00 pm'){echo "selected=''";}?>>5:00 pm</option>
																<option value="5:30 pm" <?php if($time->end_time=='5:30 pm'){echo "selected=''";}?>>5:30 pm</option>
																<option value="6:00 pm" <?php if($time->end_time=='6:00 pm'){echo "selected=''";}?>>6:00 pm</option>
																<option value="6:30 pm" <?php if($time->end_time=='6:30 pm'){echo "selected=''";}?>>6:30 pm</option>
																<option value="7:00 pm" <?php if($time->end_time=='7:00 pm'){echo "selected=''";}?>>7:00 pm</option>
																<option value="7:30 pm" <?php if($time->end_time=='7:30 pm'){echo "selected=''";}?>>7:30 pm</option>
																<option value="8:00 pm" <?php if($time->end_time=='8:00 pm'){echo "selected=''";}?>>8:00 pm</option>
																<option value="8:30 pm" <?php if($time->end_time=='8:30 pm'){echo "selected=''";}?>>8:30 pm</option>
																<option value="9:00 pm" <?php if($time->end_time=='9:00 pm'){echo "selected=''";}?>>9:00 pm</option>
																<option value="9:30 pm" <?php if($time->end_time=='9:30 pm'){echo "selected=''";}?>>9:30 pm</option>
																<option value="10:00 pm" <?php if($time->end_time=='10:00 pm'){echo "selected=''";}?>>10:00 pm</option>
																<option value="10:30 pm" <?php if($time->end_time=='10:30 pm'){echo "selected=''";}?>>10:30 pm</option>
																<option value="11:00 pm" <?php if($time->end_time=='11:00 pm'){echo "selected=''";}?>>11:00 pm</option>
																<option value="11:30 pm" <?php if($time->end_time=='11:30 pm'){echo "selected=''";}?>>11:30 pm</option>
															</select>
														</li>
													</ul>

													<div class="pull-left">
												<span class="pull-left">
		                                            <a class="btn btn-primary dynamic_time_add" href="javascript:;">
		                                                <i class="fa fa-plus-circle" aria-hidden="true"></i>
		                                            </a>
		                                        </span>

														<span class="pull-left margin-left-10">
		                                            <a class="btn btn-danger" href="javascript:;" disabled="">
		                                                <i class="fa fa-minus-circle" aria-hidden="true"></i>
		                                            </a>
		                                        </span>
													</div>
												</div>
											<?php }
											else{ ?>
												<div class="dynamic_time_section_area">
													<div class="dynamic_multi_time dynamic_multi_section">
														<ul class="time-range time-list pull-left no-padding">
															<li>

																<select id="sun" class="form-control openCloseHour" name="sun_start_time[]">
																	<option value="24 hours" <?php if($time->start_time=='24 hours'){echo "selected";}?>>24 hours</option>
																	<option value="12:00 am" <?php if($time->start_time=='12:00 am'){echo "selected=''";}?>>12:00 am</option>
																	<option value="12:30 am" <?php if($time->start_time=='12:30 am'){echo "selected=''";}?>>12:30 am</option>
																	<option value="1:00 am" <?php if($time->start_time=='1:00 am'){echo "selected=''";}?>>1:00 am</option>
																	<option value="1:30 am" <?php if($time->start_time=='1:30 am'){echo "selected=''";}?>>1:30 am</option>
																	<option value="2:00 am" <?php if($time->start_time=='2:00 am'){echo "selected=''";}?>>2:00 am</option>
																	<option value="2:30 am" <?php if($time->start_time=='2:30 am'){echo "selected=''";}?>>2:30 am</option>
																	<option value="3:00 am" <?php if($time->start_time=='3:00 am'){echo "selected=''";}?>>3:00 am</option>
																	<option value="3:30 am" <?php if($time->start_time=='3:30 am'){echo "selected=''";}?>>3:30 am</option>
																	<option value="4:00 am" <?php if($time->start_time=='4:00 am'){echo "selected=''";}?>>4:00 am</option>
																	<option value="4:30 am" <?php if($time->start_time=='4:30 am'){echo "selected=''";}?>>4:30 am</option>
																	<option value="5:00 am" <?php if($time->start_time=='5:00 am'){echo "selected=''";}?>>5:00 am</option>
																	<option value="5:30 am" <?php if($time->start_time=='5:30 am'){echo "selected=''";}?>>5:30 am</option>
																	<option value="6:00 am" <?php if($time->start_time=='6:00 am'){echo "selected=''";}?>>6:00 am</option>
																	<option value="6:30 am" <?php if($time->start_time=='6:30 am'){echo "selected=''";}?>>6:30 am</option>
																	<option value="7:00 am" <?php if($time->start_time=='7:00 am'){echo "selected=''";}?>>7:00 am</option>
																	<option value="7:30 am" <?php if($time->start_time=='7:30 am'){echo "selected=''";}?>>7:30 am</option>
																	<option value="8:00 am" <?php if($time->start_time=='8:00 am'){echo "selected=''";}?>>8:00 am</option>
																	<option value="8:30 am" <?php if($time->start_time=='8:30 am'){echo "selected=''";}?>>8:30 am</option>
																	<option value="9:00 am" <?php if($time->start_time=='9:00 am'){echo "selected=''";}?>>9:00 am</option>
																	<option value="9:30 am" <?php if($time->start_time=='9:30 am'){echo "selected=''";}?>>9:30 am</option>
																	<option value="10:00 am" <?php if($time->start_time=='10:00 am'){echo "selected=''";}?>>10:00 am</option>
																	<option value="10:30 am" <?php if($time->start_time=='10:30 am'){echo "selected=''";}?>>10:30 am</option>
																	<option value="11:00 am" <?php if($time->start_time=='11:00 am'){echo "selected=''";}?>>11:00 am</option>
																	<option value="11:30 am" <?php if($time->start_time=='11:30 am'){echo "selected=''";}?>>11:30 am</option>
																	<option value="12:00 pm" <?php if($time->start_time=='12:00 pm'){echo "selected=''";}?>>12:00 pm</option>
																	<option value="12:30 pm <?php if($time->start_time=='12:30 pm'){echo "selected=''";}?>">12:30 pm</option>
																	<option value="1:00 pm" <?php if($time->start_time=='1:00 pm'){echo "selected=''";}?>>1:00 pm</option>
																	<option value="1:30 pm" <?php if($time->start_time=='1:30 pm'){echo "selected=''";}?>>1:30 pm</option>
																	<option value="2:00 pm" <?php if($time->start_time=='2:00 pm'){echo "selected=''";}?>>2:00 pm</option>
																	<option value="2:30 pm" <?php if($time->start_time=='2:30 pm'){echo "selected=''";}?>>2:30 pm</option>
																	<option value="3:00 pm" <?php if($time->start_time=='3:00 pm'){echo "selected=''";}?>>3:00 pm</option>
																	<option value="3:30 pm" <?php if($time->start_time=='3:30 pm'){echo "selected=''";}?>>3:30 pm</option>
																	<option value="4:00 pm" <?php if($time->start_time=='4:00 pm'){echo "selected=''";}?>>4:00 pm</option>
																	<option value="4:30 pm" <?php if($time->start_time=='4:30 pm'){echo "selected=''";}?>>4:30 pm</option>
																	<option value="5:00 pm" <?php if($time->start_time=='5:00 pm'){echo "selected=''";}?>>5:00 pm</option>
																	<option value="5:30 pm" <?php if($time->start_time=='5:30 pm'){echo "selected=''";}?>>5:30 pm</option>
																	<option value="6:00 pm" <?php if($time->start_time=='6:00 pm'){echo "selected=''";}?>>6:00 pm</option>
																	<option value="6:30 pm" <?php if($time->start_time=='6:30 pm'){echo "selected=''";}?>>6:30 pm</option>
																	<option value="7:00 pm" <?php if($time->start_time=='7:00 pm'){echo "selected=''";}?>>7:00 pm</option>
																	<option value="7:30 pm" <?php if($time->start_time=='7:30 pm'){echo "selected=''";}?>>7:30 pm</option>
																	<option value="8:00 pm" <?php if($time->start_time=='8:00 pm'){echo "selected=''";}?>>8:00 pm</option>
																	<option value="8:30 pm" <?php if($time->start_time=='8:30 pm'){echo "selected=''";}?>>8:30 pm</option>
																	<option value="9:00 pm" <?php if($time->start_time=='9:00 pm'){echo "selected=''";}?>>9:00 pm</option>
																	<option value="9:30 pm" <?php if($time->start_time=='9:30 pm'){echo "selected=''";}?>>9:30 pm</option>
																	<option value="10:00 pm" <?php if($time->start_time=='10:00 pm'){echo "selected=''";}?>>10:00 pm</option>
																	<option value="10:30 pm" <?php if($time->start_time=='10:30 pm'){echo "selected=''";}?>>10:30 pm</option>
																	<option value="11:00 pm" <?php if($time->start_time=='11:00 pm'){echo "selected=''";}?>>11:00 pm</option>
																	<option value="11:30 pm" <?php if($time->start_time=='11:30 pm'){echo "selected=''";}?>>11:30 pm</option>
																</select>
															</li>

															<li style="width:20px;">
																<span>-</span>
															</li>

															<li>

																<select id="sun_close" class="form-control openCloseHour" name="sun_end_time[]">
																	<option value="12:00 am" <?php if($time->end_time=='12:00 am'){echo "selected=''";}?>>12:00 am</option>
																	<option value="12:30 am" <?php if($time->end_time=='12:30 am'){echo "selected=''";}?>>12:30 am</option>
																	<option value="1:00 am" <?php if($time->end_time=='1:00 am'){echo "selected=''";}?>>1:00 am</option>
																	<option value="1:30 am" <?php if($time->end_time=='1:30 am'){echo "selected=''";}?>>1:30 am</option>
																	<option value="2:00 am" <?php if($time->end_time=='2:00 am'){echo "selected=''";}?>>2:00 am</option>
																	<option value="2:30 am" <?php if($time->end_time=='2:30 am'){echo "selected=''";}?>>2:30 am</option>
																	<option value="3:00 am" <?php if($time->end_time=='3:00 am'){echo "selected=''";}?>>3:00 am</option>
																	<option value="3:30 am" <?php if($time->end_time=='3:30 am'){echo "selected=''";}?>>3:30 am</option>
																	<option value="4:00 am" <?php if($time->end_time=='4:00 am'){echo "selected=''";}?>>4:00 am</option>
																	<option value="4:30 am" <?php if($time->end_time=='4:30 am'){echo "selected=''";}?>>4:30 am</option>
																	<option value="5:00 am" <?php if($time->end_time=='5:00 am'){echo "selected=''";}?>>5:00 am</option>
																	<option value="5:30 am" <?php if($time->end_time=='5:30 am'){echo "selected=''";}?>>5:30 am</option>
																	<option value="6:00 am" <?php if($time->end_time=='6:00 am'){echo "selected=''";}?>>6:00 am</option>
																	<option value="6:30 am" <?php if($time->end_time=='6:30 am'){echo "selected=''";}?>>6:30 am</option>
																	<option value="7:00 am" <?php if($time->end_time=='7:00 am'){echo "selected=''";}?>>7:00 am</option>
																	<option value="7:30 am" <?php if($time->end_time=='7:30 am'){echo "selected=''";}?>>7:30 am</option>
																	<option value="8:00 am" <?php if($time->end_time=='8:00 am'){echo "selected=''";}?>>8:00 am</option>
																	<option value="8:30 am" <?php if($time->end_time=='8:30 am'){echo "selected=''";}?>>8:30 am</option>
																	<option value="9:00 am" <?php if($time->end_time=='9:00 am'){echo "selected=''";}?>>9:00 am</option>
																	<option value="9:30 am" <?php if($time->end_time=='9:30 am'){echo "selected=''";}?>>9:30 am</option>
																	<option value="10:00 am" <?php if($time->end_time=='10:00 am'){echo "selected=''";}?>>10:00 am</option>
																	<option value="10:30 am" <?php if($time->end_time=='10:30 am'){echo "selected=''";}?>>10:30 am</option>
																	<option value="11:00 am" <?php if($time->end_time=='11:00 am'){echo "selected=''";}?>>11:00 am</option>
																	<option value="11:30 am" <?php if($time->end_time=='11:30 am'){echo "selected=''";}?>>11:30 am</option>
																	<option value="12:00 pm" <?php if($time->end_time=='12:00 pm'){echo "selected=''";}?>>12:00 pm</option>
																	<option value="12:30 pm <?php if($time->end_time=='12:30 pm'){echo "selected=''";}?>">12:30 pm</option>
																	<option value="1:00 pm" <?php if($time->end_time=='1:00 pm'){echo "selected=''";}?>>1:00 pm</option>
																	<option value="1:30 pm" <?php if($time->end_time=='1:30 pm'){echo "selected=''";}?>>1:30 pm</option>
																	<option value="2:00 pm" <?php if($time->end_time=='2:00 pm'){echo "selected=''";}?>>2:00 pm</option>
																	<option value="2:30 pm" <?php if($time->end_time=='2:30 pm'){echo "selected=''";}?>>2:30 pm</option>
																	<option value="3:00 pm" <?php if($time->end_time=='3:00 pm'){echo "selected=''";}?>>3:00 pm</option>
																	<option value="3:30 pm" <?php if($time->end_time=='3:30 pm'){echo "selected=''";}?>>3:30 pm</option>
																	<option value="4:00 pm" <?php if($time->end_time=='4:00 pm'){echo "selected=''";}?>>4:00 pm</option>
																	<option value="4:30 pm" <?php if($time->end_time=='4:30 pm'){echo "selected=''";}?>>4:30 pm</option>
																	<option value="5:00 pm" <?php if($time->end_time=='5:00 pm'){echo "selected=''";}?>>5:00 pm</option>
																	<option value="5:30 pm" <?php if($time->end_time=='5:30 pm'){echo "selected=''";}?>>5:30 pm</option>
																	<option value="6:00 pm" <?php if($time->end_time=='6:00 pm'){echo "selected=''";}?>>6:00 pm</option>
																	<option value="6:30 pm" <?php if($time->end_time=='6:30 pm'){echo "selected=''";}?>>6:30 pm</option>
																	<option value="7:00 pm" <?php if($time->end_time=='7:00 pm'){echo "selected=''";}?>>7:00 pm</option>
																	<option value="7:30 pm" <?php if($time->end_time=='7:30 pm'){echo "selected=''";}?>>7:30 pm</option>
																	<option value="8:00 pm" <?php if($time->end_time=='8:00 pm'){echo "selected=''";}?>>8:00 pm</option>
																	<option value="8:30 pm" <?php if($time->end_time=='8:30 pm'){echo "selected=''";}?>>8:30 pm</option>
																	<option value="9:00 pm" <?php if($time->end_time=='9:00 pm'){echo "selected=''";}?>>9:00 pm</option>
																	<option value="9:30 pm" <?php if($time->end_time=='9:30 pm'){echo "selected=''";}?>>9:30 pm</option>
																	<option value="10:00 pm" <?php if($time->end_time=='10:00 pm'){echo "selected=''";}?>>10:00 pm</option>
																	<option value="10:30 pm" <?php if($time->end_time=='10:30 pm'){echo "selected=''";}?>>10:30 pm</option>
																	<option value="11:00 pm" <?php if($time->end_time=='11:00 pm'){echo "selected=''";}?>>11:00 pm</option>
																	<option value="11:30 pm" <?php if($time->end_time=='11:30 pm'){echo "selected=''";}?>>11:30 pm</option>
																</select>
															</li>
														</ul>

														<div class="pull-left">
											<span class="pull-left">
	                                            <a class="btn btn-primary dynamic_time_add" href="javascript:;">
	                                                <i class="fa fa-plus-circle" aria-hidden="true"></i>
	                                            </a>
	                                        </span>

															<span class="pull-left margin-left-10">
	                                            <a class="btn btn-danger dynamic_time_delete" href="javascript:;">
	                                                <i class="fa fa-minus-circle" aria-hidden="true"></i>
	                                            </a>
	                                        </span>
														</div>
													</div>
												</div>
										<?php }		//end else
											$count++;
										} //end foreach
										?>

										<?php if(count($times)==1){?>
											<div class="dynamic_time_section_area"></div>
										<?php } ?>
									</div>
								</div>
								
								<div class="day_item" data-name="mon">
									<div class="pull-left">
										<ul class="time-list">
											<li>
												<b>Monday</b>
											</li>

											<li class="switch-li">
												<span class="pull-left">
													<div class="material-switch">
														<input class="swicth-check" id="Monday" name="switch[]" type="checkbox"  <?php if(is_open($deliveryTime, 'monday')==1){echo "checked";} ?>/>
														<label for="Monday" class="label-default"></label>
													</div>
														<input id="Monday_switch" name="switch_check[]" type="hidden" value="<?php echo is_open($deliveryTime, 'monday')?>"/>
														<input id="" name="day_name[]" type="hidden" value="monday"/>
												</span>
												<span class="margin-left-10 open-status"><?php if(is_open($deliveryTime, 'monday')==1){echo "Open";} else{echo "Closed";} ?></span>
											</li>
										</ul>
									</div>

									<div class="all_time_section pull-left " style="<?php if(is_open($deliveryTime, 'monday')==0){ echo "display: none;";}?>">
										<?php
										$times = get_times($deliveryTime, 'monday');
										$count = 1;
										foreach($times as $time){
											if($count==1){ ?>
												<div class="static_time_section pull-left dynamic_multi_section">
													<ul class="time-range time-list pull-left no-padding">
														<li>
															<select id="mon" class="form-control openCloseHour" name="mon_start_time[]">
																<option value="24 hours" <?php if($time->start_time=='24 hours'){echo "selected";}?>>24 hours</option>
																<option value="12:00 am" <?php if($time->start_time=='12:00 am'){echo "selected=''";}?>>12:00 am</option>
																<option value="12:30 am" <?php if($time->start_time=='12:30 am'){echo "selected=''";}?>>12:30 am</option>
																<option value="1:00 am" <?php if($time->start_time=='1:00 am'){echo "selected=''";}?>>1:00 am</option>
																<option value="1:30 am" <?php if($time->start_time=='1:30 am'){echo "selected=''";}?>>1:30 am</option>
																<option value="2:00 am" <?php if($time->start_time=='2:00 am'){echo "selected=''";}?>>2:00 am</option>
																<option value="2:30 am" <?php if($time->start_time=='2:30 am'){echo "selected=''";}?>>2:30 am</option>
																<option value="3:00 am" <?php if($time->start_time=='3:00 am'){echo "selected=''";}?>>3:00 am</option>
																<option value="3:30 am" <?php if($time->start_time=='3:30 am'){echo "selected=''";}?>>3:30 am</option>
																<option value="4:00 am" <?php if($time->start_time=='4:00 am'){echo "selected=''";}?>>4:00 am</option>
																<option value="4:30 am" <?php if($time->start_time=='4:30 am'){echo "selected=''";}?>>4:30 am</option>
																<option value="5:00 am" <?php if($time->start_time=='5:00 am'){echo "selected=''";}?>>5:00 am</option>
																<option value="5:30 am" <?php if($time->start_time=='5:30 am'){echo "selected=''";}?>>5:30 am</option>
																<option value="6:00 am" <?php if($time->start_time=='6:00 am'){echo "selected=''";}?>>6:00 am</option>
																<option value="6:30 am" <?php if($time->start_time=='6:30 am'){echo "selected=''";}?>>6:30 am</option>
																<option value="7:00 am" <?php if($time->start_time=='7:00 am'){echo "selected=''";}?>>7:00 am</option>
																<option value="7:30 am" <?php if($time->start_time=='7:30 am'){echo "selected=''";}?>>7:30 am</option>
																<option value="8:00 am" <?php if($time->start_time=='8:00 am'){echo "selected=''";}?>>8:00 am</option>
																<option value="8:30 am" <?php if($time->start_time=='8:30 am'){echo "selected=''";}?>>8:30 am</option>
																<option value="9:00 am" <?php if($time->start_time=='9:00 am'){echo "selected=''";}?>>9:00 am</option>
																<option value="9:30 am" <?php if($time->start_time=='9:30 am'){echo "selected=''";}?>>9:30 am</option>
																<option value="10:00 am" <?php if($time->start_time=='10:00 am'){echo "selected=''";}?>>10:00 am</option>
																<option value="10:30 am" <?php if($time->start_time=='10:30 am'){echo "selected=''";}?>>10:30 am</option>
																<option value="11:00 am" <?php if($time->start_time=='11:00 am'){echo "selected=''";}?>>11:00 am</option>
																<option value="11:30 am" <?php if($time->start_time=='11:30 am'){echo "selected=''";}?>>11:30 am</option>
																<option value="12:00 pm" <?php if($time->start_time=='12:00 pm'){echo "selected=''";}?>>12:00 pm</option>
																<option value="12:30 pm <?php if($time->start_time=='12:30 pm'){echo "selected=''";}?>">12:30 pm</option>
																<option value="1:00 pm" <?php if($time->start_time=='1:00 pm'){echo "selected=''";}?>>1:00 pm</option>
																<option value="1:30 pm" <?php if($time->start_time=='1:30 pm'){echo "selected=''";}?>>1:30 pm</option>
																<option value="2:00 pm" <?php if($time->start_time=='2:00 pm'){echo "selected=''";}?>>2:00 pm</option>
																<option value="2:30 pm" <?php if($time->start_time=='2:30 pm'){echo "selected=''";}?>>2:30 pm</option>
																<option value="3:00 pm" <?php if($time->start_time=='3:00 pm'){echo "selected=''";}?>>3:00 pm</option>
																<option value="3:30 pm" <?php if($time->start_time=='3:30 pm'){echo "selected=''";}?>>3:30 pm</option>
																<option value="4:00 pm" <?php if($time->start_time=='4:00 pm'){echo "selected=''";}?>>4:00 pm</option>
																<option value="4:30 pm" <?php if($time->start_time=='4:30 pm'){echo "selected=''";}?>>4:30 pm</option>
																<option value="5:00 pm" <?php if($time->start_time=='5:00 pm'){echo "selected=''";}?>>5:00 pm</option>
																<option value="5:30 pm" <?php if($time->start_time=='5:30 pm'){echo "selected=''";}?>>5:30 pm</option>
																<option value="6:00 pm" <?php if($time->start_time=='6:00 pm'){echo "selected=''";}?>>6:00 pm</option>
																<option value="6:30 pm" <?php if($time->start_time=='6:30 pm'){echo "selected=''";}?>>6:30 pm</option>
																<option value="7:00 pm" <?php if($time->start_time=='7:00 pm'){echo "selected=''";}?>>7:00 pm</option>
																<option value="7:30 pm" <?php if($time->start_time=='7:30 pm'){echo "selected=''";}?>>7:30 pm</option>
																<option value="8:00 pm" <?php if($time->start_time=='8:00 pm'){echo "selected=''";}?>>8:00 pm</option>
																<option value="8:30 pm" <?php if($time->start_time=='8:30 pm'){echo "selected=''";}?>>8:30 pm</option>
																<option value="9:00 pm" <?php if($time->start_time=='9:00 pm'){echo "selected=''";}?>>9:00 pm</option>
																<option value="9:30 pm" <?php if($time->start_time=='9:30 pm'){echo "selected=''";}?>>9:30 pm</option>
																<option value="10:00 pm" <?php if($time->start_time=='10:00 pm'){echo "selected=''";}?>>10:00 pm</option>
																<option value="10:30 pm" <?php if($time->start_time=='10:30 pm'){echo "selected=''";}?>>10:30 pm</option>
																<option value="11:00 pm" <?php if($time->start_time=='11:00 pm'){echo "selected=''";}?>>11:00 pm</option>
																<option value="11:30 pm" <?php if($time->start_time=='11:30 pm'){echo "selected=''";}?>>11:30 pm</option>
															</select>
														</li>

														<li style="width:20px;">
															<span>-</span>
														</li>

														<li>
															<select id="mon_close" class="form-control openCloseHour" name="mon_end_time[]">
																<option value="12:00 am" <?php if($time->end_time=='12:00 am'){echo "selected=''";}?>>12:00 am</option>
																<option value="12:30 am" <?php if($time->end_time=='12:30 am'){echo "selected=''";}?>>12:30 am</option>
																<option value="1:00 am" <?php if($time->end_time=='1:00 am'){echo "selected=''";}?>>1:00 am</option>
																<option value="1:30 am" <?php if($time->end_time=='1:30 am'){echo "selected=''";}?>>1:30 am</option>
																<option value="2:00 am" <?php if($time->end_time=='2:00 am'){echo "selected=''";}?>>2:00 am</option>
																<option value="2:30 am" <?php if($time->end_time=='2:30 am'){echo "selected=''";}?>>2:30 am</option>
																<option value="3:00 am" <?php if($time->end_time=='3:00 am'){echo "selected=''";}?>>3:00 am</option>
																<option value="3:30 am" <?php if($time->end_time=='3:30 am'){echo "selected=''";}?>>3:30 am</option>
																<option value="4:00 am" <?php if($time->end_time=='4:00 am'){echo "selected=''";}?>>4:00 am</option>
																<option value="4:30 am" <?php if($time->end_time=='4:30 am'){echo "selected=''";}?>>4:30 am</option>
																<option value="5:00 am" <?php if($time->end_time=='5:00 am'){echo "selected=''";}?>>5:00 am</option>
																<option value="5:30 am" <?php if($time->end_time=='5:30 am'){echo "selected=''";}?>>5:30 am</option>
																<option value="6:00 am" <?php if($time->end_time=='6:00 am'){echo "selected=''";}?>>6:00 am</option>
																<option value="6:30 am" <?php if($time->end_time=='6:30 am'){echo "selected=''";}?>>6:30 am</option>
																<option value="7:00 am" <?php if($time->end_time=='7:00 am'){echo "selected=''";}?>>7:00 am</option>
																<option value="7:30 am" <?php if($time->end_time=='7:30 am'){echo "selected=''";}?>>7:30 am</option>
																<option value="8:00 am" <?php if($time->end_time=='8:00 am'){echo "selected=''";}?>>8:00 am</option>
																<option value="8:30 am" <?php if($time->end_time=='8:30 am'){echo "selected=''";}?>>8:30 am</option>
																<option value="9:00 am" <?php if($time->end_time=='9:00 am'){echo "selected=''";}?>>9:00 am</option>
																<option value="9:30 am" <?php if($time->end_time=='9:30 am'){echo "selected=''";}?>>9:30 am</option>
																<option value="10:00 am" <?php if($time->end_time=='10:00 am'){echo "selected=''";}?>>10:00 am</option>
																<option value="10:30 am" <?php if($time->end_time=='10:30 am'){echo "selected=''";}?>>10:30 am</option>
																<option value="11:00 am" <?php if($time->end_time=='11:00 am'){echo "selected=''";}?>>11:00 am</option>
																<option value="11:30 am" <?php if($time->end_time=='11:30 am'){echo "selected=''";}?>>11:30 am</option>
																<option value="12:00 pm" <?php if($time->end_time=='12:00 pm'){echo "selected=''";}?>>12:00 pm</option>
																<option value="12:30 pm <?php if($time->end_time=='12:30 pm'){echo "selected=''";}?>">12:30 pm</option>
																<option value="1:00 pm" <?php if($time->end_time=='1:00 pm'){echo "selected=''";}?>>1:00 pm</option>
																<option value="1:30 pm" <?php if($time->end_time=='1:30 pm'){echo "selected=''";}?>>1:30 pm</option>
																<option value="2:00 pm" <?php if($time->end_time=='2:00 pm'){echo "selected=''";}?>>2:00 pm</option>
																<option value="2:30 pm" <?php if($time->end_time=='2:30 pm'){echo "selected=''";}?>>2:30 pm</option>
																<option value="3:00 pm" <?php if($time->end_time=='3:00 pm'){echo "selected=''";}?>>3:00 pm</option>
																<option value="3:30 pm" <?php if($time->end_time=='3:30 pm'){echo "selected=''";}?>>3:30 pm</option>
																<option value="4:00 pm" <?php if($time->end_time=='4:00 pm'){echo "selected=''";}?>>4:00 pm</option>
																<option value="4:30 pm" <?php if($time->end_time=='4:30 pm'){echo "selected=''";}?>>4:30 pm</option>
																<option value="5:00 pm" <?php if($time->end_time=='5:00 pm'){echo "selected=''";}?>>5:00 pm</option>
																<option value="5:30 pm" <?php if($time->end_time=='5:30 pm'){echo "selected=''";}?>>5:30 pm</option>
																<option value="6:00 pm" <?php if($time->end_time=='6:00 pm'){echo "selected=''";}?>>6:00 pm</option>
																<option value="6:30 pm" <?php if($time->end_time=='6:30 pm'){echo "selected=''";}?>>6:30 pm</option>
																<option value="7:00 pm" <?php if($time->end_time=='7:00 pm'){echo "selected=''";}?>>7:00 pm</option>
																<option value="7:30 pm" <?php if($time->end_time=='7:30 pm'){echo "selected=''";}?>>7:30 pm</option>
																<option value="8:00 pm" <?php if($time->end_time=='8:00 pm'){echo "selected=''";}?>>8:00 pm</option>
																<option value="8:30 pm" <?php if($time->end_time=='8:30 pm'){echo "selected=''";}?>>8:30 pm</option>
																<option value="9:00 pm" <?php if($time->end_time=='9:00 pm'){echo "selected=''";}?>>9:00 pm</option>
																<option value="9:30 pm" <?php if($time->end_time=='9:30 pm'){echo "selected=''";}?>>9:30 pm</option>
																<option value="10:00 pm" <?php if($time->end_time=='10:00 pm'){echo "selected=''";}?>>10:00 pm</option>
																<option value="10:30 pm" <?php if($time->end_time=='10:30 pm'){echo "selected=''";}?>>10:30 pm</option>
																<option value="11:00 pm" <?php if($time->end_time=='11:00 pm'){echo "selected=''";}?>>11:00 pm</option>
																<option value="11:30 pm" <?php if($time->end_time=='11:30 pm'){echo "selected=''";}?>>11:30 pm</option>
															</select>
														</li>
													</ul>

													<div class="pull-left">
												<span class="pull-left">
		                                            <a class="btn btn-primary dynamic_time_add" href="javascript:;">
		                                                <i class="fa fa-plus-circle" aria-hidden="true"></i>
		                                            </a>
		                                        </span>

														<span class="pull-left margin-left-10">
		                                            <a class="btn btn-danger" href="javascript:;" disabled="">
		                                                <i class="fa fa-minus-circle" aria-hidden="true"></i>
		                                            </a>
		                                        </span>
													</div>
												</div>
											<?php }
											else{ ?>
												<div class="dynamic_time_section_area">
													<div class="dynamic_multi_time dynamic_multi_section">
														<ul class="time-range time-list pull-left no-padding">
															<li>
																<select id="mon" class="form-control openCloseHour" name="mon_start_time[]">
																	<option value="24 hours" <?php if($time->start_time=='24 hours'){echo "selected";}?>>24 hours</option>
																	<option value="12:00 am" <?php if($time->start_time=='12:00 am'){echo "selected=''";}?>>12:00 am</option>
																	<option value="12:30 am" <?php if($time->start_time=='12:30 am'){echo "selected=''";}?>>12:30 am</option>
																	<option value="1:00 am" <?php if($time->start_time=='1:00 am'){echo "selected=''";}?>>1:00 am</option>
																	<option value="1:30 am" <?php if($time->start_time=='1:30 am'){echo "selected=''";}?>>1:30 am</option>
																	<option value="2:00 am" <?php if($time->start_time=='2:00 am'){echo "selected=''";}?>>2:00 am</option>
																	<option value="2:30 am" <?php if($time->start_time=='2:30 am'){echo "selected=''";}?>>2:30 am</option>
																	<option value="3:00 am" <?php if($time->start_time=='3:00 am'){echo "selected=''";}?>>3:00 am</option>
																	<option value="3:30 am" <?php if($time->start_time=='3:30 am'){echo "selected=''";}?>>3:30 am</option>
																	<option value="4:00 am" <?php if($time->start_time=='4:00 am'){echo "selected=''";}?>>4:00 am</option>
																	<option value="4:30 am" <?php if($time->start_time=='4:30 am'){echo "selected=''";}?>>4:30 am</option>
																	<option value="5:00 am" <?php if($time->start_time=='5:00 am'){echo "selected=''";}?>>5:00 am</option>
																	<option value="5:30 am" <?php if($time->start_time=='5:30 am'){echo "selected=''";}?>>5:30 am</option>
																	<option value="6:00 am" <?php if($time->start_time=='6:00 am'){echo "selected=''";}?>>6:00 am</option>
																	<option value="6:30 am" <?php if($time->start_time=='6:30 am'){echo "selected=''";}?>>6:30 am</option>
																	<option value="7:00 am" <?php if($time->start_time=='7:00 am'){echo "selected=''";}?>>7:00 am</option>
																	<option value="7:30 am" <?php if($time->start_time=='7:30 am'){echo "selected=''";}?>>7:30 am</option>
																	<option value="8:00 am" <?php if($time->start_time=='8:00 am'){echo "selected=''";}?>>8:00 am</option>
																	<option value="8:30 am" <?php if($time->start_time=='8:30 am'){echo "selected=''";}?>>8:30 am</option>
																	<option value="9:00 am" <?php if($time->start_time=='9:00 am'){echo "selected=''";}?>>9:00 am</option>
																	<option value="9:30 am" <?php if($time->start_time=='9:30 am'){echo "selected=''";}?>>9:30 am</option>
																	<option value="10:00 am" <?php if($time->start_time=='10:00 am'){echo "selected=''";}?>>10:00 am</option>
																	<option value="10:30 am" <?php if($time->start_time=='10:30 am'){echo "selected=''";}?>>10:30 am</option>
																	<option value="11:00 am" <?php if($time->start_time=='11:00 am'){echo "selected=''";}?>>11:00 am</option>
																	<option value="11:30 am" <?php if($time->start_time=='11:30 am'){echo "selected=''";}?>>11:30 am</option>
																	<option value="12:00 pm" <?php if($time->start_time=='12:00 pm'){echo "selected=''";}?>>12:00 pm</option>
																	<option value="12:30 pm <?php if($time->start_time=='12:30 pm'){echo "selected=''";}?>">12:30 pm</option>
																	<option value="1:00 pm" <?php if($time->start_time=='1:00 pm'){echo "selected=''";}?>>1:00 pm</option>
																	<option value="1:30 pm" <?php if($time->start_time=='1:30 pm'){echo "selected=''";}?>>1:30 pm</option>
																	<option value="2:00 pm" <?php if($time->start_time=='2:00 pm'){echo "selected=''";}?>>2:00 pm</option>
																	<option value="2:30 pm" <?php if($time->start_time=='2:30 pm'){echo "selected=''";}?>>2:30 pm</option>
																	<option value="3:00 pm" <?php if($time->start_time=='3:00 pm'){echo "selected=''";}?>>3:00 pm</option>
																	<option value="3:30 pm" <?php if($time->start_time=='3:30 pm'){echo "selected=''";}?>>3:30 pm</option>
																	<option value="4:00 pm" <?php if($time->start_time=='4:00 pm'){echo "selected=''";}?>>4:00 pm</option>
																	<option value="4:30 pm" <?php if($time->start_time=='4:30 pm'){echo "selected=''";}?>>4:30 pm</option>
																	<option value="5:00 pm" <?php if($time->start_time=='5:00 pm'){echo "selected=''";}?>>5:00 pm</option>
																	<option value="5:30 pm" <?php if($time->start_time=='5:30 pm'){echo "selected=''";}?>>5:30 pm</option>
																	<option value="6:00 pm" <?php if($time->start_time=='6:00 pm'){echo "selected=''";}?>>6:00 pm</option>
																	<option value="6:30 pm" <?php if($time->start_time=='6:30 pm'){echo "selected=''";}?>>6:30 pm</option>
																	<option value="7:00 pm" <?php if($time->start_time=='7:00 pm'){echo "selected=''";}?>>7:00 pm</option>
																	<option value="7:30 pm" <?php if($time->start_time=='7:30 pm'){echo "selected=''";}?>>7:30 pm</option>
																	<option value="8:00 pm" <?php if($time->start_time=='8:00 pm'){echo "selected=''";}?>>8:00 pm</option>
																	<option value="8:30 pm" <?php if($time->start_time=='8:30 pm'){echo "selected=''";}?>>8:30 pm</option>
																	<option value="9:00 pm" <?php if($time->start_time=='9:00 pm'){echo "selected=''";}?>>9:00 pm</option>
																	<option value="9:30 pm" <?php if($time->start_time=='9:30 pm'){echo "selected=''";}?>>9:30 pm</option>
																	<option value="10:00 pm" <?php if($time->start_time=='10:00 pm'){echo "selected=''";}?>>10:00 pm</option>
																	<option value="10:30 pm" <?php if($time->start_time=='10:30 pm'){echo "selected=''";}?>>10:30 pm</option>
																	<option value="11:00 pm" <?php if($time->start_time=='11:00 pm'){echo "selected=''";}?>>11:00 pm</option>
																	<option value="11:30 pm" <?php if($time->start_time=='11:30 pm'){echo "selected=''";}?>>11:30 pm</option>
																</select>
															</li>

															<li style="width:20px;">
																<span>-</span>
															</li>

															<li>
																<select id="mon_close" class="form-control openCloseHour" name="mon_end_time[]">
																	<option value="12:00 am" <?php if($time->end_time=='12:00 am'){echo "selected=''";}?>>12:00 am</option>
																	<option value="12:30 am" <?php if($time->end_time=='12:30 am'){echo "selected=''";}?>>12:30 am</option>
																	<option value="1:00 am" <?php if($time->end_time=='1:00 am'){echo "selected=''";}?>>1:00 am</option>
																	<option value="1:30 am" <?php if($time->end_time=='1:30 am'){echo "selected=''";}?>>1:30 am</option>
																	<option value="2:00 am" <?php if($time->end_time=='2:00 am'){echo "selected=''";}?>>2:00 am</option>
																	<option value="2:30 am" <?php if($time->end_time=='2:30 am'){echo "selected=''";}?>>2:30 am</option>
																	<option value="3:00 am" <?php if($time->end_time=='3:00 am'){echo "selected=''";}?>>3:00 am</option>
																	<option value="3:30 am" <?php if($time->end_time=='3:30 am'){echo "selected=''";}?>>3:30 am</option>
																	<option value="4:00 am" <?php if($time->end_time=='4:00 am'){echo "selected=''";}?>>4:00 am</option>
																	<option value="4:30 am" <?php if($time->end_time=='4:30 am'){echo "selected=''";}?>>4:30 am</option>
																	<option value="5:00 am" <?php if($time->end_time=='5:00 am'){echo "selected=''";}?>>5:00 am</option>
																	<option value="5:30 am" <?php if($time->end_time=='5:30 am'){echo "selected=''";}?>>5:30 am</option>
																	<option value="6:00 am" <?php if($time->end_time=='6:00 am'){echo "selected=''";}?>>6:00 am</option>
																	<option value="6:30 am" <?php if($time->end_time=='6:30 am'){echo "selected=''";}?>>6:30 am</option>
																	<option value="7:00 am" <?php if($time->end_time=='7:00 am'){echo "selected=''";}?>>7:00 am</option>
																	<option value="7:30 am" <?php if($time->end_time=='7:30 am'){echo "selected=''";}?>>7:30 am</option>
																	<option value="8:00 am" <?php if($time->end_time=='8:00 am'){echo "selected=''";}?>>8:00 am</option>
																	<option value="8:30 am" <?php if($time->end_time=='8:30 am'){echo "selected=''";}?>>8:30 am</option>
																	<option value="9:00 am" <?php if($time->end_time=='9:00 am'){echo "selected=''";}?>>9:00 am</option>
																	<option value="9:30 am" <?php if($time->end_time=='9:30 am'){echo "selected=''";}?>>9:30 am</option>
																	<option value="10:00 am" <?php if($time->end_time=='10:00 am'){echo "selected=''";}?>>10:00 am</option>
																	<option value="10:30 am" <?php if($time->end_time=='10:30 am'){echo "selected=''";}?>>10:30 am</option>
																	<option value="11:00 am" <?php if($time->end_time=='11:00 am'){echo "selected=''";}?>>11:00 am</option>
																	<option value="11:30 am" <?php if($time->end_time=='11:30 am'){echo "selected=''";}?>>11:30 am</option>
																	<option value="12:00 pm" <?php if($time->end_time=='12:00 pm'){echo "selected=''";}?>>12:00 pm</option>
																	<option value="12:30 pm <?php if($time->end_time=='12:30 pm'){echo "selected=''";}?>">12:30 pm</option>
																	<option value="1:00 pm" <?php if($time->end_time=='1:00 pm'){echo "selected=''";}?>>1:00 pm</option>
																	<option value="1:30 pm" <?php if($time->end_time=='1:30 pm'){echo "selected=''";}?>>1:30 pm</option>
																	<option value="2:00 pm" <?php if($time->end_time=='2:00 pm'){echo "selected=''";}?>>2:00 pm</option>
																	<option value="2:30 pm" <?php if($time->end_time=='2:30 pm'){echo "selected=''";}?>>2:30 pm</option>
																	<option value="3:00 pm" <?php if($time->end_time=='3:00 pm'){echo "selected=''";}?>>3:00 pm</option>
																	<option value="3:30 pm" <?php if($time->end_time=='3:30 pm'){echo "selected=''";}?>>3:30 pm</option>
																	<option value="4:00 pm" <?php if($time->end_time=='4:00 pm'){echo "selected=''";}?>>4:00 pm</option>
																	<option value="4:30 pm" <?php if($time->end_time=='4:30 pm'){echo "selected=''";}?>>4:30 pm</option>
																	<option value="5:00 pm" <?php if($time->end_time=='5:00 pm'){echo "selected=''";}?>>5:00 pm</option>
																	<option value="5:30 pm" <?php if($time->end_time=='5:30 pm'){echo "selected=''";}?>>5:30 pm</option>
																	<option value="6:00 pm" <?php if($time->end_time=='6:00 pm'){echo "selected=''";}?>>6:00 pm</option>
																	<option value="6:30 pm" <?php if($time->end_time=='6:30 pm'){echo "selected=''";}?>>6:30 pm</option>
																	<option value="7:00 pm" <?php if($time->end_time=='7:00 pm'){echo "selected=''";}?>>7:00 pm</option>
																	<option value="7:30 pm" <?php if($time->end_time=='7:30 pm'){echo "selected=''";}?>>7:30 pm</option>
																	<option value="8:00 pm" <?php if($time->end_time=='8:00 pm'){echo "selected=''";}?>>8:00 pm</option>
																	<option value="8:30 pm" <?php if($time->end_time=='8:30 pm'){echo "selected=''";}?>>8:30 pm</option>
																	<option value="9:00 pm" <?php if($time->end_time=='9:00 pm'){echo "selected=''";}?>>9:00 pm</option>
																	<option value="9:30 pm" <?php if($time->end_time=='9:30 pm'){echo "selected=''";}?>>9:30 pm</option>
																	<option value="10:00 pm" <?php if($time->end_time=='10:00 pm'){echo "selected=''";}?>>10:00 pm</option>
																	<option value="10:30 pm" <?php if($time->end_time=='10:30 pm'){echo "selected=''";}?>>10:30 pm</option>
																	<option value="11:00 pm" <?php if($time->end_time=='11:00 pm'){echo "selected=''";}?>>11:00 pm</option>
																	<option value="11:30 pm" <?php if($time->end_time=='11:30 pm'){echo "selected=''";}?>>11:30 pm</option>
																</select>
															</li>
														</ul>

														<div class="pull-left">
											<span class="pull-left">
	                                            <a class="btn btn-primary dynamic_time_add" href="javascript:;">
	                                                <i class="fa fa-plus-circle" aria-hidden="true"></i>
	                                            </a>
	                                        </span>

															<span class="pull-left margin-left-10">
	                                            <a class="btn btn-danger dynamic_time_delete" href="javascript:;">
	                                                <i class="fa fa-minus-circle" aria-hidden="true"></i>
	                                            </a>
	                                        </span>
														</div>
													</div>
												</div>
											<?php }		//end else
											$count++;
										} //end foreach
										?>

										<?php if(count($times)==1){?>
											<div class="dynamic_time_section_area"></div>
										<?php } ?>
									</div>
								</div>

								<div class="day_item" data-name="tue">
									<div class="pull-left">
										<ul class="time-list">
											<li>
												<b>Tuesday</b>
											</li>

											<li class="switch-li">
												<span class="pull-left">
													<div class="material-switch">
														<input class="swicth-check" id="Tuesday" name="switch[]" type="checkbox"  <?php if(is_open($deliveryTime, 'tuesday')==1){echo "checked";} ?>/>
														<label for="Tuesday" class="label-default"></label>
													</div>
														<input id="Tuesday_switch" name="switch_check[]" type="hidden" value="<?php echo is_open($deliveryTime, 'tuesday')?>"/>
														<input id="" name="day_name[]" type="hidden" value="tuesday"/>
												</span>
												<span class="margin-left-10 open-status"><?php if(is_open($deliveryTime, 'tuesday')==1){echo "Open";} else{echo "Closed";} ?></span>
											</li>
										</ul>
									</div>

									<div class="all_time_section pull-left " style="<?php if(is_open($deliveryTime, 'tuesday')==0){ echo "display: none;";}?>">
										<?php
										$times = get_times($deliveryTime, 'tuesday');
										$count = 1;
										foreach($times as $time){
											if($count==1){ ?>
												<div class="static_time_section pull-left dynamic_multi_section">
													<ul class="time-range time-list pull-left no-padding">

														<li>
															<select id="tues" class="form-control openCloseHour" name="tue_start_time[]">
																<option value="24 hours" <?php if($time->start_time=='24 hours'){echo "selected";}?>>24 hours</option>
																<option value="12:00 am" <?php if($time->start_time=='12:00 am'){echo "selected=''";}?>>12:00 am</option>
																<option value="12:30 am" <?php if($time->start_time=='12:30 am'){echo "selected=''";}?>>12:30 am</option>
																<option value="1:00 am" <?php if($time->start_time=='1:00 am'){echo "selected=''";}?>>1:00 am</option>
																<option value="1:30 am" <?php if($time->start_time=='1:30 am'){echo "selected=''";}?>>1:30 am</option>
																<option value="2:00 am" <?php if($time->start_time=='2:00 am'){echo "selected=''";}?>>2:00 am</option>
																<option value="2:30 am" <?php if($time->start_time=='2:30 am'){echo "selected=''";}?>>2:30 am</option>
																<option value="3:00 am" <?php if($time->start_time=='3:00 am'){echo "selected=''";}?>>3:00 am</option>
																<option value="3:30 am" <?php if($time->start_time=='3:30 am'){echo "selected=''";}?>>3:30 am</option>
																<option value="4:00 am" <?php if($time->start_time=='4:00 am'){echo "selected=''";}?>>4:00 am</option>
																<option value="4:30 am" <?php if($time->start_time=='4:30 am'){echo "selected=''";}?>>4:30 am</option>
																<option value="5:00 am" <?php if($time->start_time=='5:00 am'){echo "selected=''";}?>>5:00 am</option>
																<option value="5:30 am" <?php if($time->start_time=='5:30 am'){echo "selected=''";}?>>5:30 am</option>
																<option value="6:00 am" <?php if($time->start_time=='6:00 am'){echo "selected=''";}?>>6:00 am</option>
																<option value="6:30 am" <?php if($time->start_time=='6:30 am'){echo "selected=''";}?>>6:30 am</option>
																<option value="7:00 am" <?php if($time->start_time=='7:00 am'){echo "selected=''";}?>>7:00 am</option>
																<option value="7:30 am" <?php if($time->start_time=='7:30 am'){echo "selected=''";}?>>7:30 am</option>
																<option value="8:00 am" <?php if($time->start_time=='8:00 am'){echo "selected=''";}?>>8:00 am</option>
																<option value="8:30 am" <?php if($time->start_time=='8:30 am'){echo "selected=''";}?>>8:30 am</option>
																<option value="9:00 am" <?php if($time->start_time=='9:00 am'){echo "selected=''";}?>>9:00 am</option>
																<option value="9:30 am" <?php if($time->start_time=='9:30 am'){echo "selected=''";}?>>9:30 am</option>
																<option value="10:00 am" <?php if($time->start_time=='10:00 am'){echo "selected=''";}?>>10:00 am</option>
																<option value="10:30 am" <?php if($time->start_time=='10:30 am'){echo "selected=''";}?>>10:30 am</option>
																<option value="11:00 am" <?php if($time->start_time=='11:00 am'){echo "selected=''";}?>>11:00 am</option>
																<option value="11:30 am" <?php if($time->start_time=='11:30 am'){echo "selected=''";}?>>11:30 am</option>
																<option value="12:00 pm" <?php if($time->start_time=='12:00 pm'){echo "selected=''";}?>>12:00 pm</option>
																<option value="12:30 pm <?php if($time->start_time=='12:30 pm'){echo "selected=''";}?>">12:30 pm</option>
																<option value="1:00 pm" <?php if($time->start_time=='1:00 pm'){echo "selected=''";}?>>1:00 pm</option>
																<option value="1:30 pm" <?php if($time->start_time=='1:30 pm'){echo "selected=''";}?>>1:30 pm</option>
																<option value="2:00 pm" <?php if($time->start_time=='2:00 pm'){echo "selected=''";}?>>2:00 pm</option>
																<option value="2:30 pm" <?php if($time->start_time=='2:30 pm'){echo "selected=''";}?>>2:30 pm</option>
																<option value="3:00 pm" <?php if($time->start_time=='3:00 pm'){echo "selected=''";}?>>3:00 pm</option>
																<option value="3:30 pm" <?php if($time->start_time=='3:30 pm'){echo "selected=''";}?>>3:30 pm</option>
																<option value="4:00 pm" <?php if($time->start_time=='4:00 pm'){echo "selected=''";}?>>4:00 pm</option>
																<option value="4:30 pm" <?php if($time->start_time=='4:30 pm'){echo "selected=''";}?>>4:30 pm</option>
																<option value="5:00 pm" <?php if($time->start_time=='5:00 pm'){echo "selected=''";}?>>5:00 pm</option>
																<option value="5:30 pm" <?php if($time->start_time=='5:30 pm'){echo "selected=''";}?>>5:30 pm</option>
																<option value="6:00 pm" <?php if($time->start_time=='6:00 pm'){echo "selected=''";}?>>6:00 pm</option>
																<option value="6:30 pm" <?php if($time->start_time=='6:30 pm'){echo "selected=''";}?>>6:30 pm</option>
																<option value="7:00 pm" <?php if($time->start_time=='7:00 pm'){echo "selected=''";}?>>7:00 pm</option>
																<option value="7:30 pm" <?php if($time->start_time=='7:30 pm'){echo "selected=''";}?>>7:30 pm</option>
																<option value="8:00 pm" <?php if($time->start_time=='8:00 pm'){echo "selected=''";}?>>8:00 pm</option>
																<option value="8:30 pm" <?php if($time->start_time=='8:30 pm'){echo "selected=''";}?>>8:30 pm</option>
																<option value="9:00 pm" <?php if($time->start_time=='9:00 pm'){echo "selected=''";}?>>9:00 pm</option>
																<option value="9:30 pm" <?php if($time->start_time=='9:30 pm'){echo "selected=''";}?>>9:30 pm</option>
																<option value="10:00 pm" <?php if($time->start_time=='10:00 pm'){echo "selected=''";}?>>10:00 pm</option>
																<option value="10:30 pm" <?php if($time->start_time=='10:30 pm'){echo "selected=''";}?>>10:30 pm</option>
																<option value="11:00 pm" <?php if($time->start_time=='11:00 pm'){echo "selected=''";}?>>11:00 pm</option>
																<option value="11:30 pm" <?php if($time->start_time=='11:30 pm'){echo "selected=''";}?>>11:30 pm</option>
															</select>
														</li>

														<li style="width:20px;">
															<span>-</span>
														</li>

														<li>
															<select id="tues_close" class="form-control openCloseHour" name="tue_end_time[]">
																<option value="12:00 am" <?php if($time->end_time=='12:00 am'){echo "selected=''";}?>>12:00 am</option>
																<option value="12:30 am" <?php if($time->end_time=='12:30 am'){echo "selected=''";}?>>12:30 am</option>
																<option value="1:00 am" <?php if($time->end_time=='1:00 am'){echo "selected=''";}?>>1:00 am</option>
																<option value="1:30 am" <?php if($time->end_time=='1:30 am'){echo "selected=''";}?>>1:30 am</option>
																<option value="2:00 am" <?php if($time->end_time=='2:00 am'){echo "selected=''";}?>>2:00 am</option>
																<option value="2:30 am" <?php if($time->end_time=='2:30 am'){echo "selected=''";}?>>2:30 am</option>
																<option value="3:00 am" <?php if($time->end_time=='3:00 am'){echo "selected=''";}?>>3:00 am</option>
																<option value="3:30 am" <?php if($time->end_time=='3:30 am'){echo "selected=''";}?>>3:30 am</option>
																<option value="4:00 am" <?php if($time->end_time=='4:00 am'){echo "selected=''";}?>>4:00 am</option>
																<option value="4:30 am" <?php if($time->end_time=='4:30 am'){echo "selected=''";}?>>4:30 am</option>
																<option value="5:00 am" <?php if($time->end_time=='5:00 am'){echo "selected=''";}?>>5:00 am</option>
																<option value="5:30 am" <?php if($time->end_time=='5:30 am'){echo "selected=''";}?>>5:30 am</option>
																<option value="6:00 am" <?php if($time->end_time=='6:00 am'){echo "selected=''";}?>>6:00 am</option>
																<option value="6:30 am" <?php if($time->end_time=='6:30 am'){echo "selected=''";}?>>6:30 am</option>
																<option value="7:00 am" <?php if($time->end_time=='7:00 am'){echo "selected=''";}?>>7:00 am</option>
																<option value="7:30 am" <?php if($time->end_time=='7:30 am'){echo "selected=''";}?>>7:30 am</option>
																<option value="8:00 am" <?php if($time->end_time=='8:00 am'){echo "selected=''";}?>>8:00 am</option>
																<option value="8:30 am" <?php if($time->end_time=='8:30 am'){echo "selected=''";}?>>8:30 am</option>
																<option value="9:00 am" <?php if($time->end_time=='9:00 am'){echo "selected=''";}?>>9:00 am</option>
																<option value="9:30 am" <?php if($time->end_time=='9:30 am'){echo "selected=''";}?>>9:30 am</option>
																<option value="10:00 am" <?php if($time->end_time=='10:00 am'){echo "selected=''";}?>>10:00 am</option>
																<option value="10:30 am" <?php if($time->end_time=='10:30 am'){echo "selected=''";}?>>10:30 am</option>
																<option value="11:00 am" <?php if($time->end_time=='11:00 am'){echo "selected=''";}?>>11:00 am</option>
																<option value="11:30 am" <?php if($time->end_time=='11:30 am'){echo "selected=''";}?>>11:30 am</option>
																<option value="12:00 pm" <?php if($time->end_time=='12:00 pm'){echo "selected=''";}?>>12:00 pm</option>
																<option value="12:30 pm <?php if($time->end_time=='12:30 pm'){echo "selected=''";}?>">12:30 pm</option>
																<option value="1:00 pm" <?php if($time->end_time=='1:00 pm'){echo "selected=''";}?>>1:00 pm</option>
																<option value="1:30 pm" <?php if($time->end_time=='1:30 pm'){echo "selected=''";}?>>1:30 pm</option>
																<option value="2:00 pm" <?php if($time->end_time=='2:00 pm'){echo "selected=''";}?>>2:00 pm</option>
																<option value="2:30 pm" <?php if($time->end_time=='2:30 pm'){echo "selected=''";}?>>2:30 pm</option>
																<option value="3:00 pm" <?php if($time->end_time=='3:00 pm'){echo "selected=''";}?>>3:00 pm</option>
																<option value="3:30 pm" <?php if($time->end_time=='3:30 pm'){echo "selected=''";}?>>3:30 pm</option>
																<option value="4:00 pm" <?php if($time->end_time=='4:00 pm'){echo "selected=''";}?>>4:00 pm</option>
																<option value="4:30 pm" <?php if($time->end_time=='4:30 pm'){echo "selected=''";}?>>4:30 pm</option>
																<option value="5:00 pm" <?php if($time->end_time=='5:00 pm'){echo "selected=''";}?>>5:00 pm</option>
																<option value="5:30 pm" <?php if($time->end_time=='5:30 pm'){echo "selected=''";}?>>5:30 pm</option>
																<option value="6:00 pm" <?php if($time->end_time=='6:00 pm'){echo "selected=''";}?>>6:00 pm</option>
																<option value="6:30 pm" <?php if($time->end_time=='6:30 pm'){echo "selected=''";}?>>6:30 pm</option>
																<option value="7:00 pm" <?php if($time->end_time=='7:00 pm'){echo "selected=''";}?>>7:00 pm</option>
																<option value="7:30 pm" <?php if($time->end_time=='7:30 pm'){echo "selected=''";}?>>7:30 pm</option>
																<option value="8:00 pm" <?php if($time->end_time=='8:00 pm'){echo "selected=''";}?>>8:00 pm</option>
																<option value="8:30 pm" <?php if($time->end_time=='8:30 pm'){echo "selected=''";}?>>8:30 pm</option>
																<option value="9:00 pm" <?php if($time->end_time=='9:00 pm'){echo "selected=''";}?>>9:00 pm</option>
																<option value="9:30 pm" <?php if($time->end_time=='9:30 pm'){echo "selected=''";}?>>9:30 pm</option>
																<option value="10:00 pm" <?php if($time->end_time=='10:00 pm'){echo "selected=''";}?>>10:00 pm</option>
																<option value="10:30 pm" <?php if($time->end_time=='10:30 pm'){echo "selected=''";}?>>10:30 pm</option>
																<option value="11:00 pm" <?php if($time->end_time=='11:00 pm'){echo "selected=''";}?>>11:00 pm</option>
																<option value="11:30 pm" <?php if($time->end_time=='11:30 pm'){echo "selected=''";}?>>11:30 pm</option>
															</select>
														</li>
													</ul>

													<div class="pull-left">
												<span class="pull-left">
		                                            <a class="btn btn-primary dynamic_time_add" href="javascript:;">
		                                                <i class="fa fa-plus-circle" aria-hidden="true"></i>
		                                            </a>
		                                        </span>

														<span class="pull-left margin-left-10">
		                                            <a class="btn btn-danger" href="javascript:;" disabled="">
		                                                <i class="fa fa-minus-circle" aria-hidden="true"></i>
		                                            </a>
		                                        </span>
													</div>
												</div>

											<?php }
											else{ ?>
												<div class="dynamic_time_section_area">
													<div class="dynamic_multi_time dynamic_multi_section">
														<ul class="time-range time-list pull-left no-padding">
															<li>

																<select id="tues" class="form-control openCloseHour" name="tue_start_time[]">
																	<option value="24 hours" <?php if($time->start_time=='24 hours'){echo "selected";}?>>24 hours</option>
																	<option value="12:00 am" <?php if($time->start_time=='12:00 am'){echo "selected=''";}?>>12:00 am</option>
																	<option value="12:30 am" <?php if($time->start_time=='12:30 am'){echo "selected=''";}?>>12:30 am</option>
																	<option value="1:00 am" <?php if($time->start_time=='1:00 am'){echo "selected=''";}?>>1:00 am</option>
																	<option value="1:30 am" <?php if($time->start_time=='1:30 am'){echo "selected=''";}?>>1:30 am</option>
																	<option value="2:00 am" <?php if($time->start_time=='2:00 am'){echo "selected=''";}?>>2:00 am</option>
																	<option value="2:30 am" <?php if($time->start_time=='2:30 am'){echo "selected=''";}?>>2:30 am</option>
																	<option value="3:00 am" <?php if($time->start_time=='3:00 am'){echo "selected=''";}?>>3:00 am</option>
																	<option value="3:30 am" <?php if($time->start_time=='3:30 am'){echo "selected=''";}?>>3:30 am</option>
																	<option value="4:00 am" <?php if($time->start_time=='4:00 am'){echo "selected=''";}?>>4:00 am</option>
																	<option value="4:30 am" <?php if($time->start_time=='4:30 am'){echo "selected=''";}?>>4:30 am</option>
																	<option value="5:00 am" <?php if($time->start_time=='5:00 am'){echo "selected=''";}?>>5:00 am</option>
																	<option value="5:30 am" <?php if($time->start_time=='5:30 am'){echo "selected=''";}?>>5:30 am</option>
																	<option value="6:00 am" <?php if($time->start_time=='6:00 am'){echo "selected=''";}?>>6:00 am</option>
																	<option value="6:30 am" <?php if($time->start_time=='6:30 am'){echo "selected=''";}?>>6:30 am</option>
																	<option value="7:00 am" <?php if($time->start_time=='7:00 am'){echo "selected=''";}?>>7:00 am</option>
																	<option value="7:30 am" <?php if($time->start_time=='7:30 am'){echo "selected=''";}?>>7:30 am</option>
																	<option value="8:00 am" <?php if($time->start_time=='8:00 am'){echo "selected=''";}?>>8:00 am</option>
																	<option value="8:30 am" <?php if($time->start_time=='8:30 am'){echo "selected=''";}?>>8:30 am</option>
																	<option value="9:00 am" <?php if($time->start_time=='9:00 am'){echo "selected=''";}?>>9:00 am</option>
																	<option value="9:30 am" <?php if($time->start_time=='9:30 am'){echo "selected=''";}?>>9:30 am</option>
																	<option value="10:00 am" <?php if($time->start_time=='10:00 am'){echo "selected=''";}?>>10:00 am</option>
																	<option value="10:30 am" <?php if($time->start_time=='10:30 am'){echo "selected=''";}?>>10:30 am</option>
																	<option value="11:00 am" <?php if($time->start_time=='11:00 am'){echo "selected=''";}?>>11:00 am</option>
																	<option value="11:30 am" <?php if($time->start_time=='11:30 am'){echo "selected=''";}?>>11:30 am</option>
																	<option value="12:00 pm" <?php if($time->start_time=='12:00 pm'){echo "selected=''";}?>>12:00 pm</option>
																	<option value="12:30 pm <?php if($time->start_time=='12:30 pm'){echo "selected=''";}?>">12:30 pm</option>
																	<option value="1:00 pm" <?php if($time->start_time=='1:00 pm'){echo "selected=''";}?>>1:00 pm</option>
																	<option value="1:30 pm" <?php if($time->start_time=='1:30 pm'){echo "selected=''";}?>>1:30 pm</option>
																	<option value="2:00 pm" <?php if($time->start_time=='2:00 pm'){echo "selected=''";}?>>2:00 pm</option>
																	<option value="2:30 pm" <?php if($time->start_time=='2:30 pm'){echo "selected=''";}?>>2:30 pm</option>
																	<option value="3:00 pm" <?php if($time->start_time=='3:00 pm'){echo "selected=''";}?>>3:00 pm</option>
																	<option value="3:30 pm" <?php if($time->start_time=='3:30 pm'){echo "selected=''";}?>>3:30 pm</option>
																	<option value="4:00 pm" <?php if($time->start_time=='4:00 pm'){echo "selected=''";}?>>4:00 pm</option>
																	<option value="4:30 pm" <?php if($time->start_time=='4:30 pm'){echo "selected=''";}?>>4:30 pm</option>
																	<option value="5:00 pm" <?php if($time->start_time=='5:00 pm'){echo "selected=''";}?>>5:00 pm</option>
																	<option value="5:30 pm" <?php if($time->start_time=='5:30 pm'){echo "selected=''";}?>>5:30 pm</option>
																	<option value="6:00 pm" <?php if($time->start_time=='6:00 pm'){echo "selected=''";}?>>6:00 pm</option>
																	<option value="6:30 pm" <?php if($time->start_time=='6:30 pm'){echo "selected=''";}?>>6:30 pm</option>
																	<option value="7:00 pm" <?php if($time->start_time=='7:00 pm'){echo "selected=''";}?>>7:00 pm</option>
																	<option value="7:30 pm" <?php if($time->start_time=='7:30 pm'){echo "selected=''";}?>>7:30 pm</option>
																	<option value="8:00 pm" <?php if($time->start_time=='8:00 pm'){echo "selected=''";}?>>8:00 pm</option>
																	<option value="8:30 pm" <?php if($time->start_time=='8:30 pm'){echo "selected=''";}?>>8:30 pm</option>
																	<option value="9:00 pm" <?php if($time->start_time=='9:00 pm'){echo "selected=''";}?>>9:00 pm</option>
																	<option value="9:30 pm" <?php if($time->start_time=='9:30 pm'){echo "selected=''";}?>>9:30 pm</option>
																	<option value="10:00 pm" <?php if($time->start_time=='10:00 pm'){echo "selected=''";}?>>10:00 pm</option>
																	<option value="10:30 pm" <?php if($time->start_time=='10:30 pm'){echo "selected=''";}?>>10:30 pm</option>
																	<option value="11:00 pm" <?php if($time->start_time=='11:00 pm'){echo "selected=''";}?>>11:00 pm</option>
																	<option value="11:30 pm" <?php if($time->start_time=='11:30 pm'){echo "selected=''";}?>>11:30 pm</option>
																</select>
															</li>

															<li style="width:20px;">
																<span>-</span>
															</li>

															<li>

																<select id="tues_close" class="form-control openCloseHour" name="tue_end_time[]">
																	<option value="12:00 am" <?php if($time->end_time=='12:00 am'){echo "selected=''";}?>>12:00 am</option>
																	<option value="12:30 am" <?php if($time->end_time=='12:30 am'){echo "selected=''";}?>>12:30 am</option>
																	<option value="1:00 am" <?php if($time->end_time=='1:00 am'){echo "selected=''";}?>>1:00 am</option>
																	<option value="1:30 am" <?php if($time->end_time=='1:30 am'){echo "selected=''";}?>>1:30 am</option>
																	<option value="2:00 am" <?php if($time->end_time=='2:00 am'){echo "selected=''";}?>>2:00 am</option>
																	<option value="2:30 am" <?php if($time->end_time=='2:30 am'){echo "selected=''";}?>>2:30 am</option>
																	<option value="3:00 am" <?php if($time->end_time=='3:00 am'){echo "selected=''";}?>>3:00 am</option>
																	<option value="3:30 am" <?php if($time->end_time=='3:30 am'){echo "selected=''";}?>>3:30 am</option>
																	<option value="4:00 am" <?php if($time->end_time=='4:00 am'){echo "selected=''";}?>>4:00 am</option>
																	<option value="4:30 am" <?php if($time->end_time=='4:30 am'){echo "selected=''";}?>>4:30 am</option>
																	<option value="5:00 am" <?php if($time->end_time=='5:00 am'){echo "selected=''";}?>>5:00 am</option>
																	<option value="5:30 am" <?php if($time->end_time=='5:30 am'){echo "selected=''";}?>>5:30 am</option>
																	<option value="6:00 am" <?php if($time->end_time=='6:00 am'){echo "selected=''";}?>>6:00 am</option>
																	<option value="6:30 am" <?php if($time->end_time=='6:30 am'){echo "selected=''";}?>>6:30 am</option>
																	<option value="7:00 am" <?php if($time->end_time=='7:00 am'){echo "selected=''";}?>>7:00 am</option>
																	<option value="7:30 am" <?php if($time->end_time=='7:30 am'){echo "selected=''";}?>>7:30 am</option>
																	<option value="8:00 am" <?php if($time->end_time=='8:00 am'){echo "selected=''";}?>>8:00 am</option>
																	<option value="8:30 am" <?php if($time->end_time=='8:30 am'){echo "selected=''";}?>>8:30 am</option>
																	<option value="9:00 am" <?php if($time->end_time=='9:00 am'){echo "selected=''";}?>>9:00 am</option>
																	<option value="9:30 am" <?php if($time->end_time=='9:30 am'){echo "selected=''";}?>>9:30 am</option>
																	<option value="10:00 am" <?php if($time->end_time=='10:00 am'){echo "selected=''";}?>>10:00 am</option>
																	<option value="10:30 am" <?php if($time->end_time=='10:30 am'){echo "selected=''";}?>>10:30 am</option>
																	<option value="11:00 am" <?php if($time->end_time=='11:00 am'){echo "selected=''";}?>>11:00 am</option>
																	<option value="11:30 am" <?php if($time->end_time=='11:30 am'){echo "selected=''";}?>>11:30 am</option>
																	<option value="12:00 pm" <?php if($time->end_time=='12:00 pm'){echo "selected=''";}?>>12:00 pm</option>
																	<option value="12:30 pm <?php if($time->end_time=='12:30 pm'){echo "selected=''";}?>">12:30 pm</option>
																	<option value="1:00 pm" <?php if($time->end_time=='1:00 pm'){echo "selected=''";}?>>1:00 pm</option>
																	<option value="1:30 pm" <?php if($time->end_time=='1:30 pm'){echo "selected=''";}?>>1:30 pm</option>
																	<option value="2:00 pm" <?php if($time->end_time=='2:00 pm'){echo "selected=''";}?>>2:00 pm</option>
																	<option value="2:30 pm" <?php if($time->end_time=='2:30 pm'){echo "selected=''";}?>>2:30 pm</option>
																	<option value="3:00 pm" <?php if($time->end_time=='3:00 pm'){echo "selected=''";}?>>3:00 pm</option>
																	<option value="3:30 pm" <?php if($time->end_time=='3:30 pm'){echo "selected=''";}?>>3:30 pm</option>
																	<option value="4:00 pm" <?php if($time->end_time=='4:00 pm'){echo "selected=''";}?>>4:00 pm</option>
																	<option value="4:30 pm" <?php if($time->end_time=='4:30 pm'){echo "selected=''";}?>>4:30 pm</option>
																	<option value="5:00 pm" <?php if($time->end_time=='5:00 pm'){echo "selected=''";}?>>5:00 pm</option>
																	<option value="5:30 pm" <?php if($time->end_time=='5:30 pm'){echo "selected=''";}?>>5:30 pm</option>
																	<option value="6:00 pm" <?php if($time->end_time=='6:00 pm'){echo "selected=''";}?>>6:00 pm</option>
																	<option value="6:30 pm" <?php if($time->end_time=='6:30 pm'){echo "selected=''";}?>>6:30 pm</option>
																	<option value="7:00 pm" <?php if($time->end_time=='7:00 pm'){echo "selected=''";}?>>7:00 pm</option>
																	<option value="7:30 pm" <?php if($time->end_time=='7:30 pm'){echo "selected=''";}?>>7:30 pm</option>
																	<option value="8:00 pm" <?php if($time->end_time=='8:00 pm'){echo "selected=''";}?>>8:00 pm</option>
																	<option value="8:30 pm" <?php if($time->end_time=='8:30 pm'){echo "selected=''";}?>>8:30 pm</option>
																	<option value="9:00 pm" <?php if($time->end_time=='9:00 pm'){echo "selected=''";}?>>9:00 pm</option>
																	<option value="9:30 pm" <?php if($time->end_time=='9:30 pm'){echo "selected=''";}?>>9:30 pm</option>
																	<option value="10:00 pm" <?php if($time->end_time=='10:00 pm'){echo "selected=''";}?>>10:00 pm</option>
																	<option value="10:30 pm" <?php if($time->end_time=='10:30 pm'){echo "selected=''";}?>>10:30 pm</option>
																	<option value="11:00 pm" <?php if($time->end_time=='11:00 pm'){echo "selected=''";}?>>11:00 pm</option>
																	<option value="11:30 pm" <?php if($time->end_time=='11:30 pm'){echo "selected=''";}?>>11:30 pm</option>
																</select>
															</li>
														</ul>

														<div class="pull-left">
											<span class="pull-left">
	                                            <a class="btn btn-primary dynamic_time_add" href="javascript:;">
	                                                <i class="fa fa-plus-circle" aria-hidden="true"></i>
	                                            </a>
	                                        </span>

															<span class="pull-left margin-left-10">
	                                            <a class="btn btn-danger dynamic_time_delete" href="javascript:;">
	                                                <i class="fa fa-minus-circle" aria-hidden="true"></i>
	                                            </a>
	                                        </span>
														</div>
													</div>
												</div>
											<?php }		//end else
											$count++;
										} //end foreach
										?>

										<?php if(count($times)==1){?>
											<div class="dynamic_time_section_area"></div>
										<?php } ?>
									</div>
								</div>
								
								<div class="day_item" data-name="wed">
									<div class="pull-left">
										<ul class="time-list">
											<li>
												<b>Wednesday</b>
											</li>

											<li class="switch-li">
												<span class="pull-left">
													<div class="material-switch">
														<input class="swicth-check" id="Wednesday" name="switch[]" type="checkbox" <?php if(is_open($deliveryTime, 'wednesday')==1){echo "checked";} ?>/>
														<label for="Wednesday" class="label-default"></label>
													</div>
														<input id="Wednesday_switch" name="switch_check[]" type="hidden" value="<?php echo is_open($deliveryTime, 'wednesday')?>"/>
														<input id="" name="day_name[]" type="hidden" value="wednesday"/>
												</span>
												<span class="margin-left-10 open-status"><?php if(is_open($deliveryTime, 'wednesday')==1){echo "Open";} else{echo "Closed";} ?></span>
											</li>
										</ul>
									</div>

									<div class="all_time_section pull-left " style="<?php if(is_open($deliveryTime, 'wednesday')==0){ echo "display: none;";}?>">
										<?php
										$times = get_times($deliveryTime, 'wednesday');
										$count = 1;
										foreach($times as $time){
											if($count==1){ ?>
												<div class="static_time_section pull-left dynamic_multi_section">
													<ul class="time-range time-list pull-left no-padding">

														<li>
															<select id="wednes" class="form-control openCloseHour" name="wed_start_time[]">
																<option value="24 hours" <?php if($time->start_time=='24 hours'){echo "selected";}?>>24 hours</option>
																<option value="12:00 am" <?php if($time->start_time=='12:00 am'){echo "selected=''";}?>>12:00 am</option>
																<option value="12:30 am" <?php if($time->start_time=='12:30 am'){echo "selected=''";}?>>12:30 am</option>
																<option value="1:00 am" <?php if($time->start_time=='1:00 am'){echo "selected=''";}?>>1:00 am</option>
																<option value="1:30 am" <?php if($time->start_time=='1:30 am'){echo "selected=''";}?>>1:30 am</option>
																<option value="2:00 am" <?php if($time->start_time=='2:00 am'){echo "selected=''";}?>>2:00 am</option>
																<option value="2:30 am" <?php if($time->start_time=='2:30 am'){echo "selected=''";}?>>2:30 am</option>
																<option value="3:00 am" <?php if($time->start_time=='3:00 am'){echo "selected=''";}?>>3:00 am</option>
																<option value="3:30 am" <?php if($time->start_time=='3:30 am'){echo "selected=''";}?>>3:30 am</option>
																<option value="4:00 am" <?php if($time->start_time=='4:00 am'){echo "selected=''";}?>>4:00 am</option>
																<option value="4:30 am" <?php if($time->start_time=='4:30 am'){echo "selected=''";}?>>4:30 am</option>
																<option value="5:00 am" <?php if($time->start_time=='5:00 am'){echo "selected=''";}?>>5:00 am</option>
																<option value="5:30 am" <?php if($time->start_time=='5:30 am'){echo "selected=''";}?>>5:30 am</option>
																<option value="6:00 am" <?php if($time->start_time=='6:00 am'){echo "selected=''";}?>>6:00 am</option>
																<option value="6:30 am" <?php if($time->start_time=='6:30 am'){echo "selected=''";}?>>6:30 am</option>
																<option value="7:00 am" <?php if($time->start_time=='7:00 am'){echo "selected=''";}?>>7:00 am</option>
																<option value="7:30 am" <?php if($time->start_time=='7:30 am'){echo "selected=''";}?>>7:30 am</option>
																<option value="8:00 am" <?php if($time->start_time=='8:00 am'){echo "selected=''";}?>>8:00 am</option>
																<option value="8:30 am" <?php if($time->start_time=='8:30 am'){echo "selected=''";}?>>8:30 am</option>
																<option value="9:00 am" <?php if($time->start_time=='9:00 am'){echo "selected=''";}?>>9:00 am</option>
																<option value="9:30 am" <?php if($time->start_time=='9:30 am'){echo "selected=''";}?>>9:30 am</option>
																<option value="10:00 am" <?php if($time->start_time=='10:00 am'){echo "selected=''";}?>>10:00 am</option>
																<option value="10:30 am" <?php if($time->start_time=='10:30 am'){echo "selected=''";}?>>10:30 am</option>
																<option value="11:00 am" <?php if($time->start_time=='11:00 am'){echo "selected=''";}?>>11:00 am</option>
																<option value="11:30 am" <?php if($time->start_time=='11:30 am'){echo "selected=''";}?>>11:30 am</option>
																<option value="12:00 pm" <?php if($time->start_time=='12:00 pm'){echo "selected=''";}?>>12:00 pm</option>
																<option value="12:30 pm <?php if($time->start_time=='12:30 pm'){echo "selected=''";}?>">12:30 pm</option>
																<option value="1:00 pm" <?php if($time->start_time=='1:00 pm'){echo "selected=''";}?>>1:00 pm</option>
																<option value="1:30 pm" <?php if($time->start_time=='1:30 pm'){echo "selected=''";}?>>1:30 pm</option>
																<option value="2:00 pm" <?php if($time->start_time=='2:00 pm'){echo "selected=''";}?>>2:00 pm</option>
																<option value="2:30 pm" <?php if($time->start_time=='2:30 pm'){echo "selected=''";}?>>2:30 pm</option>
																<option value="3:00 pm" <?php if($time->start_time=='3:00 pm'){echo "selected=''";}?>>3:00 pm</option>
																<option value="3:30 pm" <?php if($time->start_time=='3:30 pm'){echo "selected=''";}?>>3:30 pm</option>
																<option value="4:00 pm" <?php if($time->start_time=='4:00 pm'){echo "selected=''";}?>>4:00 pm</option>
																<option value="4:30 pm" <?php if($time->start_time=='4:30 pm'){echo "selected=''";}?>>4:30 pm</option>
																<option value="5:00 pm" <?php if($time->start_time=='5:00 pm'){echo "selected=''";}?>>5:00 pm</option>
																<option value="5:30 pm" <?php if($time->start_time=='5:30 pm'){echo "selected=''";}?>>5:30 pm</option>
																<option value="6:00 pm" <?php if($time->start_time=='6:00 pm'){echo "selected=''";}?>>6:00 pm</option>
																<option value="6:30 pm" <?php if($time->start_time=='6:30 pm'){echo "selected=''";}?>>6:30 pm</option>
																<option value="7:00 pm" <?php if($time->start_time=='7:00 pm'){echo "selected=''";}?>>7:00 pm</option>
																<option value="7:30 pm" <?php if($time->start_time=='7:30 pm'){echo "selected=''";}?>>7:30 pm</option>
																<option value="8:00 pm" <?php if($time->start_time=='8:00 pm'){echo "selected=''";}?>>8:00 pm</option>
																<option value="8:30 pm" <?php if($time->start_time=='8:30 pm'){echo "selected=''";}?>>8:30 pm</option>
																<option value="9:00 pm" <?php if($time->start_time=='9:00 pm'){echo "selected=''";}?>>9:00 pm</option>
																<option value="9:30 pm" <?php if($time->start_time=='9:30 pm'){echo "selected=''";}?>>9:30 pm</option>
																<option value="10:00 pm" <?php if($time->start_time=='10:00 pm'){echo "selected=''";}?>>10:00 pm</option>
																<option value="10:30 pm" <?php if($time->start_time=='10:30 pm'){echo "selected=''";}?>>10:30 pm</option>
																<option value="11:00 pm" <?php if($time->start_time=='11:00 pm'){echo "selected=''";}?>>11:00 pm</option>
																<option value="11:30 pm" <?php if($time->start_time=='11:30 pm'){echo "selected=''";}?>>11:30 pm</option>
															</select>
														</li>

														<li style="width:20px;">
															<span>-</span>
														</li>

														<li>
															<select id="wednes_close" class="form-control openCloseHour" name="wed_end_time[]">
																<option value="12:00 am" <?php if($time->end_time=='12:00 am'){echo "selected=''";}?>>12:00 am</option>
																<option value="12:30 am" <?php if($time->end_time=='12:30 am'){echo "selected=''";}?>>12:30 am</option>
																<option value="1:00 am" <?php if($time->end_time=='1:00 am'){echo "selected=''";}?>>1:00 am</option>
																<option value="1:30 am" <?php if($time->end_time=='1:30 am'){echo "selected=''";}?>>1:30 am</option>
																<option value="2:00 am" <?php if($time->end_time=='2:00 am'){echo "selected=''";}?>>2:00 am</option>
																<option value="2:30 am" <?php if($time->end_time=='2:30 am'){echo "selected=''";}?>>2:30 am</option>
																<option value="3:00 am" <?php if($time->end_time=='3:00 am'){echo "selected=''";}?>>3:00 am</option>
																<option value="3:30 am" <?php if($time->end_time=='3:30 am'){echo "selected=''";}?>>3:30 am</option>
																<option value="4:00 am" <?php if($time->end_time=='4:00 am'){echo "selected=''";}?>>4:00 am</option>
																<option value="4:30 am" <?php if($time->end_time=='4:30 am'){echo "selected=''";}?>>4:30 am</option>
																<option value="5:00 am" <?php if($time->end_time=='5:00 am'){echo "selected=''";}?>>5:00 am</option>
																<option value="5:30 am" <?php if($time->end_time=='5:30 am'){echo "selected=''";}?>>5:30 am</option>
																<option value="6:00 am" <?php if($time->end_time=='6:00 am'){echo "selected=''";}?>>6:00 am</option>
																<option value="6:30 am" <?php if($time->end_time=='6:30 am'){echo "selected=''";}?>>6:30 am</option>
																<option value="7:00 am" <?php if($time->end_time=='7:00 am'){echo "selected=''";}?>>7:00 am</option>
																<option value="7:30 am" <?php if($time->end_time=='7:30 am'){echo "selected=''";}?>>7:30 am</option>
																<option value="8:00 am" <?php if($time->end_time=='8:00 am'){echo "selected=''";}?>>8:00 am</option>
																<option value="8:30 am" <?php if($time->end_time=='8:30 am'){echo "selected=''";}?>>8:30 am</option>
																<option value="9:00 am" <?php if($time->end_time=='9:00 am'){echo "selected=''";}?>>9:00 am</option>
																<option value="9:30 am" <?php if($time->end_time=='9:30 am'){echo "selected=''";}?>>9:30 am</option>
																<option value="10:00 am" <?php if($time->end_time=='10:00am'){echo "selected=''";}?>>10:00 am</option>
																<option value="10:30 am" <?php if($time->end_time=='10:30 am'){echo "selected=''";}?>>10:30 am</option>
																<option value="11:00 am" <?php if($time->end_time=='11:00 am'){echo "selected=''";}?>>11:00 am</option>
																<option value="11:30 am" <?php if($time->end_time=='11:30 am'){echo "selected=''";}?>>11:30 am</option>
																<option value="12:00 pm" <?php if($time->end_time=='12:00 pm'){echo "selected=''";}?>>12:00 pm</option>
																<option value="12:30 pm <?php if($time->end_time=='12:30 pm'){echo "selected=''";}?>">12:30 pm</option>
																<option value="1:00 pm" <?php if($time->end_time=='1:00 pm'){echo "selected=''";}?>>1:00 pm</option>
																<option value="1:30 pm" <?php if($time->end_time=='1:30 pm'){echo "selected=''";}?>>1:30 pm</option>
																<option value="2:00 pm" <?php if($time->end_time=='2:00 pm'){echo "selected=''";}?>>2:00 pm</option>
																<option value="2:30 pm" <?php if($time->end_time=='2:30 pm'){echo "selected=''";}?>>2:30 pm</option>
																<option value="3:00 pm" <?php if($time->end_time=='3:00 pm'){echo "selected=''";}?>>3:00 pm</option>
																<option value="3:30 pm" <?php if($time->end_time=='3:30 pm'){echo "selected=''";}?>>3:30 pm</option>
																<option value="4:00 pm" <?php if($time->end_time=='4:00 pm'){echo "selected=''";}?>>4:00 pm</option>
																<option value="4:30 pm" <?php if($time->end_time=='4:30 pm'){echo "selected=''";}?>>4:30 pm</option>
																<option value="5:00 pm" <?php if($time->end_time=='5:00 pm'){echo "selected=''";}?>>5:00 pm</option>
																<option value="5:30 pm" <?php if($time->end_time=='5:30 pm'){echo "selected=''";}?>>5:30 pm</option>
																<option value="6:00 pm" <?php if($time->end_time=='6:00 pm'){echo "selected=''";}?>>6:00 pm</option>
																<option value="6:30 pm" <?php if($time->end_time=='6:30 pm'){echo "selected=''";}?>>6:30 pm</option>
																<option value="7:00 pm" <?php if($time->end_time=='7:00 pm'){echo "selected=''";}?>>7:00 pm</option>
																<option value="7:30 pm" <?php if($time->end_time=='7:30 pm'){echo "selected=''";}?>>7:30 pm</option>
																<option value="8:00 pm" <?php if($time->end_time=='8:00 pm'){echo "selected=''";}?>>8:00 pm</option>
																<option value="8:30 pm" <?php if($time->end_time=='8:30 pm'){echo "selected=''";}?>>8:30 pm</option>
																<option value="9:00 pm" <?php if($time->end_time=='9:00 pm'){echo "selected=''";}?>>9:00 pm</option>
																<option value="9:30 pm" <?php if($time->end_time=='9:30 pm'){echo "selected=''";}?>>9:30 pm</option>
																<option value="10:00 pm" <?php if($time->end_time=='10:00 pm'){echo "selected=''";}?>>10:00 pm</option>
																<option value="10:30 pm" <?php if($time->end_time=='10:30 pm'){echo "selected=''";}?>>10:30 pm</option>
																<option value="11:00 pm" <?php if($time->end_time=='11:00 pm'){echo "selected=''";}?>>11:00 pm</option>
																<option value="11:30 pm" <?php if($time->end_time=='11:30 pm'){echo "selected=''";}?>>11:30 pm</option>
															</select>
														</li>
													</ul>

													<div class="pull-left">
												<span class="pull-left">
		                                            <a class="btn btn-primary dynamic_time_add" href="javascript:;">
		                                                <i class="fa fa-plus-circle" aria-hidden="true"></i>
		                                            </a>
		                                        </span>

														<span class="pull-left margin-left-10">
		                                            <a class="btn btn-danger" href="javascript:;" disabled="">
		                                                <i class="fa fa-minus-circle" aria-hidden="true"></i>
		                                            </a>
		                                        </span>
													</div>
												</div>

											<?php }
											else{ ?>
												<div class="dynamic_time_section_area">
													<div class="dynamic_multi_time dynamic_multi_section">
														<ul class="time-range time-list pull-left no-padding">
															<li>

																<select id="wednes" class="form-control openCloseHour" name="wed_start_time[]">
																	<option value="24 hours" <?php if($time->start_time=='24 hours'){echo "selected";}?>>24 hours</option>
																	<option value="12:00 am" <?php if($time->start_time=='12:00 am'){echo "selected=''";}?>>12:00 am</option>
																	<option value="12:30 am" <?php if($time->start_time=='12:30 am'){echo "selected=''";}?>>12:30 am</option>
																	<option value="1:00 am" <?php if($time->start_time=='1:00 am'){echo "selected=''";}?>>1:00 am</option>
																	<option value="1:30 am" <?php if($time->start_time=='1:30 am'){echo "selected=''";}?>>1:30 am</option>
																	<option value="2:00 am" <?php if($time->start_time=='2:00 am'){echo "selected=''";}?>>2:00 am</option>
																	<option value="2:30 am" <?php if($time->start_time=='2:30 am'){echo "selected=''";}?>>2:30 am</option>
																	<option value="3:00 am" <?php if($time->start_time=='3:00 am'){echo "selected=''";}?>>3:00 am</option>
																	<option value="3:30 am" <?php if($time->start_time=='3:30 am'){echo "selected=''";}?>>3:30 am</option>
																	<option value="4:00 am" <?php if($time->start_time=='4:00 am'){echo "selected=''";}?>>4:00 am</option>
																	<option value="4:30 am" <?php if($time->start_time=='4:30 am'){echo "selected=''";}?>>4:30 am</option>
																	<option value="5:00 am" <?php if($time->start_time=='5:00 am'){echo "selected=''";}?>>5:00 am</option>
																	<option value="5:30 am" <?php if($time->start_time=='5:30 am'){echo "selected=''";}?>>5:30 am</option>
																	<option value="6:00 am" <?php if($time->start_time=='6:00 am'){echo "selected=''";}?>>6:00 am</option>
																	<option value="6:30 am" <?php if($time->start_time=='6:30 am'){echo "selected=''";}?>>6:30 am</option>
																	<option value="7:00 am" <?php if($time->start_time=='7:00 am'){echo "selected=''";}?>>7:00 am</option>
																	<option value="7:30 am" <?php if($time->start_time=='7:30 am'){echo "selected=''";}?>>7:30 am</option>
																	<option value="8:00 am" <?php if($time->start_time=='8:00 am'){echo "selected=''";}?>>8:00 am</option>
																	<option value="8:30 am" <?php if($time->start_time=='8:30 am'){echo "selected=''";}?>>8:30 am</option>
																	<option value="9:00 am" <?php if($time->start_time=='9:00 am'){echo "selected=''";}?>>9:00 am</option>
																	<option value="9:30 am" <?php if($time->start_time=='9:30 am'){echo "selected=''";}?>>9:30 am</option>
																	<option value="10:00 am" <?php if($time->start_time=='10:00 am'){echo "selected=''";}?>>10:00 am</option>
																	<option value="10:30 am" <?php if($time->start_time=='10:30 am'){echo "selected=''";}?>>10:30 am</option>
																	<option value="11:00 am" <?php if($time->start_time=='11:00 am'){echo "selected=''";}?>>11:00 am</option>
																	<option value="11:30 am" <?php if($time->start_time=='11:30 am'){echo "selected=''";}?>>11:30 am</option>
																	<option value="12:00 pm" <?php if($time->start_time=='12:00 pm'){echo "selected=''";}?>>12:00 pm</option>
																	<option value="12:30 pm <?php if($time->start_time=='12:30 pm'){echo "selected=''";}?>">12:30 pm</option>
																	<option value="1:00 pm" <?php if($time->start_time=='1:00 pm'){echo "selected=''";}?>>1:00 pm</option>
																	<option value="1:30 pm" <?php if($time->start_time=='1:30 pm'){echo "selected=''";}?>>1:30 pm</option>
																	<option value="2:00 pm" <?php if($time->start_time=='2:00 pm'){echo "selected=''";}?>>2:00 pm</option>
																	<option value="2:30 pm" <?php if($time->start_time=='2:30 pm'){echo "selected=''";}?>>2:30 pm</option>
																	<option value="3:00 pm" <?php if($time->start_time=='3:00 pm'){echo "selected=''";}?>>3:00 pm</option>
																	<option value="3:30 pm" <?php if($time->start_time=='3:30 pm'){echo "selected=''";}?>>3:30 pm</option>
																	<option value="4:00 pm" <?php if($time->start_time=='4:00 pm'){echo "selected=''";}?>>4:00 pm</option>
																	<option value="4:30 pm" <?php if($time->start_time=='4:30 pm'){echo "selected=''";}?>>4:30 pm</option>
																	<option value="5:00 pm" <?php if($time->start_time=='5:00 pm'){echo "selected=''";}?>>5:00 pm</option>
																	<option value="5:30 pm" <?php if($time->start_time=='5:30 pm'){echo "selected=''";}?>>5:30 pm</option>
																	<option value="6:00 pm" <?php if($time->start_time=='6:00 pm'){echo "selected=''";}?>>6:00 pm</option>
																	<option value="6:30 pm" <?php if($time->start_time=='6:30 pm'){echo "selected=''";}?>>6:30 pm</option>
																	<option value="7:00 pm" <?php if($time->start_time=='7:00 pm'){echo "selected=''";}?>>7:00 pm</option>
																	<option value="7:30 pm" <?php if($time->start_time=='7:30 pm'){echo "selected=''";}?>>7:30 pm</option>
																	<option value="8:00 pm" <?php if($time->start_time=='8:00 pm'){echo "selected=''";}?>>8:00 pm</option>
																	<option value="8:30 pm" <?php if($time->start_time=='8:30 pm'){echo "selected=''";}?>>8:30 pm</option>
																	<option value="9:00 pm" <?php if($time->start_time=='9:00 pm'){echo "selected=''";}?>>9:00 pm</option>
																	<option value="9:30 pm" <?php if($time->start_time=='9:30 pm'){echo "selected=''";}?>>9:30 pm</option>
																	<option value="10:00 pm" <?php if($time->start_time=='10:00 pm'){echo "selected=''";}?>>10:00 pm</option>
																	<option value="10:30 pm" <?php if($time->start_time=='10:30 pm'){echo "selected=''";}?>>10:30 pm</option>
																	<option value="11:00 pm" <?php if($time->start_time=='11:00 pm'){echo "selected=''";}?>>11:00 pm</option>
																	<option value="11:30 pm" <?php if($time->start_time=='11:30 pm'){echo "selected=''";}?>>11:30 pm</option>
																</select>
															</li>

															<li style="width:20px;">
																<span>-</span>
															</li>

															<li>

																<select id="wednes_close" class="form-control openCloseHour" name="wed_end_time[]">
																	<option value="12:00 am" <?php if($time->end_time=='12:00 am'){echo "selected=''";}?>>12:00 am</option>
																	<option value="12:30 am" <?php if($time->end_time=='12:30 am'){echo "selected=''";}?>>12:30 am</option>
																	<option value="1:00 am" <?php if($time->end_time=='1:00 am'){echo "selected=''";}?>>1:00 am</option>
																	<option value="1:30 am" <?php if($time->end_time=='1:30 am'){echo "selected=''";}?>>1:30 am</option>
																	<option value="2:00 am" <?php if($time->end_time=='2:00 am'){echo "selected=''";}?>>2:00 am</option>
																	<option value="2:30 am" <?php if($time->end_time=='2:30 am'){echo "selected=''";}?>>2:30 am</option>
																	<option value="3:00 am" <?php if($time->end_time=='3:00 am'){echo "selected=''";}?>>3:00 am</option>
																	<option value="3:30 am" <?php if($time->end_time=='3:30 am'){echo "selected=''";}?>>3:30 am</option>
																	<option value="4:00 am" <?php if($time->end_time=='4:00 am'){echo "selected=''";}?>>4:00 am</option>
																	<option value="4:30 am" <?php if($time->end_time=='4:30 am'){echo "selected=''";}?>>4:30 am</option>
																	<option value="5:00 am" <?php if($time->end_time=='5:00 am'){echo "selected=''";}?>>5:00 am</option>
																	<option value="5:30 am" <?php if($time->end_time=='5:30 am'){echo "selected=''";}?>>5:30 am</option>
																	<option value="6:00 am" <?php if($time->end_time=='6:00 am'){echo "selected=''";}?>>6:00 am</option>
																	<option value="6:30 am" <?php if($time->end_time=='6:30 am'){echo "selected=''";}?>>6:30 am</option>
																	<option value="7:00 am" <?php if($time->end_time=='7:00 am'){echo "selected=''";}?>>7:00 am</option>
																	<option value="7:30 am" <?php if($time->end_time=='7:30 am'){echo "selected=''";}?>>7:30 am</option>
																	<option value="8:00 am" <?php if($time->end_time=='8:00 am'){echo "selected=''";}?>>8:00 am</option>
																	<option value="8:30 am" <?php if($time->end_time=='8:30 am'){echo "selected=''";}?>>8:30 am</option>
																	<option value="9:00 am" <?php if($time->end_time=='9:00 am'){echo "selected=''";}?>>9:00 am</option>
																	<option value="9:30 am" <?php if($time->end_time=='9:30 am'){echo "selected=''";}?>>9:30 am</option>
																	<option value="10:00 am" <?php if($time->end_time=='10:00am'){echo "selected=''";}?>>10:00 am</option>
																	<option value="10:30 am" <?php if($time->end_time=='10:30 am'){echo "selected=''";}?>>10:30 am</option>
																	<option value="11:00 am" <?php if($time->end_time=='11:00 am'){echo "selected=''";}?>>11:00 am</option>
																	<option value="11:30 am" <?php if($time->end_time=='11:30 am'){echo "selected=''";}?>>11:30 am</option>
																	<option value="12:00 pm" <?php if($time->end_time=='12:00 pm'){echo "selected=''";}?>>12:00 pm</option>
																	<option value="12:30 pm <?php if($time->end_time=='12:30 pm'){echo "selected=''";}?>">12:30 pm</option>
																	<option value="1:00 pm" <?php if($time->end_time=='1:00 pm'){echo "selected=''";}?>>1:00 pm</option>
																	<option value="1:30 pm" <?php if($time->end_time=='1:30 pm'){echo "selected=''";}?>>1:30 pm</option>
																	<option value="2:00 pm" <?php if($time->end_time=='2:00 pm'){echo "selected=''";}?>>2:00 pm</option>
																	<option value="2:30 pm" <?php if($time->end_time=='2:30 pm'){echo "selected=''";}?>>2:30 pm</option>
																	<option value="3:00 pm" <?php if($time->end_time=='3:00 pm'){echo "selected=''";}?>>3:00 pm</option>
																	<option value="3:30 pm" <?php if($time->end_time=='3:30 pm'){echo "selected=''";}?>>3:30 pm</option>
																	<option value="4:00 pm" <?php if($time->end_time=='4:00 pm'){echo "selected=''";}?>>4:00 pm</option>
																	<option value="4:30 pm" <?php if($time->end_time=='4:30 pm'){echo "selected=''";}?>>4:30 pm</option>
																	<option value="5:00 pm" <?php if($time->end_time=='5:00 pm'){echo "selected=''";}?>>5:00 pm</option>
																	<option value="5:30 pm" <?php if($time->end_time=='5:30 pm'){echo "selected=''";}?>>5:30 pm</option>
																	<option value="6:00 pm" <?php if($time->end_time=='6:00 pm'){echo "selected=''";}?>>6:00 pm</option>
																	<option value="6:30 pm" <?php if($time->end_time=='6:30 pm'){echo "selected=''";}?>>6:30 pm</option>
																	<option value="7:00 pm" <?php if($time->end_time=='7:00 pm'){echo "selected=''";}?>>7:00 pm</option>
																	<option value="7:30 pm" <?php if($time->end_time=='7:30 pm'){echo "selected=''";}?>>7:30 pm</option>
																	<option value="8:00 pm" <?php if($time->end_time=='8:00 pm'){echo "selected=''";}?>>8:00 pm</option>
																	<option value="8:30 pm" <?php if($time->end_time=='8:30 pm'){echo "selected=''";}?>>8:30 pm</option>
																	<option value="9:00 pm" <?php if($time->end_time=='9:00 pm'){echo "selected=''";}?>>9:00 pm</option>
																	<option value="9:30 pm" <?php if($time->end_time=='9:30 pm'){echo "selected=''";}?>>9:30 pm</option>
																	<option value="10:00 pm" <?php if($time->end_time=='10:00 pm'){echo "selected=''";}?>>10:00 pm</option>
																	<option value="10:30 pm" <?php if($time->end_time=='10:30 pm'){echo "selected=''";}?>>10:30 pm</option>
																	<option value="11:00 pm" <?php if($time->end_time=='11:00 pm'){echo "selected=''";}?>>11:00 pm</option>
																	<option value="11:30 pm" <?php if($time->end_time=='11:30 pm'){echo "selected=''";}?>>11:30 pm</option>
																</select>
															</li>
														</ul>

														<div class="pull-left">
											<span class="pull-left">
	                                            <a class="btn btn-primary dynamic_time_add" href="javascript:;">
	                                                <i class="fa fa-plus-circle" aria-hidden="true"></i>
	                                            </a>
	                                        </span>

															<span class="pull-left margin-left-10">
	                                            <a class="btn btn-danger dynamic_time_delete" href="javascript:;">
	                                                <i class="fa fa-minus-circle" aria-hidden="true"></i>
	                                            </a>
	                                        </span>
														</div>
													</div>
												</div>
											<?php }		//end else
											$count++;
										} //end foreach
										?>


										<?php if(count($times)==1){?>
											<div class="dynamic_time_section_area"></div>
										<?php } ?>
									</div>
								</div>
								
								<div class="day_item" data-name="thu">
									<div class="pull-left">
										<ul class="time-list">
											<li>
												<b>Thursday</b>
											</li>

											<li class="switch-li">
												<span class="pull-left">
													<div class="material-switch">
														<input class="swicth-check" id="Thursday" name="switch[]" type="checkbox"  <?php if(is_open($deliveryTime, 'thursday')==1){echo "checked";} ?>/>
														<label for="Thursday" class="label-default"></label>
													</div>
														<input id="Thursday_switch" name="switch_check[]" type="hidden" value="<?php echo is_open($deliveryTime, 'thursday')?>"/>
														<input id="" name="day_name[]" type="hidden" value="thursday"/>
												</span>
												<span class="margin-left-10 open-status"><?php if(is_open($deliveryTime, 'thursday')==1){echo "Open";} else{echo "Closed";} ?></span>
											</li>
										</ul>
									</div>

									<div class="all_time_section pull-left" style="<?php if(is_open($deliveryTime, 'thursday')==0){ echo "display: none;";}?>">
										<?php
										$times = get_times($deliveryTime, 'thursday');
										$count = 1;
										foreach($times as $time){
											if($count==1){ ?>
												<div class="static_time_section pull-left dynamic_multi_section">
													<ul class="time-range time-list pull-left no-padding"<?php if(is_open($deliveryTime, 'thursday')==0){echo "";} ?>>

														<li>
															<select id="thurs" class="form-control openCloseHour" name="thu_start_time[]">
																<option value="24 hours" <?php if($time->start_time=='24 hours'){echo "selected";}?>>24 hours</option>
																<option value="12:00 am" <?php if($time->start_time=='12:00 am'){echo "selected=''";}?>>12:00 am</option>
																<option value="12:30 am" <?php if($time->start_time=='12:30 am'){echo "selected=''";}?>>12:30 am</option>
																<option value="1:00 am" <?php if($time->start_time=='1:00 am'){echo "selected=''";}?>>1:00 am</option>
																<option value="1:30 am" <?php if($time->start_time=='1:30 am'){echo "selected=''";}?>>1:30 am</option>
																<option value="2:00 am" <?php if($time->start_time=='2:00 am'){echo "selected=''";}?>>2:00 am</option>
																<option value="2:30 am" <?php if($time->start_time=='2:30 am'){echo "selected=''";}?>>2:30 am</option>
																<option value="3:00 am" <?php if($time->start_time=='3:00 am'){echo "selected=''";}?>>3:00 am</option>
																<option value="3:30 am" <?php if($time->start_time=='3:30 am'){echo "selected=''";}?>>3:30 am</option>
																<option value="4:00 am" <?php if($time->start_time=='4:00 am'){echo "selected=''";}?>>4:00 am</option>
																<option value="4:30 am" <?php if($time->start_time=='4:30 am'){echo "selected=''";}?>>4:30 am</option>
																<option value="5:00 am" <?php if($time->start_time=='5:00 am'){echo "selected=''";}?>>5:00 am</option>
																<option value="5:30 am" <?php if($time->start_time=='5:30 am'){echo "selected=''";}?>>5:30 am</option>
																<option value="6:00 am" <?php if($time->start_time=='6:00 am'){echo "selected=''";}?>>6:00 am</option>
																<option value="6:30 am" <?php if($time->start_time=='6:30 am'){echo "selected=''";}?>>6:30 am</option>
																<option value="7:00 am" <?php if($time->start_time=='7:00 am'){echo "selected=''";}?>>7:00 am</option>
																<option value="7:30 am" <?php if($time->start_time=='7:30 am'){echo "selected=''";}?>>7:30 am</option>
																<option value="8:00 am" <?php if($time->start_time=='8:00 am'){echo "selected=''";}?>>8:00 am</option>
																<option value="8:30 am" <?php if($time->start_time=='8:30 am'){echo "selected=''";}?>>8:30 am</option>
																<option value="9:00 am" <?php if($time->start_time=='9:00 am'){echo "selected=''";}?>>9:00 am</option>
																<option value="9:30 am" <?php if($time->start_time=='9:30 am'){echo "selected=''";}?>>9:30 am</option>
																<option value="10:00 am" <?php if($time->start_time=='10:00 am'){echo "selected=''";}?>>10:00 am</option>
																<option value="10:30 am" <?php if($time->start_time=='10:30 am'){echo "selected=''";}?>>10:30 am</option>
																<option value="11:00 am" <?php if($time->start_time=='11:00 am'){echo "selected=''";}?>>11:00 am</option>
																<option value="11:30 am" <?php if($time->start_time=='11:30 am'){echo "selected=''";}?>>11:30 am</option>
																<option value="12:00 pm" <?php if($time->start_time=='12:00 pm'){echo "selected=''";}?>>12:00 pm</option>
																<option value="12:30 pm <?php if($time->start_time=='12:30 pm'){echo "selected=''";}?>">12:30 pm</option>
																<option value="1:00 pm" <?php if($time->start_time=='1:00 pm'){echo "selected=''";}?>>1:00 pm</option>
																<option value="1:30 pm" <?php if($time->start_time=='1:30 pm'){echo "selected=''";}?>>1:30 pm</option>
																<option value="2:00 pm" <?php if($time->start_time=='2:00 pm'){echo "selected=''";}?>>2:00 pm</option>
																<option value="2:30 pm" <?php if($time->start_time=='2:30 pm'){echo "selected=''";}?>>2:30 pm</option>
																<option value="3:00 pm" <?php if($time->start_time=='3:00 pm'){echo "selected=''";}?>>3:00 pm</option>
																<option value="3:30 pm" <?php if($time->start_time=='3:30 pm'){echo "selected=''";}?>>3:30 pm</option>
																<option value="4:00 pm" <?php if($time->start_time=='4:00 pm'){echo "selected=''";}?>>4:00 pm</option>
																<option value="4:30 pm" <?php if($time->start_time=='4:30 pm'){echo "selected=''";}?>>4:30 pm</option>
																<option value="5:00 pm" <?php if($time->start_time=='5:00 pm'){echo "selected=''";}?>>5:00 pm</option>
																<option value="5:30 pm" <?php if($time->start_time=='5:30 pm'){echo "selected=''";}?>>5:30 pm</option>
																<option value="6:00 pm" <?php if($time->start_time=='6:00 pm'){echo "selected=''";}?>>6:00 pm</option>
																<option value="6:30 pm" <?php if($time->start_time=='6:30 pm'){echo "selected=''";}?>>6:30 pm</option>
																<option value="7:00 pm" <?php if($time->start_time=='7:00 pm'){echo "selected=''";}?>>7:00 pm</option>
																<option value="7:30 pm" <?php if($time->start_time=='7:30 pm'){echo "selected=''";}?>>7:30 pm</option>
																<option value="8:00 pm" <?php if($time->start_time=='8:00 pm'){echo "selected=''";}?>>8:00 pm</option>
																<option value="8:30 pm" <?php if($time->start_time=='8:30 pm'){echo "selected=''";}?>>8:30 pm</option>
																<option value="9:00 pm" <?php if($time->start_time=='9:00 pm'){echo "selected=''";}?>>9:00 pm</option>
																<option value="9:30 pm" <?php if($time->start_time=='9:30 pm'){echo "selected=''";}?>>9:30 pm</option>
																<option value="10:00 pm" <?php if($time->start_time=='10:00 pm'){echo "selected=''";}?>>10:00 pm</option>
																<option value="10:30 pm" <?php if($time->start_time=='10:30 pm'){echo "selected=''";}?>>10:30 pm</option>
																<option value="11:00 pm" <?php if($time->start_time=='11:00 pm'){echo "selected=''";}?>>11:00 pm</option>
																<option value="11:30 pm" <?php if($time->start_time=='11:30 pm'){echo "selected=''";}?>>11:30 pm</option>
															</select>
														</li>

														<li style="width:20px;">
															<span>-</span>
														</li>

														<li>
															<select id="thurs_close" class="form-control openCloseHour" name="thu_end_time[]">
																<option value="12:00 am" <?php if($time->end_time=='12:00 am'){echo "selected=''";}?>>12:00 am</option>
																<option value="12:30 am" <?php if($time->end_time=='12:30 am'){echo "selected=''";}?>>12:30 am</option>
																<option value="1:00 am" <?php if($time->end_time=='1:00 am'){echo "selected=''";}?>>1:00 am</option>
																<option value="1:30 am" <?php if($time->end_time=='1:30 am'){echo "selected=''";}?>>1:30 am</option>
																<option value="2:00 am" <?php if($time->end_time=='2:00 am'){echo "selected=''";}?>>2:00 am</option>
																<option value="2:30 am" <?php if($time->end_time=='2:30 am'){echo "selected=''";}?>>2:30 am</option>
																<option value="3:00 am" <?php if($time->end_time=='3:00 am'){echo "selected=''";}?>>3:00 am</option>
																<option value="3:30 am" <?php if($time->end_time=='3:30 am'){echo "selected=''";}?>>3:30 am</option>
																<option value="4:00 am" <?php if($time->end_time=='4:00 am'){echo "selected=''";}?>>4:00 am</option>
																<option value="4:30 am" <?php if($time->end_time=='4:30 am'){echo "selected=''";}?>>4:30 am</option>
																<option value="5:00 am" <?php if($time->end_time=='5:00 am'){echo "selected=''";}?>>5:00 am</option>
																<option value="5:30 am" <?php if($time->end_time=='5:30 am'){echo "selected=''";}?>>5:30 am</option>
																<option value="6:00 am" <?php if($time->end_time=='6:00 am'){echo "selected=''";}?>>6:00 am</option>
																<option value="6:30 am" <?php if($time->end_time=='6:30 am'){echo "selected=''";}?>>6:30 am</option>
																<option value="7:00 am" <?php if($time->end_time=='7:00 am'){echo "selected=''";}?>>7:00 am</option>
																<option value="7:30 am" <?php if($time->end_time=='7:30 am'){echo "selected=''";}?>>7:30 am</option>
																<option value="8:00 am" <?php if($time->end_time=='8:00 am'){echo "selected=''";}?>>8:00 am</option>
																<option value="8:30 am" <?php if($time->end_time=='8:30 am'){echo "selected=''";}?>>8:30 am</option>
																<option value="9:00 am" <?php if($time->end_time=='9:00 am'){echo "selected=''";}?>>9:00 am</option>
																<option value="9:30 am" <?php if($time->end_time=='9:30 am'){echo "selected=''";}?>>9:30 am</option>
																<option value="10:00 am" <?php if($time->end_time=='10:00 am'){echo "selected=''";}?>>10:00 am</option>
																<option value="10:30 am" <?php if($time->end_time=='10:30 am'){echo "selected=''";}?>>10:30 am</option>
																<option value="11:00 am" <?php if($time->end_time=='11:00 am'){echo "selected=''";}?>>11:00 am</option>
																<option value="11:30 am" <?php if($time->end_time=='11:30 am'){echo "selected=''";}?>>11:30 am</option>
																<option value="12:00 pm" <?php if($time->end_time=='12:00 pm'){echo "selected=''";}?>>12:00 pm</option>
																<option value="12:30 pm <?php if($time->end_time=='12:30 pm'){echo "selected=''";}?>">12:30 pm</option>
																<option value="1:00 pm" <?php if($time->end_time=='1:00 pm'){echo "selected=''";}?>>1:00 pm</option>
																<option value="1:30 pm" <?php if($time->end_time=='1:30 pm'){echo "selected=''";}?>>1:30 pm</option>
																<option value="2:00 pm" <?php if($time->end_time=='2:00 pm'){echo "selected=''";}?>>2:00 pm</option>
																<option value="2:30 pm" <?php if($time->end_time=='2:30 pm'){echo "selected=''";}?>>2:30 pm</option>
																<option value="3:00 pm" <?php if($time->end_time=='3:00 pm'){echo "selected=''";}?>>3:00 pm</option>
																<option value="3:30 pm" <?php if($time->end_time=='3:30 pm'){echo "selected=''";}?>>3:30 pm</option>
																<option value="4:00 pm" <?php if($time->end_time=='4:00 pm'){echo "selected=''";}?>>4:00 pm</option>
																<option value="4:30 pm" <?php if($time->end_time=='4:30 pm'){echo "selected=''";}?>>4:30 pm</option>
																<option value="5:00 pm" <?php if($time->end_time=='5:00 pm'){echo "selected=''";}?>>5:00 pm</option>
																<option value="5:30 pm" <?php if($time->end_time=='5:30 pm'){echo "selected=''";}?>>5:30 pm</option>
																<option value="6:00 pm" <?php if($time->end_time=='6:00 pm'){echo "selected=''";}?>>6:00 pm</option>
																<option value="6:30 pm" <?php if($time->end_time=='6:30 pm'){echo "selected=''";}?>>6:30 pm</option>
																<option value="7:00 pm" <?php if($time->end_time=='7:00 pm'){echo "selected=''";}?>>7:00 pm</option>
																<option value="7:30 pm" <?php if($time->end_time=='7:30 pm'){echo "selected=''";}?>>7:30 pm</option>
																<option value="8:00 pm" <?php if($time->end_time=='8:00 pm'){echo "selected=''";}?>>8:00 pm</option>
																<option value="8:30 pm" <?php if($time->end_time=='8:30 pm'){echo "selected=''";}?>>8:30 pm</option>
																<option value="9:00 pm" <?php if($time->end_time=='9:00 pm'){echo "selected=''";}?>>9:00 pm</option>
																<option value="9:30 pm" <?php if($time->end_time=='9:30 pm'){echo "selected=''";}?>>9:30 pm</option>
																<option value="10:00 pm" <?php if($time->end_time=='10:00 pm'){echo "selected=''";}?>>10:00 pm</option>
																<option value="10:30 pm" <?php if($time->end_time=='10:30 pm'){echo "selected=''";}?>>10:30 pm</option>
																<option value="11:00 pm" <?php if($time->end_time=='11:00 pm'){echo "selected=''";}?>>11:00 pm</option>
																<option value="11:30 pm" <?php if($time->end_time=='11:30 pm'){echo "selected=''";}?>>11:30 pm</option>
															</select>
														</li>
													</ul>

													<div class="pull-left">
												<span class="pull-left">
		                                            <a class="btn btn-primary dynamic_time_add" href="javascript:;">
		                                                <i class="fa fa-plus-circle" aria-hidden="true"></i>
		                                            </a>
		                                        </span>

														<span class="pull-left margin-left-10">
		                                            <a class="btn btn-danger" href="javascript:;" disabled="">
		                                                <i class="fa fa-minus-circle" aria-hidden="true"></i>
		                                            </a>
		                                        </span>
													</div>
												</div>


											<?php }
											else{ ?>
												<div class="dynamic_time_section_area">
													<div class="dynamic_multi_time dynamic_multi_section">
														<ul class="time-range time-list pull-left no-padding">
															<li>

																<select id="thurs" class="form-control openCloseHour" name="thu_start_time[]">
																	<option value="24 hours" <?php if($time->start_time=='24 hours'){echo "selected";}?>>24 hours</option>
																	<option value="12:00 am" <?php if($time->start_time=='12:00 am'){echo "selected=''";}?>>12:00 am</option>
																	<option value="12:30 am" <?php if($time->start_time=='12:30 am'){echo "selected=''";}?>>12:30 am</option>
																	<option value="1:00 am" <?php if($time->start_time=='1:00 am'){echo "selected=''";}?>>1:00 am</option>
																	<option value="1:30 am" <?php if($time->start_time=='1:30 am'){echo "selected=''";}?>>1:30 am</option>
																	<option value="2:00 am" <?php if($time->start_time=='2:00 am'){echo "selected=''";}?>>2:00 am</option>
																	<option value="2:30 am" <?php if($time->start_time=='2:30 am'){echo "selected=''";}?>>2:30 am</option>
																	<option value="3:00 am" <?php if($time->start_time=='3:00 am'){echo "selected=''";}?>>3:00 am</option>
																	<option value="3:30 am" <?php if($time->start_time=='3:30 am'){echo "selected=''";}?>>3:30 am</option>
																	<option value="4:00 am" <?php if($time->start_time=='4:00 am'){echo "selected=''";}?>>4:00 am</option>
																	<option value="4:30 am" <?php if($time->start_time=='4:30 am'){echo "selected=''";}?>>4:30 am</option>
																	<option value="5:00 am" <?php if($time->start_time=='5:00 am'){echo "selected=''";}?>>5:00 am</option>
																	<option value="5:30 am" <?php if($time->start_time=='5:30 am'){echo "selected=''";}?>>5:30 am</option>
																	<option value="6:00 am" <?php if($time->start_time=='6:00 am'){echo "selected=''";}?>>6:00 am</option>
																	<option value="6:30 am" <?php if($time->start_time=='6:30 am'){echo "selected=''";}?>>6:30 am</option>
																	<option value="7:00 am" <?php if($time->start_time=='7:00 am'){echo "selected=''";}?>>7:00 am</option>
																	<option value="7:30 am" <?php if($time->start_time=='7:30 am'){echo "selected=''";}?>>7:30 am</option>
																	<option value="8:00 am" <?php if($time->start_time=='8:00 am'){echo "selected=''";}?>>8:00 am</option>
																	<option value="8:30 am" <?php if($time->start_time=='8:30 am'){echo "selected=''";}?>>8:30 am</option>
																	<option value="9:00 am" <?php if($time->start_time=='9:00 am'){echo "selected=''";}?>>9:00 am</option>
																	<option value="9:30 am" <?php if($time->start_time=='9:30 am'){echo "selected=''";}?>>9:30 am</option>
																	<option value="10:00 am" <?php if($time->start_time=='10:00 am'){echo "selected=''";}?>>10:00 am</option>
																	<option value="10:30 am" <?php if($time->start_time=='10:30 am'){echo "selected=''";}?>>10:30 am</option>
																	<option value="11:00 am" <?php if($time->start_time=='11:00 am'){echo "selected=''";}?>>11:00 am</option>
																	<option value="11:30 am" <?php if($time->start_time=='11:30 am'){echo "selected=''";}?>>11:30 am</option>
																	<option value="12:00 pm" <?php if($time->start_time=='12:00 pm'){echo "selected=''";}?>>12:00 pm</option>
																	<option value="12:30 pm <?php if($time->start_time=='12:30 pm'){echo "selected=''";}?>">12:30 pm</option>
																	<option value="1:00 pm" <?php if($time->start_time=='1:00 pm'){echo "selected=''";}?>>1:00 pm</option>
																	<option value="1:30 pm" <?php if($time->start_time=='1:30 pm'){echo "selected=''";}?>>1:30 pm</option>
																	<option value="2:00 pm" <?php if($time->start_time=='2:00 pm'){echo "selected=''";}?>>2:00 pm</option>
																	<option value="2:30 pm" <?php if($time->start_time=='2:30 pm'){echo "selected=''";}?>>2:30 pm</option>
																	<option value="3:00 pm" <?php if($time->start_time=='3:00 pm'){echo "selected=''";}?>>3:00 pm</option>
																	<option value="3:30 pm" <?php if($time->start_time=='3:30 pm'){echo "selected=''";}?>>3:30 pm</option>
																	<option value="4:00 pm" <?php if($time->start_time=='4:00 pm'){echo "selected=''";}?>>4:00 pm</option>
																	<option value="4:30 pm" <?php if($time->start_time=='4:30 pm'){echo "selected=''";}?>>4:30 pm</option>
																	<option value="5:00 pm" <?php if($time->start_time=='5:00 pm'){echo "selected=''";}?>>5:00 pm</option>
																	<option value="5:30 pm" <?php if($time->start_time=='5:30 pm'){echo "selected=''";}?>>5:30 pm</option>
																	<option value="6:00 pm" <?php if($time->start_time=='6:00 pm'){echo "selected=''";}?>>6:00 pm</option>
																	<option value="6:30 pm" <?php if($time->start_time=='6:30 pm'){echo "selected=''";}?>>6:30 pm</option>
																	<option value="7:00 pm" <?php if($time->start_time=='7:00 pm'){echo "selected=''";}?>>7:00 pm</option>
																	<option value="7:30 pm" <?php if($time->start_time=='7:30 pm'){echo "selected=''";}?>>7:30 pm</option>
																	<option value="8:00 pm" <?php if($time->start_time=='8:00 pm'){echo "selected=''";}?>>8:00 pm</option>
																	<option value="8:30 pm" <?php if($time->start_time=='8:30 pm'){echo "selected=''";}?>>8:30 pm</option>
																	<option value="9:00 pm" <?php if($time->start_time=='9:00 pm'){echo "selected=''";}?>>9:00 pm</option>
																	<option value="9:30 pm" <?php if($time->start_time=='9:30 pm'){echo "selected=''";}?>>9:30 pm</option>
																	<option value="10:00 pm" <?php if($time->start_time=='10:00 pm'){echo "selected=''";}?>>10:00 pm</option>
																	<option value="10:30 pm" <?php if($time->start_time=='10:30 pm'){echo "selected=''";}?>>10:30 pm</option>
																	<option value="11:00 pm" <?php if($time->start_time=='11:00 pm'){echo "selected=''";}?>>11:00 pm</option>
																	<option value="11:30 pm" <?php if($time->start_time=='11:30 pm'){echo "selected=''";}?>>11:30 pm</option>
																</select>
															</li>

															<li style="width:20px;">
																<span>-</span>
															</li>

															<li>

																<select id="thurs_close" class="form-control openCloseHour" name="thu_end_time[]">
																	<option value="12:00 am" <?php if($time->end_time=='12:00 am'){echo "selected=''";}?>>12:00 am</option>
																	<option value="12:30 am" <?php if($time->end_time=='12:30 am'){echo "selected=''";}?>>12:30 am</option>
																	<option value="1:00 am" <?php if($time->end_time=='1:00 am'){echo "selected=''";}?>>1:00 am</option>
																	<option value="1:30 am" <?php if($time->end_time=='1:30 am'){echo "selected=''";}?>>1:30 am</option>
																	<option value="2:00 am" <?php if($time->end_time=='2:00 am'){echo "selected=''";}?>>2:00 am</option>
																	<option value="2:30 am" <?php if($time->end_time=='2:30 am'){echo "selected=''";}?>>2:30 am</option>
																	<option value="3:00 am" <?php if($time->end_time=='3:00 am'){echo "selected=''";}?>>3:00 am</option>
																	<option value="3:30 am" <?php if($time->end_time=='3:30 am'){echo "selected=''";}?>>3:30 am</option>
																	<option value="4:00 am" <?php if($time->end_time=='4:00 am'){echo "selected=''";}?>>4:00 am</option>
																	<option value="4:30 am" <?php if($time->end_time=='4:30 am'){echo "selected=''";}?>>4:30 am</option>
																	<option value="5:00 am" <?php if($time->end_time=='5:00 am'){echo "selected=''";}?>>5:00 am</option>
																	<option value="5:30 am" <?php if($time->end_time=='5:30 am'){echo "selected=''";}?>>5:30 am</option>
																	<option value="6:00 am" <?php if($time->end_time=='6:00 am'){echo "selected=''";}?>>6:00 am</option>
																	<option value="6:30 am" <?php if($time->end_time=='6:30 am'){echo "selected=''";}?>>6:30 am</option>
																	<option value="7:00 am" <?php if($time->end_time=='7:00 am'){echo "selected=''";}?>>7:00 am</option>
																	<option value="7:30 am" <?php if($time->end_time=='7:30 am'){echo "selected=''";}?>>7:30 am</option>
																	<option value="8:00 am" <?php if($time->end_time=='8:00 am'){echo "selected=''";}?>>8:00 am</option>
																	<option value="8:30 am" <?php if($time->end_time=='8:30 am'){echo "selected=''";}?>>8:30 am</option>
																	<option value="9:00 am" <?php if($time->end_time=='9:00 am'){echo "selected=''";}?>>9:00 am</option>
																	<option value="9:30 am" <?php if($time->end_time=='9:30 am'){echo "selected=''";}?>>9:30 am</option>
																	<option value="10:00 am" <?php if($time->end_time=='10:00 am'){echo "selected=''";}?>>10:00 am</option>
																	<option value="10:30 am" <?php if($time->end_time=='10:30 am'){echo "selected=''";}?>>10:30 am</option>
																	<option value="11:00 am" <?php if($time->end_time=='11:00 am'){echo "selected=''";}?>>11:00 am</option>
																	<option value="11:30 am" <?php if($time->end_time=='11:30 am'){echo "selected=''";}?>>11:30 am</option>
																	<option value="12:00 pm" <?php if($time->end_time=='12:00 pm'){echo "selected=''";}?>>12:00 pm</option>
																	<option value="12:30 pm <?php if($time->end_time=='12:30 pm'){echo "selected=''";}?>">12:30 pm</option>
																	<option value="1:00 pm" <?php if($time->end_time=='1:00 pm'){echo "selected=''";}?>>1:00 pm</option>
																	<option value="1:30 pm" <?php if($time->end_time=='1:30 pm'){echo "selected=''";}?>>1:30 pm</option>
																	<option value="2:00 pm" <?php if($time->end_time=='2:00 pm'){echo "selected=''";}?>>2:00 pm</option>
																	<option value="2:30 pm" <?php if($time->end_time=='2:30 pm'){echo "selected=''";}?>>2:30 pm</option>
																	<option value="3:00 pm" <?php if($time->end_time=='3:00 pm'){echo "selected=''";}?>>3:00 pm</option>
																	<option value="3:30 pm" <?php if($time->end_time=='3:30 pm'){echo "selected=''";}?>>3:30 pm</option>
																	<option value="4:00 pm" <?php if($time->end_time=='4:00 pm'){echo "selected=''";}?>>4:00 pm</option>
																	<option value="4:30 pm" <?php if($time->end_time=='4:30 pm'){echo "selected=''";}?>>4:30 pm</option>
																	<option value="5:00 pm" <?php if($time->end_time=='5:00 pm'){echo "selected=''";}?>>5:00 pm</option>
																	<option value="5:30 pm" <?php if($time->end_time=='5:30 pm'){echo "selected=''";}?>>5:30 pm</option>
																	<option value="6:00 pm" <?php if($time->end_time=='6:00 pm'){echo "selected=''";}?>>6:00 pm</option>
																	<option value="6:30 pm" <?php if($time->end_time=='6:30 pm'){echo "selected=''";}?>>6:30 pm</option>
																	<option value="7:00 pm" <?php if($time->end_time=='7:00 pm'){echo "selected=''";}?>>7:00 pm</option>
																	<option value="7:30 pm" <?php if($time->end_time=='7:30 pm'){echo "selected=''";}?>>7:30 pm</option>
																	<option value="8:00 pm" <?php if($time->end_time=='8:00 pm'){echo "selected=''";}?>>8:00 pm</option>
																	<option value="8:30 pm" <?php if($time->end_time=='8:30 pm'){echo "selected=''";}?>>8:30 pm</option>
																	<option value="9:00 pm" <?php if($time->end_time=='9:00 pm'){echo "selected=''";}?>>9:00 pm</option>
																	<option value="9:30 pm" <?php if($time->end_time=='9:30 pm'){echo "selected=''";}?>>9:30 pm</option>
																	<option value="10:00 pm" <?php if($time->end_time=='10:00 pm'){echo "selected=''";}?>>10:00 pm</option>
																	<option value="10:30 pm" <?php if($time->end_time=='10:30 pm'){echo "selected=''";}?>>10:30 pm</option>
																	<option value="11:00 pm" <?php if($time->end_time=='11:00 pm'){echo "selected=''";}?>>11:00 pm</option>
																	<option value="11:30 pm" <?php if($time->end_time=='11:30 pm'){echo "selected=''";}?>>11:30 pm</option>
																</select>
															</li>
														</ul>

														<div class="pull-left">
											<span class="pull-left">
	                                            <a class="btn btn-primary dynamic_time_add" href="javascript:;">
	                                                <i class="fa fa-plus-circle" aria-hidden="true"></i>
	                                            </a>
	                                        </span>

															<span class="pull-left margin-left-10">
	                                            <a class="btn btn-danger dynamic_time_delete" href="javascript:;">
	                                                <i class="fa fa-minus-circle" aria-hidden="true"></i>
	                                            </a>
	                                        </span>
														</div>
													</div>
												</div>
											<?php }		//end else
											$count++;
										} //end foreach
										?>

										<?php if(count($times)==1){?>
											<div class="dynamic_time_section_area"></div>
										<?php } ?>
									</div>
								</div>
								
								<div class="day_item" data-name="fri">
									<div class="pull-left">
										<ul class="time-list">
											<li>
												<b>Friday</b>
											</li>

											<li class="switch-li">
												<span class="pull-left">
													<div class="material-switch">
														<input class="swicth-check" id="Friday" name="switch[]" type="checkbox"  <?php if(is_open($deliveryTime, 'friday')==1){echo "checked";} ?>/>
														<label for="Friday" class="label-default"></label>
													</div>
														<input id="Friday_switch" name="switch_check[]" type="hidden" value="<?php echo is_open($deliveryTime, 'friday')?>"/>
														<input id="" name="day_name[]" type="hidden" value="friday"/>
												</span>
												<span class="margin-left-10 open-status"><?php if(is_open($deliveryTime, 'friday')==1){echo "Open";} else{echo "Closed";} ?></span>
											</li>
										</ul>
									</div>

									<div class="all_time_section pull-left" style="<?php if(is_open($deliveryTime, 'friday')==0){ echo "display: none;";}?>">
										<?php
										$times = get_times($deliveryTime, 'friday');
										$count = 1;
										foreach($times as $time){
											if($count==1){ ?>
												<div class="static_time_section pull-left dynamic_multi_section">
													<ul class="time-range time-list pull-left no-padding">

														<li>
															<select id="fri" class="form-control openCloseHour" name="fri_start_time[]">
																<option value="24 hours" <?php if($time->start_time=='24 hours'){echo "selected";}?>>24 hours</option>
																<option value="12:00 am" <?php if($time->start_time=='12:00 am'){echo "selected=''";}?>>12:00 am</option>
																<option value="12:30 am" <?php if($time->start_time=='12:30 am'){echo "selected=''";}?>>12:30 am</option>
																<option value="1:00 am" <?php if($time->start_time=='1:00 am'){echo "selected=''";}?>>1:00 am</option>
																<option value="1:30 am" <?php if($time->start_time=='1:30 am'){echo "selected=''";}?>>1:30 am</option>
																<option value="2:00 am" <?php if($time->start_time=='2:00 am'){echo "selected=''";}?>>2:00 am</option>
																<option value="2:30 am" <?php if($time->start_time=='2:30 am'){echo "selected=''";}?>>2:30 am</option>
																<option value="3:00 am" <?php if($time->start_time=='3:00 am'){echo "selected=''";}?>>3:00 am</option>
																<option value="3:30 am" <?php if($time->start_time=='3:30 am'){echo "selected=''";}?>>3:30 am</option>
																<option value="4:00 am" <?php if($time->start_time=='4:00 am'){echo "selected=''";}?>>4:00 am</option>
																<option value="4:30 am" <?php if($time->start_time=='4:30 am'){echo "selected=''";}?>>4:30 am</option>
																<option value="5:00 am" <?php if($time->start_time=='5:00 am'){echo "selected=''";}?>>5:00 am</option>
																<option value="5:30 am" <?php if($time->start_time=='5:30 am'){echo "selected=''";}?>>5:30 am</option>
																<option value="6:00 am" <?php if($time->start_time=='6:00 am'){echo "selected=''";}?>>6:00 am</option>
																<option value="6:30 am" <?php if($time->start_time=='6:30 am'){echo "selected=''";}?>>6:30 am</option>
																<option value="7:00 am" <?php if($time->start_time=='7:00 am'){echo "selected=''";}?>>7:00 am</option>
																<option value="7:30 am" <?php if($time->start_time=='7:30 am'){echo "selected=''";}?>>7:30 am</option>
																<option value="8:00 am" <?php if($time->start_time=='8:00 am'){echo "selected=''";}?>>8:00 am</option>
																<option value="8:30 am" <?php if($time->start_time=='8:30 am'){echo "selected=''";}?>>8:30 am</option>
																<option value="9:00 am" <?php if($time->start_time=='9:00 am'){echo "selected=''";}?>>9:00 am</option>
																<option value="9:30 am" <?php if($time->start_time=='9:30 am'){echo "selected=''";}?>>9:30 am</option>
																<option value="10:00 am" <?php if($time->start_time=='10:00 am'){echo "selected=''";}?>>10:00 am</option>
																<option value="10:30 am" <?php if($time->start_time=='10:30 am'){echo "selected=''";}?>>10:30 am</option>
																<option value="11:00 am" <?php if($time->start_time=='11:00 am'){echo "selected=''";}?>>11:00 am</option>
																<option value="11:30 am" <?php if($time->start_time=='11:30 am'){echo "selected=''";}?>>11:30 am</option>
																<option value="12:00 pm" <?php if($time->start_time=='12:00 pm'){echo "selected=''";}?>>12:00 pm</option>
																<option value="12:30 pm <?php if($time->start_time=='12:30 pm'){echo "selected=''";}?>">12:30 pm</option>
																<option value="1:00 pm" <?php if($time->start_time=='1:00 pm'){echo "selected=''";}?>>1:00 pm</option>
																<option value="1:30 pm" <?php if($time->start_time=='1:30 pm'){echo "selected=''";}?>>1:30 pm</option>
																<option value="2:00 pm" <?php if($time->start_time=='2:00 pm'){echo "selected=''";}?>>2:00 pm</option>
																<option value="2:30 pm" <?php if($time->start_time=='2:30 pm'){echo "selected=''";}?>>2:30 pm</option>
																<option value="3:00 pm" <?php if($time->start_time=='3:00 pm'){echo "selected=''";}?>>3:00 pm</option>
																<option value="3:30 pm" <?php if($time->start_time=='3:30 pm'){echo "selected=''";}?>>3:30 pm</option>
																<option value="4:00 pm" <?php if($time->start_time=='4:00 pm'){echo "selected=''";}?>>4:00 pm</option>
																<option value="4:30 pm" <?php if($time->start_time=='4:30 pm'){echo "selected=''";}?>>4:30 pm</option>
																<option value="5:00 pm" <?php if($time->start_time=='5:00 pm'){echo "selected=''";}?>>5:00 pm</option>
																<option value="5:30 pm" <?php if($time->start_time=='5:30 pm'){echo "selected=''";}?>>5:30 pm</option>
																<option value="6:00 pm" <?php if($time->start_time=='6:00 pm'){echo "selected=''";}?>>6:00 pm</option>
																<option value="6:30 pm" <?php if($time->start_time=='6:30 pm'){echo "selected=''";}?>>6:30 pm</option>
																<option value="7:00 pm" <?php if($time->start_time=='7:00 pm'){echo "selected=''";}?>>7:00 pm</option>
																<option value="7:30 pm" <?php if($time->start_time=='7:30 pm'){echo "selected=''";}?>>7:30 pm</option>
																<option value="8:00 pm" <?php if($time->start_time=='8:00 pm'){echo "selected=''";}?>>8:00 pm</option>
																<option value="8:30 pm" <?php if($time->start_time=='8:30 pm'){echo "selected=''";}?>>8:30 pm</option>
																<option value="9:00 pm" <?php if($time->start_time=='9:00 pm'){echo "selected=''";}?>>9:00 pm</option>
																<option value="9:30 pm" <?php if($time->start_time=='9:30 pm'){echo "selected=''";}?>>9:30 pm</option>
																<option value="10:00 pm" <?php if($time->start_time=='10:00 pm'){echo "selected=''";}?>>10:00 pm</option>
																<option value="10:30 pm" <?php if($time->start_time=='10:30 pm'){echo "selected=''";}?>>10:30 pm</option>
																<option value="11:00 pm" <?php if($time->start_time=='11:00 pm'){echo "selected=''";}?>>11:00 pm</option>
																<option value="11:30 pm" <?php if($time->start_time=='11:30 pm'){echo "selected=''";}?>>11:30 pm</option>
															</select>
														</li>

														<li style="width:20px;">
															<span>-</span>
														</li>

														<li>
															<select id="fri_close" class="form-control openCloseHour" name="fri_end_time[]">
																<option value="12:00 am" <?php if($time->end_time=='12:00 am'){echo "selected=''";}?>>12:00 am</option>
																<option value="12:30 am" <?php if($time->end_time=='12:30 am'){echo "selected=''";}?>>12:30 am</option>
																<option value="1:00 am" <?php if($time->end_time=='1:00 am'){echo "selected=''";}?>>1:00 am</option>
																<option value="1:30 am" <?php if($time->end_time=='1:30 am'){echo "selected=''";}?>>1:30 am</option>
																<option value="2:00 am" <?php if($time->end_time=='2:00 am'){echo "selected=''";}?>>2:00 am</option>
																<option value="2:30 am" <?php if($time->end_time=='2:30 am'){echo "selected=''";}?>>2:30 am</option>
																<option value="3:00 am" <?php if($time->end_time=='3:00 am'){echo "selected=''";}?>>3:00 am</option>
																<option value="3:30 am" <?php if($time->end_time=='3:30 am'){echo "selected=''";}?>>3:30 am</option>
																<option value="4:00 am" <?php if($time->end_time=='4:00 am'){echo "selected=''";}?>>4:00 am</option>
																<option value="4:30 am" <?php if($time->end_time=='4:30 am'){echo "selected=''";}?>>4:30 am</option>
																<option value="5:00 am" <?php if($time->end_time=='5:00 am'){echo "selected=''";}?>>5:00 am</option>
																<option value="5:30 am" <?php if($time->end_time=='5:30 am'){echo "selected=''";}?>>5:30 am</option>
																<option value="6:00 am" <?php if($time->end_time=='6:00 am'){echo "selected=''";}?>>6:00 am</option>
																<option value="6:30 am" <?php if($time->end_time=='6:30 am'){echo "selected=''";}?>>6:30 am</option>
																<option value="7:00 am" <?php if($time->end_time=='7:00 am'){echo "selected=''";}?>>7:00 am</option>
																<option value="7:30 am" <?php if($time->end_time=='7:30 am'){echo "selected=''";}?>>7:30 am</option>
																<option value="8:00 am" <?php if($time->end_time=='8:00 am'){echo "selected=''";}?>>8:00 am</option>
																<option value="8:30 am" <?php if($time->end_time=='8:30 am'){echo "selected=''";}?>>8:30 am</option>
																<option value="9:00 am" <?php if($time->end_time=='9:00 am'){echo "selected=''";}?>>9:00 am</option>
																<option value="9:30 am" <?php if($time->end_time=='9:30 am'){echo "selected=''";}?>>9:30 am</option>
																<option value="10:00 am" <?php if($time->end_time=='10:00 am'){echo "selected=''";}?>>10:00 am</option>
																<option value="10:30 am" <?php if($time->end_time=='10:30 am'){echo "selected=''";}?>>10:30 am</option>
																<option value="11:00 am" <?php if($time->end_time=='11:00 am'){echo "selected=''";}?>>11:00 am</option>
																<option value="11:30 am" <?php if($time->end_time=='11:30 am'){echo "selected=''";}?>>11:30 am</option>
																<option value="12:00 pm" <?php if($time->end_time=='12:00 pm'){echo "selected=''";}?>>12:00 pm</option>
																<option value="12:30 pm <?php if($time->end_time=='12:30 pm'){echo "selected=''";}?>">12:30 pm</option>
																<option value="1:00 pm" <?php if($time->end_time=='1:00 pm'){echo "selected=''";}?>>1:00 pm</option>
																<option value="1:30 pm" <?php if($time->end_time=='1:30 pm'){echo "selected=''";}?>>1:30 pm</option>
																<option value="2:00 pm" <?php if($time->end_time=='2:00 pm'){echo "selected=''";}?>>2:00 pm</option>
																<option value="2:30 pm" <?php if($time->end_time=='2:30 pm'){echo "selected=''";}?>>2:30 pm</option>
																<option value="3:00 pm" <?php if($time->end_time=='3:00 pm'){echo "selected=''";}?>>3:00 pm</option>
																<option value="3:30 pm" <?php if($time->end_time=='3:30 pm'){echo "selected=''";}?>>3:30 pm</option>
																<option value="4:00 pm" <?php if($time->end_time=='4:00 pm'){echo "selected=''";}?>>4:00 pm</option>
																<option value="4:30 pm" <?php if($time->end_time=='4:30 pm'){echo "selected=''";}?>>4:30 pm</option>
																<option value="5:00 pm" <?php if($time->end_time=='5:00 pm'){echo "selected=''";}?>>5:00 pm</option>
																<option value="5:30 pm" <?php if($time->end_time=='5:30 pm'){echo "selected=''";}?>>5:30 pm</option>
																<option value="6:00 pm" <?php if($time->end_time=='6:00 pm'){echo "selected=''";}?>>6:00 pm</option>
																<option value="6:30 pm" <?php if($time->end_time=='6:30 pm'){echo "selected=''";}?>>6:30 pm</option>
																<option value="7:00 pm" <?php if($time->end_time=='7:00 pm'){echo "selected=''";}?>>7:00 pm</option>
																<option value="7:30 pm" <?php if($time->end_time=='7:30 pm'){echo "selected=''";}?>>7:30 pm</option>
																<option value="8:00 pm" <?php if($time->end_time=='8:00 pm'){echo "selected=''";}?>>8:00 pm</option>
																<option value="8:30 pm" <?php if($time->end_time=='8:30 pm'){echo "selected=''";}?>>8:30 pm</option>
																<option value="9:00 pm" <?php if($time->end_time=='9:00 pm'){echo "selected=''";}?>>9:00 pm</option>
																<option value="9:30 pm" <?php if($time->end_time=='9:30 pm'){echo "selected=''";}?>>9:30 pm</option>
																<option value="10:00 pm" <?php if($time->end_time=='10:00 pm'){echo "selected=''";}?>>10:00 pm</option>
																<option value="10:30 pm" <?php if($time->end_time=='10:30 pm'){echo "selected=''";}?>>10:30 pm</option>
																<option value="11:00 pm" <?php if($time->end_time=='11:00 pm'){echo "selected=''";}?>>11:00 pm</option>
																<option value="11:30 pm" <?php if($time->end_time=='11:30 pm'){echo "selected=''";}?>>11:30 pm</option>
															</select>
														</li>
													</ul>

													<div class="pull-left">
												<span class="pull-left">
		                                            <a class="btn btn-primary dynamic_time_add" href="javascript:;">
		                                                <i class="fa fa-plus-circle" aria-hidden="true"></i>
		                                            </a>
		                                        </span>

														<span class="pull-left margin-left-10">
		                                            <a class="btn btn-danger" href="javascript:;" disabled="">
		                                                <i class="fa fa-minus-circle" aria-hidden="true"></i>
		                                            </a>
		                                        </span>
													</div>
												</div>
											<?php }
											else{ ?>
												<div class="dynamic_time_section_area">
													<div class="dynamic_multi_time dynamic_multi_section">
														<ul class="time-range time-list pull-left no-padding">
															<li>

																<select id="fri" class="form-control openCloseHour" name="fri_start_time[]">
																	<option value="24 hours" <?php if($time->start_time=='24 hours'){echo "selected";}?>>24 hours</option>
																	<option value="12:00 am" <?php if($time->start_time=='12:00 am'){echo "selected=''";}?>>12:00 am</option>
																	<option value="12:30 am" <?php if($time->start_time=='12:30 am'){echo "selected=''";}?>>12:30 am</option>
																	<option value="1:00 am" <?php if($time->start_time=='1:00 am'){echo "selected=''";}?>>1:00 am</option>
																	<option value="1:30 am" <?php if($time->start_time=='1:30 am'){echo "selected=''";}?>>1:30 am</option>
																	<option value="2:00 am" <?php if($time->start_time=='2:00 am'){echo "selected=''";}?>>2:00 am</option>
																	<option value="2:30 am" <?php if($time->start_time=='2:30 am'){echo "selected=''";}?>>2:30 am</option>
																	<option value="3:00 am" <?php if($time->start_time=='3:00 am'){echo "selected=''";}?>>3:00 am</option>
																	<option value="3:30 am" <?php if($time->start_time=='3:30 am'){echo "selected=''";}?>>3:30 am</option>
																	<option value="4:00 am" <?php if($time->start_time=='4:00 am'){echo "selected=''";}?>>4:00 am</option>
																	<option value="4:30 am" <?php if($time->start_time=='4:30 am'){echo "selected=''";}?>>4:30 am</option>
																	<option value="5:00 am" <?php if($time->start_time=='5:00 am'){echo "selected=''";}?>>5:00 am</option>
																	<option value="5:30 am" <?php if($time->start_time=='5:30 am'){echo "selected=''";}?>>5:30 am</option>
																	<option value="6:00 am" <?php if($time->start_time=='6:00 am'){echo "selected=''";}?>>6:00 am</option>
																	<option value="6:30 am" <?php if($time->start_time=='6:30 am'){echo "selected=''";}?>>6:30 am</option>
																	<option value="7:00 am" <?php if($time->start_time=='7:00 am'){echo "selected=''";}?>>7:00 am</option>
																	<option value="7:30 am" <?php if($time->start_time=='7:30 am'){echo "selected=''";}?>>7:30 am</option>
																	<option value="8:00 am" <?php if($time->start_time=='8:00 am'){echo "selected=''";}?>>8:00 am</option>
																	<option value="8:30 am" <?php if($time->start_time=='8:30 am'){echo "selected=''";}?>>8:30 am</option>
																	<option value="9:00 am" <?php if($time->start_time=='9:00 am'){echo "selected=''";}?>>9:00 am</option>
																	<option value="9:30 am" <?php if($time->start_time=='9:30 am'){echo "selected=''";}?>>9:30 am</option>
																	<option value="10:00 am" <?php if($time->start_time=='10:00 am'){echo "selected=''";}?>>10:00 am</option>
																	<option value="10:30 am" <?php if($time->start_time=='10:30 am'){echo "selected=''";}?>>10:30 am</option>
																	<option value="11:00 am" <?php if($time->start_time=='11:00 am'){echo "selected=''";}?>>11:00 am</option>
																	<option value="11:30 am" <?php if($time->start_time=='11:30 am'){echo "selected=''";}?>>11:30 am</option>
																	<option value="12:00 pm" <?php if($time->start_time=='12:00 pm'){echo "selected=''";}?>>12:00 pm</option>
																	<option value="12:30 pm <?php if($time->start_time=='12:30 pm'){echo "selected=''";}?>">12:30 pm</option>
																	<option value="1:00 pm" <?php if($time->start_time=='1:00 pm'){echo "selected=''";}?>>1:00 pm</option>
																	<option value="1:30 pm" <?php if($time->start_time=='1:30 pm'){echo "selected=''";}?>>1:30 pm</option>
																	<option value="2:00 pm" <?php if($time->start_time=='2:00 pm'){echo "selected=''";}?>>2:00 pm</option>
																	<option value="2:30 pm" <?php if($time->start_time=='2:30 pm'){echo "selected=''";}?>>2:30 pm</option>
																	<option value="3:00 pm" <?php if($time->start_time=='3:00 pm'){echo "selected=''";}?>>3:00 pm</option>
																	<option value="3:30 pm" <?php if($time->start_time=='3:30 pm'){echo "selected=''";}?>>3:30 pm</option>
																	<option value="4:00 pm" <?php if($time->start_time=='4:00 pm'){echo "selected=''";}?>>4:00 pm</option>
																	<option value="4:30 pm" <?php if($time->start_time=='4:30 pm'){echo "selected=''";}?>>4:30 pm</option>
																	<option value="5:00 pm" <?php if($time->start_time=='5:00 pm'){echo "selected=''";}?>>5:00 pm</option>
																	<option value="5:30 pm" <?php if($time->start_time=='5:30 pm'){echo "selected=''";}?>>5:30 pm</option>
																	<option value="6:00 pm" <?php if($time->start_time=='6:00 pm'){echo "selected=''";}?>>6:00 pm</option>
																	<option value="6:30 pm" <?php if($time->start_time=='6:30 pm'){echo "selected=''";}?>>6:30 pm</option>
																	<option value="7:00 pm" <?php if($time->start_time=='7:00 pm'){echo "selected=''";}?>>7:00 pm</option>
																	<option value="7:30 pm" <?php if($time->start_time=='7:30 pm'){echo "selected=''";}?>>7:30 pm</option>
																	<option value="8:00 pm" <?php if($time->start_time=='8:00 pm'){echo "selected=''";}?>>8:00 pm</option>
																	<option value="8:30 pm" <?php if($time->start_time=='8:30 pm'){echo "selected=''";}?>>8:30 pm</option>
																	<option value="9:00 pm" <?php if($time->start_time=='9:00 pm'){echo "selected=''";}?>>9:00 pm</option>
																	<option value="9:30 pm" <?php if($time->start_time=='9:30 pm'){echo "selected=''";}?>>9:30 pm</option>
																	<option value="10:00 pm" <?php if($time->start_time=='10:00 pm'){echo "selected=''";}?>>10:00 pm</option>
																	<option value="10:30 pm" <?php if($time->start_time=='10:30 pm'){echo "selected=''";}?>>10:30 pm</option>
																	<option value="11:00 pm" <?php if($time->start_time=='11:00 pm'){echo "selected=''";}?>>11:00 pm</option>
																	<option value="11:30 pm" <?php if($time->start_time=='11:30 pm'){echo "selected=''";}?>>11:30 pm</option>
																</select>
															</li>

															<li style="width:20px;">
																<span>-</span>
															</li>

															<li>

																<select id="fri_close" class="form-control openCloseHour" name="fri_end_time[]">
																	<option value="12:00 am" <?php if($time->end_time=='12:00 am'){echo "selected=''";}?>>12:00 am</option>
																	<option value="12:30 am" <?php if($time->end_time=='12:30 am'){echo "selected=''";}?>>12:30 am</option>
																	<option value="1:00 am" <?php if($time->end_time=='1:00 am'){echo "selected=''";}?>>1:00 am</option>
																	<option value="1:30 am" <?php if($time->end_time=='1:30 am'){echo "selected=''";}?>>1:30 am</option>
																	<option value="2:00 am" <?php if($time->end_time=='2:00 am'){echo "selected=''";}?>>2:00 am</option>
																	<option value="2:30 am" <?php if($time->end_time=='2:30 am'){echo "selected=''";}?>>2:30 am</option>
																	<option value="3:00 am" <?php if($time->end_time=='3:00 am'){echo "selected=''";}?>>3:00 am</option>
																	<option value="3:30 am" <?php if($time->end_time=='3:30 am'){echo "selected=''";}?>>3:30 am</option>
																	<option value="4:00 am" <?php if($time->end_time=='4:00 am'){echo "selected=''";}?>>4:00 am</option>
																	<option value="4:30 am" <?php if($time->end_time=='4:30 am'){echo "selected=''";}?>>4:30 am</option>
																	<option value="5:00 am" <?php if($time->end_time=='5:00 am'){echo "selected=''";}?>>5:00 am</option>
																	<option value="5:30 am" <?php if($time->end_time=='5:30 am'){echo "selected=''";}?>>5:30 am</option>
																	<option value="6:00 am" <?php if($time->end_time=='6:00 am'){echo "selected=''";}?>>6:00 am</option>
																	<option value="6:30 am" <?php if($time->end_time=='6:30 am'){echo "selected=''";}?>>6:30 am</option>
																	<option value="7:00 am" <?php if($time->end_time=='7:00 am'){echo "selected=''";}?>>7:00 am</option>
																	<option value="7:30 am" <?php if($time->end_time=='7:30 am'){echo "selected=''";}?>>7:30 am</option>
																	<option value="8:00 am" <?php if($time->end_time=='8:00 am'){echo "selected=''";}?>>8:00 am</option>
																	<option value="8:30 am" <?php if($time->end_time=='8:30 am'){echo "selected=''";}?>>8:30 am</option>
																	<option value="9:00 am" <?php if($time->end_time=='9:00 am'){echo "selected=''";}?>>9:00 am</option>
																	<option value="9:30 am" <?php if($time->end_time=='9:30 am'){echo "selected=''";}?>>9:30 am</option>
																	<option value="10:00 am" <?php if($time->end_time=='10:00 am'){echo "selected=''";}?>>10:00 am</option>
																	<option value="10:30 am" <?php if($time->end_time=='10:30 am'){echo "selected=''";}?>>10:30 am</option>
																	<option value="11:00 am" <?php if($time->end_time=='11:00 am'){echo "selected=''";}?>>11:00 am</option>
																	<option value="11:30 am" <?php if($time->end_time=='11:30 am'){echo "selected=''";}?>>11:30 am</option>
																	<option value="12:00 pm" <?php if($time->end_time=='12:00 pm'){echo "selected=''";}?>>12:00 pm</option>
																	<option value="12:30 pm <?php if($time->end_time=='12:30 pm'){echo "selected=''";}?>">12:30 pm</option>
																	<option value="1:00 pm" <?php if($time->end_time=='1:00 pm'){echo "selected=''";}?>>1:00 pm</option>
																	<option value="1:30 pm" <?php if($time->end_time=='1:30 pm'){echo "selected=''";}?>>1:30 pm</option>
																	<option value="2:00 pm" <?php if($time->end_time=='2:00 pm'){echo "selected=''";}?>>2:00 pm</option>
																	<option value="2:30 pm" <?php if($time->end_time=='2:30 pm'){echo "selected=''";}?>>2:30 pm</option>
																	<option value="3:00 pm" <?php if($time->end_time=='3:00 pm'){echo "selected=''";}?>>3:00 pm</option>
																	<option value="3:30 pm" <?php if($time->end_time=='3:30 pm'){echo "selected=''";}?>>3:30 pm</option>
																	<option value="4:00 pm" <?php if($time->end_time=='4:00 pm'){echo "selected=''";}?>>4:00 pm</option>
																	<option value="4:30 pm" <?php if($time->end_time=='4:30 pm'){echo "selected=''";}?>>4:30 pm</option>
																	<option value="5:00 pm" <?php if($time->end_time=='5:00 pm'){echo "selected=''";}?>>5:00 pm</option>
																	<option value="5:30 pm" <?php if($time->end_time=='5:30 pm'){echo "selected=''";}?>>5:30 pm</option>
																	<option value="6:00 pm" <?php if($time->end_time=='6:00 pm'){echo "selected=''";}?>>6:00 pm</option>
																	<option value="6:30 pm" <?php if($time->end_time=='6:30 pm'){echo "selected=''";}?>>6:30 pm</option>
																	<option value="7:00 pm" <?php if($time->end_time=='7:00 pm'){echo "selected=''";}?>>7:00 pm</option>
																	<option value="7:30 pm" <?php if($time->end_time=='7:30 pm'){echo "selected=''";}?>>7:30 pm</option>
																	<option value="8:00 pm" <?php if($time->end_time=='8:00 pm'){echo "selected=''";}?>>8:00 pm</option>
																	<option value="8:30 pm" <?php if($time->end_time=='8:30 pm'){echo "selected=''";}?>>8:30 pm</option>
																	<option value="9:00 pm" <?php if($time->end_time=='9:00 pm'){echo "selected=''";}?>>9:00 pm</option>
																	<option value="9:30 pm" <?php if($time->end_time=='9:30 pm'){echo "selected=''";}?>>9:30 pm</option>
																	<option value="10:00 pm" <?php if($time->end_time=='10:00 pm'){echo "selected=''";}?>>10:00 pm</option>
																	<option value="10:30 pm" <?php if($time->end_time=='10:30 pm'){echo "selected=''";}?>>10:30 pm</option>
																	<option value="11:00 pm" <?php if($time->end_time=='11:00 pm'){echo "selected=''";}?>>11:00 pm</option>
																	<option value="11:30 pm" <?php if($time->end_time=='11:30 pm'){echo "selected=''";}?>>11:30 pm</option>
																</select>
															</li>
														</ul>

														<div class="pull-left">
											<span class="pull-left">
	                                            <a class="btn btn-primary dynamic_time_add" href="javascript:;">
	                                                <i class="fa fa-plus-circle" aria-hidden="true"></i>
	                                            </a>
	                                        </span>

															<span class="pull-left margin-left-10">
	                                            <a class="btn btn-danger dynamic_time_delete" href="javascript:;">
	                                                <i class="fa fa-minus-circle" aria-hidden="true"></i>
	                                            </a>
	                                        </span>
														</div>
													</div>
												</div>
											<?php }		//end else
											$count++;
										} //end foreach
										?>


										<?php if(count($times)==1){?>
											<div class="dynamic_time_section_area"></div>
										<?php } ?>
									</div>
								</div>

								<div class="day_item" data-name="sat">
									<div class="pull-left">
										<ul class="time-list">
											<li>
												<b>Saturday</b>
											</li>

											<li class="switch-li">
												<span class="pull-left">
													<div class="material-switch">
														<input class="swicth-check" id="Saturday" name="switch[]" type="checkbox" <?php if(is_open($deliveryTime, 'saturday')==1){echo "checked";} ?>/>
														<label for="Saturday" class="label-default"></label>
													</div>
														<input id="Saturday_switch" name="switch_check[]" type="hidden" value="<?php echo is_open($deliveryTime, 'saturday')?>"/>
														<input id="" name="day_name[]" type="hidden" value="saturday"/>
												</span>
												<span class="margin-left-10 open-status"><?php if(is_open($deliveryTime, 'saturday')==1){echo "Open";} else{echo "Closed";} ?></span>
											</li>
										</ul>
									</div>

									<div class="all_time_section pull-left"  style="<?php if(is_open($deliveryTime, 'saturday')==0){ echo "display: none;";}?>">
										<?php
										$times = get_times($deliveryTime, 'saturday');
										$count = 1;
										foreach($times as $time){
											if($count==1){ ?>
												<div class="static_time_section pull-left dynamic_multi_section">
													<ul class="time-range time-list pull-left no-padding" style="<?php if(is_open($deliveryTime, 'saturday')==0){echo "";} ?>">

														<li>
															<select id="satur" class="form-control openCloseHour" name="sat_start_time[]">
																<option value="24 hours" <?php if($time->start_time=='24 hours'){echo "selected";}?>>24 hours</option>
																<option value="12:00 am" <?php if($time->start_time=='12:00 am'){echo "selected=''";}?>>12:00 am</option>
																<option value="12:30 am" <?php if($time->start_time=='12:30 am'){echo "selected=''";}?>>12:30 am</option>
																<option value="1:00 am" <?php if($time->start_time=='1:00 am'){echo "selected=''";}?>>1:00 am</option>
																<option value="1:30 am" <?php if($time->start_time=='1:30 am'){echo "selected=''";}?>>1:30 am</option>
																<option value="2:00 am" <?php if($time->start_time=='2:00 am'){echo "selected=''";}?>>2:00 am</option>
																<option value="2:30 am" <?php if($time->start_time=='2:30 am'){echo "selected=''";}?>>2:30 am</option>
																<option value="3:00 am" <?php if($time->start_time=='3:00 am'){echo "selected=''";}?>>3:00 am</option>
																<option value="3:30 am" <?php if($time->start_time=='3:30 am'){echo "selected=''";}?>>3:30 am</option>
																<option value="4:00 am" <?php if($time->start_time=='4:00 am'){echo "selected=''";}?>>4:00 am</option>
																<option value="4:30 am" <?php if($time->start_time=='4:30 am'){echo "selected=''";}?>>4:30 am</option>
																<option value="5:00 am" <?php if($time->start_time=='5:00 am'){echo "selected=''";}?>>5:00 am</option>
																<option value="5:30 am" <?php if($time->start_time=='5:30 am'){echo "selected=''";}?>>5:30 am</option>
																<option value="6:00 am" <?php if($time->start_time=='6:00 am'){echo "selected=''";}?>>6:00 am</option>
																<option value="6:30 am" <?php if($time->start_time=='6:30 am'){echo "selected=''";}?>>6:30 am</option>
																<option value="7:00 am" <?php if($time->start_time=='7:00 am'){echo "selected=''";}?>>7:00 am</option>
																<option value="7:30 am" <?php if($time->start_time=='7:30 am'){echo "selected=''";}?>>7:30 am</option>
																<option value="8:00 am" <?php if($time->start_time=='8:00 am'){echo "selected=''";}?>>8:00 am</option>
																<option value="8:30 am" <?php if($time->start_time=='8:30 am'){echo "selected=''";}?>>8:30 am</option>
																<option value="9:00 am" <?php if($time->start_time=='9:00 am'){echo "selected=''";}?>>9:00 am</option>
																<option value="9:30 am" <?php if($time->start_time=='9:30 am'){echo "selected=''";}?>>9:30 am</option>
																<option value="10:00 am" <?php if($time->start_time=='10:00 am'){echo "selected=''";}?>>10:00 am</option>
																<option value="10:30 am" <?php if($time->start_time=='10:30 am'){echo "selected=''";}?>>10:30 am</option>
																<option value="11:00 am" <?php if($time->start_time=='11:00 am'){echo "selected=''";}?>>11:00 am</option>
																<option value="11:30 am" <?php if($time->start_time=='11:30 am'){echo "selected=''";}?>>11:30 am</option>
																<option value="12:00 pm" <?php if($time->start_time=='12:00 pm'){echo "selected=''";}?>>12:00 pm</option>
																<option value="12:30 pm <?php if($time->start_time=='12:30 pm'){echo "selected=''";}?>">12:30 pm</option>
																<option value="1:00 pm" <?php if($time->start_time=='1:00 pm'){echo "selected=''";}?>>1:00 pm</option>
																<option value="1:30 pm" <?php if($time->start_time=='1:30 pm'){echo "selected=''";}?>>1:30 pm</option>
																<option value="2:00 pm" <?php if($time->start_time=='2:00 pm'){echo "selected=''";}?>>2:00 pm</option>
																<option value="2:30 pm" <?php if($time->start_time=='2:30 pm'){echo "selected=''";}?>>2:30 pm</option>
																<option value="3:00 pm" <?php if($time->start_time=='3:00 pm'){echo "selected=''";}?>>3:00 pm</option>
																<option value="3:30 pm" <?php if($time->start_time=='3:30 pm'){echo "selected=''";}?>>3:30 pm</option>
																<option value="4:00 pm" <?php if($time->start_time=='4:00 pm'){echo "selected=''";}?>>4:00 pm</option>
																<option value="4:30 pm" <?php if($time->start_time=='4:30 pm'){echo "selected=''";}?>>4:30 pm</option>
																<option value="5:00 pm" <?php if($time->start_time=='5:00 pm'){echo "selected=''";}?>>5:00 pm</option>
																<option value="5:30 pm" <?php if($time->start_time=='5:30 pm'){echo "selected=''";}?>>5:30 pm</option>
																<option value="6:00 pm" <?php if($time->start_time=='6:00 pm'){echo "selected=''";}?>>6:00 pm</option>
																<option value="6:30 pm" <?php if($time->start_time=='6:30 pm'){echo "selected=''";}?>>6:30 pm</option>
																<option value="7:00 pm" <?php if($time->start_time=='7:00 pm'){echo "selected=''";}?>>7:00 pm</option>
																<option value="7:30 pm" <?php if($time->start_time=='7:30 pm'){echo "selected=''";}?>>7:30 pm</option>
																<option value="8:00 pm" <?php if($time->start_time=='8:00 pm'){echo "selected=''";}?>>8:00 pm</option>
																<option value="8:30 pm" <?php if($time->start_time=='8:30 pm'){echo "selected=''";}?>>8:30 pm</option>
																<option value="9:00 pm" <?php if($time->start_time=='9:00 pm'){echo "selected=''";}?>>9:00 pm</option>
																<option value="9:30 pm" <?php if($time->start_time=='9:30 pm'){echo "selected=''";}?>>9:30 pm</option>
																<option value="10:00 pm" <?php if($time->start_time=='10:00 pm'){echo "selected=''";}?>>10:00 pm</option>
																<option value="10:30 pm" <?php if($time->start_time=='10:30 pm'){echo "selected=''";}?>>10:30 pm</option>
																<option value="11:00 pm" <?php if($time->start_time=='11:00 pm'){echo "selected=''";}?>>11:00 pm</option>
																<option value="11:30 pm" <?php if($time->start_time=='11:30 pm'){echo "selected=''";}?>>11:30 pm</option>
															</select>
														</li>

														<li style="width:20px;">
															<span>-</span>
														</li>

														<li>
															<select id="satur_close" class="form-control openCloseHour" name="sat_end_time[]">
																<option value="12:00 am" <?php if($time->end_time=='12:00 am'){echo "selected=''";}?>>12:00 am</option>
																<option value="12:30 am" <?php if($time->end_time=='12:30 am'){echo "selected=''";}?>>12:30 am</option>
																<option value="1:00 am" <?php if($time->end_time=='1:00 am'){echo "selected=''";}?>>1:00 am</option>
																<option value="1:30 am" <?php if($time->end_time=='1:30 am'){echo "selected=''";}?>>1:30 am</option>
																<option value="2:00 am" <?php if($time->end_time=='2:00 am'){echo "selected=''";}?>>2:00 am</option>
																<option value="2:30 am" <?php if($time->end_time=='2:30 am'){echo "selected=''";}?>>2:30 am</option>
																<option value="3:00 am" <?php if($time->end_time=='3:00 am'){echo "selected=''";}?>>3:00 am</option>
																<option value="3:30 am" <?php if($time->end_time=='3:30 am'){echo "selected=''";}?>>3:30 am</option>
																<option value="4:00 am" <?php if($time->end_time=='4:00 am'){echo "selected=''";}?>>4:00 am</option>
																<option value="4:30 am" <?php if($time->end_time=='4:30 am'){echo "selected=''";}?>>4:30 am</option>
																<option value="5:00 am" <?php if($time->end_time=='5:00 am'){echo "selected=''";}?>>5:00 am</option>
																<option value="5:30 am" <?php if($time->end_time=='5:30 am'){echo "selected=''";}?>>5:30 am</option>
																<option value="6:00 am" <?php if($time->end_time=='6:00 am'){echo "selected=''";}?>>6:00 am</option>
																<option value="6:30 am" <?php if($time->end_time=='6:30 am'){echo "selected=''";}?>>6:30 am</option>
																<option value="7:00 am" <?php if($time->end_time=='7:00 am'){echo "selected=''";}?>>7:00 am</option>
																<option value="7:30 am" <?php if($time->end_time=='7:30 am'){echo "selected=''";}?>>7:30 am</option>
																<option value="8:00 am" <?php if($time->end_time=='8:00 am'){echo "selected=''";}?>>8:00 am</option>
																<option value="8:30 am" <?php if($time->end_time=='8:30 am'){echo "selected=''";}?>>8:30 am</option>
																<option value="9:00 am" <?php if($time->end_time=='9:00 am'){echo "selected=''";}?>>9:00 am</option>
																<option value="9:30 am" <?php if($time->end_time=='9:30 am'){echo "selected=''";}?>>9:30 am</option>
																<option value="10:00 am" <?php if($time->end_time=='10:00 am'){echo "selected=''";}?>>10:00 am</option>
																<option value="10:30 am" <?php if($time->end_time=='10:30 am'){echo "selected=''";}?>>10:30 am</option>
																<option value="11:00 am" <?php if($time->end_time=='11:00 am'){echo "selected=''";}?>>11:00 am</option>
																<option value="11:30 am" <?php if($time->end_time=='11:30 am'){echo "selected=''";}?>>11:30 am</option>
																<option value="12:00 pm" <?php if($time->end_time=='12:00 pm'){echo "selected=''";}?>>12:00 pm</option>
																<option value="12:30 pm <?php if($time->end_time=='12:30 pm'){echo "selected=''";}?>">12:30 pm</option>
																<option value="1:00 pm" <?php if($time->end_time=='1:00 pm'){echo "selected=''";}?>>1:00 pm</option>
																<option value="1:30 pm" <?php if($time->end_time=='1:30 pm'){echo "selected=''";}?>>1:30 pm</option>
																<option value="2:00 pm" <?php if($time->end_time=='2:00 pm'){echo "selected=''";}?>>2:00 pm</option>
																<option value="2:30 pm" <?php if($time->end_time=='2:30 pm'){echo "selected=''";}?>>2:30 pm</option>
																<option value="3:00 pm" <?php if($time->end_time=='3:00 pm'){echo "selected=''";}?>>3:00 pm</option>
																<option value="3:30 pm" <?php if($time->end_time=='3:30 pm'){echo "selected=''";}?>>3:30 pm</option>
																<option value="4:00 pm" <?php if($time->end_time=='4:00 pm'){echo "selected=''";}?>>4:00 pm</option>
																<option value="4:30 pm" <?php if($time->end_time=='4:30 pm'){echo "selected=''";}?>>4:30 pm</option>
																<option value="5:00 pm" <?php if($time->end_time=='5:00 pm'){echo "selected=''";}?>>5:00 pm</option>
																<option value="5:30 pm" <?php if($time->end_time=='5:30 pm'){echo "selected=''";}?>>5:30 pm</option>
																<option value="6:00 pm" <?php if($time->end_time=='6:00 pm'){echo "selected=''";}?>>6:00 pm</option>
																<option value="6:30 pm" <?php if($time->end_time=='6:30 pm'){echo "selected=''";}?>>6:30 pm</option>
																<option value="7:00 pm" <?php if($time->end_time=='7:00 pm'){echo "selected=''";}?>>7:00 pm</option>
																<option value="7:30 pm" <?php if($time->end_time=='7:30 pm'){echo "selected=''";}?>>7:30 pm</option>
																<option value="8:00 pm" <?php if($time->end_time=='8:00 pm'){echo "selected=''";}?>>8:00 pm</option>
																<option value="8:30 pm" <?php if($time->end_time=='8:30 pm'){echo "selected=''";}?>>8:30 pm</option>
																<option value="9:00 pm" <?php if($time->end_time=='9:00 pm'){echo "selected=''";}?>>9:00 pm</option>
																<option value="9:30 pm" <?php if($time->end_time=='9:30 pm'){echo "selected=''";}?>>9:30 pm</option>
																<option value="10:00 pm" <?php if($time->end_time=='10:00 pm'){echo "selected=''";}?>>10:00 pm</option>
																<option value="10:30 pm" <?php if($time->end_time=='10:30 pm'){echo "selected=''";}?>>10:30 pm</option>
																<option value="11:00 pm" <?php if($time->end_time=='11:00 pm'){echo "selected=''";}?>>11:00 pm</option>
																<option value="11:30 pm" <?php if($time->end_time=='11:30 pm'){echo "selected=''";}?>>11:30 pm</option>
															</select>
														</li>
													</ul>

													<div class="pull-left">
												<span class="pull-left">
		                                            <a class="btn btn-primary dynamic_time_add" href="javascript:;">
		                                                <i class="fa fa-plus-circle" aria-hidden="true"></i>
		                                            </a>
		                                        </span>

														<span class="pull-left margin-left-10">
		                                            <a class="btn btn-danger" href="javascript:;" disabled="">
		                                                <i class="fa fa-minus-circle" aria-hidden="true"></i>
		                                            </a>
		                                        </span>
													</div>
												</div>
											<?php }
											else{ ?>
												<div class="dynamic_time_section_area">
													<div class="dynamic_multi_time dynamic_multi_section">
														<ul class="time-range time-list pull-left no-padding">
															<li>

																<select id="satur" class="form-control openCloseHour" name="sat_start_time[]">
																	<option value="24 hours" <?php if($time->start_time=='24 hours'){echo "selected";}?>>24 hours</option>
																	<option value="12:00 am" <?php if($time->start_time=='12:00 am'){echo "selected=''";}?>>12:00 am</option>
																	<option value="12:30 am" <?php if($time->start_time=='12:30 am'){echo "selected=''";}?>>12:30 am</option>
																	<option value="1:00 am" <?php if($time->start_time=='1:00 am'){echo "selected=''";}?>>1:00 am</option>
																	<option value="1:30 am" <?php if($time->start_time=='1:30 am'){echo "selected=''";}?>>1:30 am</option>
																	<option value="2:00 am" <?php if($time->start_time=='2:00 am'){echo "selected=''";}?>>2:00 am</option>
																	<option value="2:30 am" <?php if($time->start_time=='2:30 am'){echo "selected=''";}?>>2:30 am</option>
																	<option value="3:00 am" <?php if($time->start_time=='3:00 am'){echo "selected=''";}?>>3:00 am</option>
																	<option value="3:30 am" <?php if($time->start_time=='3:30 am'){echo "selected=''";}?>>3:30 am</option>
																	<option value="4:00 am" <?php if($time->start_time=='4:00 am'){echo "selected=''";}?>>4:00 am</option>
																	<option value="4:30 am" <?php if($time->start_time=='4:30 am'){echo "selected=''";}?>>4:30 am</option>
																	<option value="5:00 am" <?php if($time->start_time=='5:00 am'){echo "selected=''";}?>>5:00 am</option>
																	<option value="5:30 am" <?php if($time->start_time=='5:30 am'){echo "selected=''";}?>>5:30 am</option>
																	<option value="6:00 am" <?php if($time->start_time=='6:00 am'){echo "selected=''";}?>>6:00 am</option>
																	<option value="6:30 am" <?php if($time->start_time=='6:30 am'){echo "selected=''";}?>>6:30 am</option>
																	<option value="7:00 am" <?php if($time->start_time=='7:00 am'){echo "selected=''";}?>>7:00 am</option>
																	<option value="7:30 am" <?php if($time->start_time=='7:30 am'){echo "selected=''";}?>>7:30 am</option>
																	<option value="8:00 am" <?php if($time->start_time=='8:00 am'){echo "selected=''";}?>>8:00 am</option>
																	<option value="8:30 am" <?php if($time->start_time=='8:30 am'){echo "selected=''";}?>>8:30 am</option>
																	<option value="9:00 am" <?php if($time->start_time=='9:00 am'){echo "selected=''";}?>>9:00 am</option>
																	<option value="9:30 am" <?php if($time->start_time=='9:30 am'){echo "selected=''";}?>>9:30 am</option>
																	<option value="10:00 am" <?php if($time->start_time=='10:00 am'){echo "selected=''";}?>>10:00 am</option>
																	<option value="10:30 am" <?php if($time->start_time=='10:30 am'){echo "selected=''";}?>>10:30 am</option>
																	<option value="11:00 am" <?php if($time->start_time=='11:00 am'){echo "selected=''";}?>>11:00 am</option>
																	<option value="11:30 am" <?php if($time->start_time=='11:30 am'){echo "selected=''";}?>>11:30 am</option>
																	<option value="12:00 pm" <?php if($time->start_time=='12:00 pm'){echo "selected=''";}?>>12:00 pm</option>
																	<option value="12:30 pm <?php if($time->start_time=='12:30 pm'){echo "selected=''";}?>">12:30 pm</option>
																	<option value="1:00 pm" <?php if($time->start_time=='1:00 pm'){echo "selected=''";}?>>1:00 pm</option>
																	<option value="1:30 pm" <?php if($time->start_time=='1:30 pm'){echo "selected=''";}?>>1:30 pm</option>
																	<option value="2:00 pm" <?php if($time->start_time=='2:00 pm'){echo "selected=''";}?>>2:00 pm</option>
																	<option value="2:30 pm" <?php if($time->start_time=='2:30 pm'){echo "selected=''";}?>>2:30 pm</option>
																	<option value="3:00 pm" <?php if($time->start_time=='3:00 pm'){echo "selected=''";}?>>3:00 pm</option>
																	<option value="3:30 pm" <?php if($time->start_time=='3:30 pm'){echo "selected=''";}?>>3:30 pm</option>
																	<option value="4:00 pm" <?php if($time->start_time=='4:00 pm'){echo "selected=''";}?>>4:00 pm</option>
																	<option value="4:30 pm" <?php if($time->start_time=='4:30 pm'){echo "selected=''";}?>>4:30 pm</option>
																	<option value="5:00 pm" <?php if($time->start_time=='5:00 pm'){echo "selected=''";}?>>5:00 pm</option>
																	<option value="5:30 pm" <?php if($time->start_time=='5:30 pm'){echo "selected=''";}?>>5:30 pm</option>
																	<option value="6:00 pm" <?php if($time->start_time=='6:00 pm'){echo "selected=''";}?>>6:00 pm</option>
																	<option value="6:30 pm" <?php if($time->start_time=='6:30 pm'){echo "selected=''";}?>>6:30 pm</option>
																	<option value="7:00 pm" <?php if($time->start_time=='7:00 pm'){echo "selected=''";}?>>7:00 pm</option>
																	<option value="7:30 pm" <?php if($time->start_time=='7:30 pm'){echo "selected=''";}?>>7:30 pm</option>
																	<option value="8:00 pm" <?php if($time->start_time=='8:00 pm'){echo "selected=''";}?>>8:00 pm</option>
																	<option value="8:30 pm" <?php if($time->start_time=='8:30 pm'){echo "selected=''";}?>>8:30 pm</option>
																	<option value="9:00 pm" <?php if($time->start_time=='9:00 pm'){echo "selected=''";}?>>9:00 pm</option>
																	<option value="9:30 pm" <?php if($time->start_time=='9:30 pm'){echo "selected=''";}?>>9:30 pm</option>
																	<option value="10:00 pm" <?php if($time->start_time=='10:00 pm'){echo "selected=''";}?>>10:00 pm</option>
																	<option value="10:30 pm" <?php if($time->start_time=='10:30 pm'){echo "selected=''";}?>>10:30 pm</option>
																	<option value="11:00 pm" <?php if($time->start_time=='11:00 pm'){echo "selected=''";}?>>11:00 pm</option>
																	<option value="11:30 pm" <?php if($time->start_time=='11:30 pm'){echo "selected=''";}?>>11:30 pm</option>
																</select>
															</li>

															<li style="width:20px;">
																<span>-</span>
															</li>

															<li>

																<select id="satur_close" class="form-control openCloseHour" name="sat_end_time[]">
																	<option value="12:00 am" <?php if($time->end_time=='12:00 am'){echo "selected=''";}?>>12:00 am</option>
																	<option value="12:30 am" <?php if($time->end_time=='12:30 am'){echo "selected=''";}?>>12:30 am</option>
																	<option value="1:00 am" <?php if($time->end_time=='1:00 am'){echo "selected=''";}?>>1:00 am</option>
																	<option value="1:30 am" <?php if($time->end_time=='1:30 am'){echo "selected=''";}?>>1:30 am</option>
																	<option value="2:00 am" <?php if($time->end_time=='2:00 am'){echo "selected=''";}?>>2:00 am</option>
																	<option value="2:30 am" <?php if($time->end_time=='2:30 am'){echo "selected=''";}?>>2:30 am</option>
																	<option value="3:00 am" <?php if($time->end_time=='3:00 am'){echo "selected=''";}?>>3:00 am</option>
																	<option value="3:30 am" <?php if($time->end_time=='3:30 am'){echo "selected=''";}?>>3:30 am</option>
																	<option value="4:00 am" <?php if($time->end_time=='4:00 am'){echo "selected=''";}?>>4:00 am</option>
																	<option value="4:30 am" <?php if($time->end_time=='4:30 am'){echo "selected=''";}?>>4:30 am</option>
																	<option value="5:00 am" <?php if($time->end_time=='5:00 am'){echo "selected=''";}?>>5:00 am</option>
																	<option value="5:30 am" <?php if($time->end_time=='5:30 am'){echo "selected=''";}?>>5:30 am</option>
																	<option value="6:00 am" <?php if($time->end_time=='6:00 am'){echo "selected=''";}?>>6:00 am</option>
																	<option value="6:30 am" <?php if($time->end_time=='6:30 am'){echo "selected=''";}?>>6:30 am</option>
																	<option value="7:00 am" <?php if($time->end_time=='7:00 am'){echo "selected=''";}?>>7:00 am</option>
																	<option value="7:30 am" <?php if($time->end_time=='7:30 am'){echo "selected=''";}?>>7:30 am</option>
																	<option value="8:00 am" <?php if($time->end_time=='8:00 am'){echo "selected=''";}?>>8:00 am</option>
																	<option value="8:30 am" <?php if($time->end_time=='8:30 am'){echo "selected=''";}?>>8:30 am</option>
																	<option value="9:00 am" <?php if($time->end_time=='9:00 am'){echo "selected=''";}?>>9:00 am</option>
																	<option value="9:30 am" <?php if($time->end_time=='9:30 am'){echo "selected=''";}?>>9:30 am</option>
																	<option value="10:00 am" <?php if($time->end_time=='10:00 am'){echo "selected=''";}?>>10:00 am</option>
																	<option value="10:30 am" <?php if($time->end_time=='10:30 am'){echo "selected=''";}?>>10:30 am</option>
																	<option value="11:00 am" <?php if($time->end_time=='11:00 am'){echo "selected=''";}?>>11:00 am</option>
																	<option value="11:30 am" <?php if($time->end_time=='11:30 am'){echo "selected=''";}?>>11:30 am</option>
																	<option value="12:00 pm" <?php if($time->end_time=='12:00 pm'){echo "selected=''";}?>>12:00 pm</option>
																	<option value="12:30 pm <?php if($time->end_time=='12:30 pm'){echo "selected=''";}?>">12:30 pm</option>
																	<option value="1:00 pm" <?php if($time->end_time=='1:00 pm'){echo "selected=''";}?>>1:00 pm</option>
																	<option value="1:30 pm" <?php if($time->end_time=='1:30 pm'){echo "selected=''";}?>>1:30 pm</option>
																	<option value="2:00 pm" <?php if($time->end_time=='2:00 pm'){echo "selected=''";}?>>2:00 pm</option>
																	<option value="2:30 pm" <?php if($time->end_time=='2:30 pm'){echo "selected=''";}?>>2:30 pm</option>
																	<option value="3:00 pm" <?php if($time->end_time=='3:00 pm'){echo "selected=''";}?>>3:00 pm</option>
																	<option value="3:30 pm" <?php if($time->end_time=='3:30 pm'){echo "selected=''";}?>>3:30 pm</option>
																	<option value="4:00 pm" <?php if($time->end_time=='4:00 pm'){echo "selected=''";}?>>4:00 pm</option>
																	<option value="4:30 pm" <?php if($time->end_time=='4:30 pm'){echo "selected=''";}?>>4:30 pm</option>
																	<option value="5:00 pm" <?php if($time->end_time=='5:00 pm'){echo "selected=''";}?>>5:00 pm</option>
																	<option value="5:30 pm" <?php if($time->end_time=='5:30 pm'){echo "selected=''";}?>>5:30 pm</option>
																	<option value="6:00 pm" <?php if($time->end_time=='6:00 pm'){echo "selected=''";}?>>6:00 pm</option>
																	<option value="6:30 pm" <?php if($time->end_time=='6:30 pm'){echo "selected=''";}?>>6:30 pm</option>
																	<option value="7:00 pm" <?php if($time->end_time=='7:00 pm'){echo "selected=''";}?>>7:00 pm</option>
																	<option value="7:30 pm" <?php if($time->end_time=='7:30 pm'){echo "selected=''";}?>>7:30 pm</option>
																	<option value="8:00 pm" <?php if($time->end_time=='8:00 pm'){echo "selected=''";}?>>8:00 pm</option>
																	<option value="8:30 pm" <?php if($time->end_time=='8:30 pm'){echo "selected=''";}?>>8:30 pm</option>
																	<option value="9:00 pm" <?php if($time->end_time=='9:00 pm'){echo "selected=''";}?>>9:00 pm</option>
																	<option value="9:30 pm" <?php if($time->end_time=='9:30 pm'){echo "selected=''";}?>>9:30 pm</option>
																	<option value="10:00 pm" <?php if($time->end_time=='10:00 pm'){echo "selected=''";}?>>10:00 pm</option>
																	<option value="10:30 pm" <?php if($time->end_time=='10:30 pm'){echo "selected=''";}?>>10:30 pm</option>
																	<option value="11:00 pm" <?php if($time->end_time=='11:00 pm'){echo "selected=''";}?>>11:00 pm</option>
																	<option value="11:30 pm" <?php if($time->end_time=='11:30 pm'){echo "selected=''";}?>>11:30 pm</option>
																</select>
															</li>
														</ul>

														<div class="pull-left">
											<span class="pull-left">
	                                            <a class="btn btn-primary dynamic_time_add" href="javascript:;">
	                                                <i class="fa fa-plus-circle" aria-hidden="true"></i>
	                                            </a>
	                                        </span>

															<span class="pull-left margin-left-10">
	                                            <a class="btn btn-danger dynamic_time_delete" href="javascript:;">
	                                                <i class="fa fa-minus-circle" aria-hidden="true"></i>
	                                            </a>
	                                        </span>
														</div>
													</div>
												</div>
											<?php }		//end else
											$count++;
										} //end foreach
										?>


										<?php if(count($times)==1){?>
											<div class="dynamic_time_section_area"></div>
										<?php } ?>
									</div>

									<!-- Static ID div where to generate dynamic time slot.-->
									<div id="dynamic_time_section" class="hidden">
										<div class="dynamic_multi_time dynamic_multi_section">
											<ul class="time-range time-list pull-left no-padding">
												<li>

													<select id="sun" class="form-control openCloseHour" name="static_start_time[]">
														<option value="24 hours" <?php if($time->start_time=='24 hours'){echo "selected";}?>>24 hours</option>
														<option value="12:00 am" <?php if($time->start_time=='12:00 am'){echo "selected=''";}?>>12:00 am</option>
														<option value="12:30 am" <?php if($time->start_time=='12:30 am'){echo "selected=''";}?>>12:30 am</option>
														<option value="1:00 am" <?php if($time->start_time=='1:00 am'){echo "selected=''";}?>>1:00 am</option>
														<option value="1:30 am" <?php if($time->start_time=='1:30 am'){echo "selected=''";}?>>1:30 am</option>
														<option value="2:00 am" <?php if($time->start_time=='2:00 am'){echo "selected=''";}?>>2:00 am</option>
														<option value="2:30 am" <?php if($time->start_time=='2:30 am'){echo "selected=''";}?>>2:30 am</option>
														<option value="3:00 am" <?php if($time->start_time=='3:00 am'){echo "selected=''";}?>>3:00 am</option>
														<option value="3:30 am" <?php if($time->start_time=='3:30 am'){echo "selected=''";}?>>3:30 am</option>
														<option value="4:00 am" <?php if($time->start_time=='4:00 am'){echo "selected=''";}?>>4:00 am</option>
														<option value="4:30 am" <?php if($time->start_time=='4:30 am'){echo "selected=''";}?>>4:30 am</option>
														<option value="5:00 am" <?php if($time->start_time=='5:00 am'){echo "selected=''";}?>>5:00 am</option>
														<option value="5:30 am" <?php if($time->start_time=='5:30 am'){echo "selected=''";}?>>5:30 am</option>
														<option value="6:00 am" <?php if($time->start_time=='6:00 am'){echo "selected=''";}?>>6:00 am</option>
														<option value="6:30 am" <?php if($time->start_time=='6:30 am'){echo "selected=''";}?>>6:30 am</option>
														<option value="7:00 am" <?php if($time->start_time=='7:00 am'){echo "selected=''";}?>>7:00 am</option>
														<option value="7:30 am" <?php if($time->start_time=='7:30 am'){echo "selected=''";}?>>7:30 am</option>
														<option value="8:00 am" <?php if($time->start_time=='8:00 am'){echo "selected=''";}?>>8:00 am</option>
														<option value="8:30 am" <?php if($time->start_time=='8:30 am'){echo "selected=''";}?>>8:30 am</option>
														<option value="9:00 am" <?php if($time->start_time=='9:00 am'){echo "selected=''";}?>>9:00 am</option>
														<option value="9:30 am" <?php if($time->start_time=='9:30 am'){echo "selected=''";}?>>9:30 am</option>
														<option value="10:00 am" <?php if($time->start_time=='10:00 am'){echo "selected=''";}?>>10:00 am</option>
														<option value="10:30 am" <?php if($time->start_time=='10:30 am'){echo "selected=''";}?>>10:30 am</option>
														<option value="11:00 am" <?php if($time->start_time=='11:00 am'){echo "selected=''";}?>>11:00 am</option>
														<option value="11:30 am" <?php if($time->start_time=='11:30 am'){echo "selected=''";}?>>11:30 am</option>
														<option value="12:00 pm" <?php if($time->start_time=='12:00 pm'){echo "selected=''";}?>>12:00 pm</option>
														<option value="12:30 pm <?php if($time->start_time=='12:30 pm'){echo "selected=''";}?>">12:30 pm</option>
														<option value="1:00 pm" <?php if($time->start_time=='1:00 pm'){echo "selected=''";}?>>1:00 pm</option>
														<option value="1:30 pm" <?php if($time->start_time=='1:30 pm'){echo "selected=''";}?>>1:30 pm</option>
														<option value="2:00 pm" <?php if($time->start_time=='2:00 pm'){echo "selected=''";}?>>2:00 pm</option>
														<option value="2:30 pm" <?php if($time->start_time=='2:30 pm'){echo "selected=''";}?>>2:30 pm</option>
														<option value="3:00 pm" <?php if($time->start_time=='3:00 pm'){echo "selected=''";}?>>3:00 pm</option>
														<option value="3:30 pm" <?php if($time->start_time=='3:30 pm'){echo "selected=''";}?>>3:30 pm</option>
														<option value="4:00 pm" <?php if($time->start_time=='4:00 pm'){echo "selected=''";}?>>4:00 pm</option>
														<option value="4:30 pm" <?php if($time->start_time=='4:30 pm'){echo "selected=''";}?>>4:30 pm</option>
														<option value="5:00 pm" <?php if($time->start_time=='5:00 pm'){echo "selected=''";}?>>5:00 pm</option>
														<option value="5:30 pm" <?php if($time->start_time=='5:30 pm'){echo "selected=''";}?>>5:30 pm</option>
														<option value="6:00 pm" <?php if($time->start_time=='6:00 pm'){echo "selected=''";}?>>6:00 pm</option>
														<option value="6:30 pm" <?php if($time->start_time=='6:30 pm'){echo "selected=''";}?>>6:30 pm</option>
														<option value="7:00 pm" <?php if($time->start_time=='7:00 pm'){echo "selected=''";}?>>7:00 pm</option>
														<option value="7:30 pm" <?php if($time->start_time=='7:30 pm'){echo "selected=''";}?>>7:30 pm</option>
														<option value="8:00 pm" <?php if($time->start_time=='8:00 pm'){echo "selected=''";}?>>8:00 pm</option>
														<option value="8:30 pm" <?php if($time->start_time=='8:30 pm'){echo "selected=''";}?>>8:30 pm</option>
														<option value="9:00 pm" <?php if($time->start_time=='9:00 pm'){echo "selected=''";}?>>9:00 pm</option>
														<option value="9:30 pm" <?php if($time->start_time=='9:30 pm'){echo "selected=''";}?>>9:30 pm</option>
														<option value="10:00 pm" <?php if($time->start_time=='10:00 pm'){echo "selected=''";}?>>10:00 pm</option>
														<option value="10:30 pm" <?php if($time->start_time=='10:30 pm'){echo "selected=''";}?>>10:30 pm</option>
														<option value="11:00 pm" <?php if($time->start_time=='11:00 pm'){echo "selected=''";}?>>11:00 pm</option>
														<option value="11:30 pm" <?php if($time->start_time=='11:30 pm'){echo "selected=''";}?>>11:30 pm</option>
													</select>
												</li>

												<li style="width:20px;">
													<span>-</span>
												</li>

												<li>

													<select id="sun_close" class="form-control openCloseHour" name="static_end_time[]">
														<option value="12:00 am" <?php if($time->end_time=='12:00 am'){echo "selected=''";}?>>12:00 am</option>
														<option value="12:30 am" <?php if($time->end_time=='12:30 am'){echo "selected=''";}?>>12:30 am</option>
														<option value="1:00 am" <?php if($time->end_time=='1:00 am'){echo "selected=''";}?>>1:00 am</option>
														<option value="1:30 am" <?php if($time->end_time=='1:30 am'){echo "selected=''";}?>>1:30 am</option>
														<option value="2:00 am" <?php if($time->end_time=='2:00 am'){echo "selected=''";}?>>2:00 am</option>
														<option value="2:30 am" <?php if($time->end_time=='2:30 am'){echo "selected=''";}?>>2:30 am</option>
														<option value="3:00 am" <?php if($time->end_time=='3:00 am'){echo "selected=''";}?>>3:00 am</option>
														<option value="3:30 am" <?php if($time->end_time=='3:30 am'){echo "selected=''";}?>>3:30 am</option>
														<option value="4:00 am" <?php if($time->end_time=='4:00 am'){echo "selected=''";}?>>4:00 am</option>
														<option value="4:30 am" <?php if($time->end_time=='4:30 am'){echo "selected=''";}?>>4:30 am</option>
														<option value="5:00 am" <?php if($time->end_time=='5:00 am'){echo "selected=''";}?>>5:00 am</option>
														<option value="5:30 am" <?php if($time->end_time=='5:30 am'){echo "selected=''";}?>>5:30 am</option>
														<option value="6:00 am" <?php if($time->end_time=='6:00 am'){echo "selected=''";}?>>6:00 am</option>
														<option value="6:30 am" <?php if($time->end_time=='6:30 am'){echo "selected=''";}?>>6:30 am</option>
														<option value="7:00 am" <?php if($time->end_time=='7:00 am'){echo "selected=''";}?>>7:00 am</option>
														<option value="7:30 am" <?php if($time->end_time=='7:30 am'){echo "selected=''";}?>>7:30 am</option>
														<option value="8:00 am" <?php if($time->end_time=='8:00 am'){echo "selected=''";}?>>8:00 am</option>
														<option value="8:30 am" <?php if($time->end_time=='8:30 am'){echo "selected=''";}?>>8:30 am</option>
														<option value="9:00 am" <?php if($time->end_time=='9:00 am'){echo "selected=''";}?>>9:00 am</option>
														<option value="9:30 am" <?php if($time->end_time=='9:30 am'){echo "selected=''";}?>>9:30 am</option>
														<option value="10:00 am" <?php if($time->end_time=='10:00 am'){echo "selected=''";}?>>10:00 am</option>
														<option value="10:30 am" <?php if($time->end_time=='10:30 am'){echo "selected=''";}?>>10:30 am</option>
														<option value="11:00 am" <?php if($time->end_time=='11:00 am'){echo "selected=''";}?>>11:00 am</option>
														<option value="11:30 am" <?php if($time->end_time=='11:30 am'){echo "selected=''";}?>>11:30 am</option>
														<option value="12:00 pm" <?php if($time->end_time=='12:00 pm'){echo "selected=''";}?>>12:00 pm</option>
														<option value="12:30 pm <?php if($time->end_time=='12:30 pm'){echo "selected=''";}?>">12:30 pm</option>
														<option value="1:00 pm" <?php if($time->end_time=='1:00 pm'){echo "selected=''";}?>>1:00 pm</option>
														<option value="1:30 pm" <?php if($time->end_time=='1:30 pm'){echo "selected=''";}?>>1:30 pm</option>
														<option value="2:00 pm" <?php if($time->end_time=='2:00 pm'){echo "selected=''";}?>>2:00 pm</option>
														<option value="2:30 pm" <?php if($time->end_time=='2:30 pm'){echo "selected=''";}?>>2:30 pm</option>
														<option value="3:00 pm" <?php if($time->end_time=='3:00 pm'){echo "selected=''";}?>>3:00 pm</option>
														<option value="3:30 pm" <?php if($time->end_time=='3:30 pm'){echo "selected=''";}?>>3:30 pm</option>
														<option value="4:00 pm" <?php if($time->end_time=='4:00 pm'){echo "selected=''";}?>>4:00 pm</option>
														<option value="4:30 pm" <?php if($time->end_time=='4:30 pm'){echo "selected=''";}?>>4:30 pm</option>
														<option value="5:00 pm" <?php if($time->end_time=='5:00 pm'){echo "selected=''";}?>>5:00 pm</option>
														<option value="5:30 pm" <?php if($time->end_time=='5:30 pm'){echo "selected=''";}?>>5:30 pm</option>
														<option value="6:00 pm" <?php if($time->end_time=='6:00 pm'){echo "selected=''";}?>>6:00 pm</option>
														<option value="6:30 pm" <?php if($time->end_time=='6:30 pm'){echo "selected=''";}?>>6:30 pm</option>
														<option value="7:00 pm" <?php if($time->end_time=='7:00 pm'){echo "selected=''";}?>>7:00 pm</option>
														<option value="7:30 pm" <?php if($time->end_time=='7:30 pm'){echo "selected=''";}?>>7:30 pm</option>
														<option value="8:00 pm" <?php if($time->end_time=='8:00 pm'){echo "selected=''";}?>>8:00 pm</option>
														<option value="8:30 pm" <?php if($time->end_time=='8:30 pm'){echo "selected=''";}?>>8:30 pm</option>
														<option value="9:00 pm" <?php if($time->end_time=='9:00 pm'){echo "selected=''";}?>>9:00 pm</option>
														<option value="9:30 pm" <?php if($time->end_time=='9:30 pm'){echo "selected=''";}?>>9:30 pm</option>
														<option value="10:00 pm" <?php if($time->end_time=='10:00 pm'){echo "selected=''";}?>>10:00 pm</option>
														<option value="10:30 pm" <?php if($time->end_time=='10:30 pm'){echo "selected=''";}?>>10:30 pm</option>
														<option value="11:00 pm" <?php if($time->end_time=='11:00 pm'){echo "selected=''";}?>>11:00 pm</option>
														<option value="11:30 pm" <?php if($time->end_time=='11:30 pm'){echo "selected=''";}?>>11:30 pm</option>
													</select>
												</li>
											</ul>

											<div class="pull-left">
											<span class="pull-left">
	                                            <a class="btn btn-primary dynamic_time_add" href="javascript:;">
	                                                <i class="fa fa-plus-circle" aria-hidden="true"></i>
	                                            </a>
	                                        </span>

												<span class="pull-left margin-left-10">
	                                            <a class="btn btn-danger dynamic_time_delete" href="javascript:;">
	                                                <i class="fa fa-minus-circle" aria-hidden="true"></i>
	                                            </a>
	                                        </span>
											</div>
										</div>
									</div>

								</div>

								<div class="pull-left clear">
									<button type="button" class="btn btn-success" id="update_button">Apply</button>
									<a href="<?php echo BASE_URL?>/admin/opening-hour?>"><button type="button"  class="btn btn-danger id="update_button">cancel</button></a>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php
		function is_open($deliveryTime, $day){
			$decoded_data = json_decode($deliveryTime->$day);
			return $decoded_data->is_open;
		}
		function get_start_time($deliveryTime, $day){
			$decoded_data = json_decode($deliveryTime->$day);
			if($decoded_data->is_open==0){
				return '00:00 AM';
			}
			return $decoded_data->start_time;
		}
		function get_end_time($deliveryTime, $day){
			$decoded_data = json_decode($deliveryTime->$day);
			if($decoded_data->is_open==0){
				return '11:59 AM';
			}
			return $decoded_data->end_time;
		}
		function get_times($deliveryTime, $day){
			$decoded_data = json_decode($deliveryTime->$day);
			return $decoded_data->times;
		}
	?>
	
	<script>
		/*$('#startTime,#endTime').timepicker({
			timeFormat: 'h:mm p', 
			scrollbar: true,
		});*/
		
		$(".openCloseHour").change(function(){
			var input_id = $(this).attr('id');
			var value = $(this).val();
			if(value=='24 hours'){
				$("#"+input_id+"_close").hide();
			}
			else{
				$("#"+input_id+"_close").show();
			}
		});

		$(".material-switch").change(function(){
			var input_id = $(this).children().attr('id');
			var a=$(this).parents(".switch-li").children(".open-status").html();
			//alert(a);
			if(a=="Open"){
				$(this).parents(".switch-li").children(".open-status").html("Close");
				$(this).parents(".day_item").children(".all_time_section").css("display","none");
				$('#'+input_id+"_switch").val(0);
			}
			else{
				$(this).parents(".switch-li").children(".open-status").html("Open");
				$(this).parents(".day_item").children(".all_time_section").css("display","block");
				$('#'+input_id+"_switch").val(1);
			}
		});

		$('#update_button').click(function (ev) {
			ev.preventDefault();
			var validate = '';

			if (validate != '') {
				$('.modal-alert-success').hide();
				$('.modal-alert-danger').show();
				$('.modal-alert-danger').html(validate);
				setTimeout(function () {
					$('.modal-alert-danger').hide();
				}, 3000);
				return;
			}

			//var form = $(this).parents('form:first');
			var formData = new FormData( $('#update_opening_hour')[0]);
			$.ajax({
				url: "<?php echo BASE_URL?>/admin/update-opening-hour",
				type: "post",
				data: formData,
				dataType: 'json',
				cache: false,
				contentType: false,
				processData: false,
				success: function (data) {
					console.log(data);
					if (data.status == 200) {

						$('.alert-danger').hide();
						$('.alert-success').show();
						$('.alert-success').html(data.message);

						setTimeout(function () {
							$('.alert-success').hide();
							$('#editModal').modal('hide');
							//window.location.href="<?php echo BASE_URL?>/admin/estimated-delivery-time";
						}, 3000);
					} else {
						$('.alert-success').hide();
						$('.alert-danger').show();
						$('.alert-danger').html(data.message);
						setTimeout(function () {
							$('.alert-danger').hide();
						}, 3000);
					}
					//$('.list_container').html(data);
				}
			});
		});
	</script>
<?php require_once "view/base/admin/footer.php"?>
