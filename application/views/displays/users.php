					<div class="row">
						<div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <i class="fa fa-align-justify"></i> Client's List
                                </div>
                                <div class="card-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone Number</th>
                                                <th>VISA CARD</th>
                                            </tr>
                                        </thead>	
									<?php foreach($users as $user) : ?>
										<tr>	
											<td><strong><a href="<?php echo "user_investments/".$user['id']; ?>"><?php echo $user['name'];  ?></a></strong></td>
											<td><?php echo $user['email'];  ?></td>
											<td><?php echo $user['number'];  ?></td>
											<td><?php echo $user['visacard'];  ?></td>
										</tr>

									<?php endforeach; ?>
									</table>
								</div>
							</div>
						</div>
					</div>